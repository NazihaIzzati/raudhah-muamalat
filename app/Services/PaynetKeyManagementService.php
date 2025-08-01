<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

/**
 * Paynet FPX Key Management Service
 * 
 * Based on official Paynet documentation: https://docs.developer.paynet.my/docs/fpx/key-management
 */
class PaynetKeyManagementService
{
    protected $keyDirectory;
    protected $privateKeyPath;
    protected $publicCertPath;
    protected $merchantCertPath;

    public function __construct()
    {
        $this->keyDirectory = base_path('ssh-keygen');
        $this->privateKeyPath = env('PAYNET_PRIVATE_KEY_PATH', 'ssh-keygen/merchant_private.key');
        $this->publicCertPath = env('PAYNET_PUBLIC_CERT_PATH', 'ssh-keygen/paynet_public.cer');
        $this->merchantCertPath = env('PAYNET_MERCHANT_CERT_PATH', 'ssh-keygen/merchant_certificate.cer');
    }

    /**
     * Generate private key using OpenSSL
     */
    public function generatePrivateKey($filename = 'merchant_private.key')
    {
        try {
            // Create directory if it doesn't exist
            if (!File::exists($this->keyDirectory)) {
                File::makeDirectory($this->keyDirectory, 0755, true);
            }

            $keyPath = $this->keyDirectory . '/' . $filename;
            $command = "openssl genrsa -out {$keyPath} 2048";
            
            $result = shell_exec($command);
            
            if (File::exists($keyPath)) {
                // Set proper permissions (600 for private key)
                chmod($keyPath, 0600);
                
                Log::info('Paynet private key generated successfully', [
                    'path' => $keyPath,
                    'size' => File::size($keyPath)
                ]);
                
                return [
                    'success' => true,
                    'path' => $keyPath,
                    'message' => 'Private key generated successfully'
                ];
            } else {
                throw new \Exception('Failed to generate private key');
            }
        } catch (\Exception $e) {
            Log::error('Failed to generate private key', [
                'error' => $e->getMessage(),
                'command' => $command ?? null
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Generate Certificate Signing Request (CSR)
     */
    public function generateCSR($privateKeyFile, $csrFile, $config = [])
    {
        try {
            $privateKeyPath = $this->keyDirectory . '/' . $privateKeyFile;
            $csrPath = $this->keyDirectory . '/' . $csrFile;
            
            if (!File::exists($privateKeyPath)) {
                throw new \Exception('Private key file not found: ' . $privateKeyPath);
            }
            
            $command = "openssl req -out {$csrPath} -key {$privateKeyPath} -new -sha256";
            $result = shell_exec($command);
            
            if (File::exists($csrPath)) {
                // Set proper permissions (644 for CSR)
                chmod($csrPath, 0644);
                
                Log::info('Paynet CSR generated successfully', [
                    'path' => $csrPath,
                    'size' => File::size($csrPath)
                ]);
                
                return [
                    'success' => true,
                    'path' => $csrPath,
                    'message' => 'CSR generated successfully'
                ];
            } else {
                throw new \Exception('Failed to generate CSR');
            }
        } catch (\Exception $e) {
            Log::error('Failed to generate CSR', [
                'error' => $e->getMessage(),
                'private_key' => $privateKeyFile,
                'csr_file' => $csrFile
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Validate certificate
     */
    public function validateCertificate($certPath = null)
    {
        try {
            $certPath = $certPath ?: $this->publicCertPath;
            $fullPath = base_path($certPath);
            
            if (!File::exists($fullPath)) {
                return [
                    'valid' => false,
                    'error' => 'Certificate file not found: ' . $fullPath
                ];
            }
            
            $cert = file_get_contents($fullPath);
            $certInfo = openssl_x509_parse($cert);
            
            if ($certInfo === false) {
                return [
                    'valid' => false,
                    'error' => 'Invalid certificate format'
                ];
            }
            
            $expiryDate = $certInfo['validTo_time_t'];
            $currentTime = time();
            $isExpired = $expiryDate < $currentTime;
            $daysUntilExpiry = floor(($expiryDate - $currentTime) / 86400);
            
            return [
                'valid' => !$isExpired,
                'expiry' => $expiryDate,
                'expiry_date' => date('Y-m-d H:i:s', $expiryDate),
                'is_expired' => $isExpired,
                'days_until_expiry' => $daysUntilExpiry,
                'subject' => $certInfo['subject'] ?? null,
                'issuer' => $certInfo['issuer'] ?? null,
                'serial_number' => $certInfo['serialNumber'] ?? null
            ];
        } catch (\Exception $e) {
            Log::error('Certificate validation failed', [
                'error' => $e->getMessage(),
                'cert_path' => $certPath
            ]);
            
            return [
                'valid' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Validate private key
     */
    public function validatePrivateKey($keyPath = null)
    {
        try {
            $keyPath = $keyPath ?: $this->privateKeyPath;
            $fullPath = base_path($keyPath);
            
            if (!File::exists($fullPath)) {
                return [
                    'valid' => false,
                    'error' => 'Private key file not found: ' . $fullPath
                ];
            }
            
            $command = "openssl rsa -in {$fullPath} -check -noout 2>&1";
            $result = shell_exec($command);
            
            $isValid = trim($result) === 'RSA key ok';
            
            return [
                'valid' => $isValid,
                'error' => $isValid ? null : $result,
                'path' => $fullPath,
                'size' => File::size($fullPath)
            ];
        } catch (\Exception $e) {
            Log::error('Private key validation failed', [
                'error' => $e->getMessage(),
                'key_path' => $keyPath
            ]);
            
            return [
                'valid' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get certificate information
     */
    public function getCertificateInfo($certPath = null)
    {
        try {
            $certPath = $certPath ?: $this->publicCertPath;
            $fullPath = base_path($certPath);
            
            if (!File::exists($fullPath)) {
                return [
                    'exists' => false,
                    'error' => 'Certificate file not found'
                ];
            }
            
            $command = "openssl x509 -in {$fullPath} -text -noout";
            $result = shell_exec($command);
            
            return [
                'exists' => true,
                'content' => $result,
                'size' => File::size($fullPath),
                'path' => $fullPath
            ];
        } catch (\Exception $e) {
            Log::error('Failed to get certificate info', [
                'error' => $e->getMessage(),
                'cert_path' => $certPath
            ]);
            
            return [
                'exists' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Check all certificates and keys
     */
    public function validateAllCertificates()
    {
        $results = [
            'private_key' => $this->validatePrivateKey(),
            'public_cert' => $this->validateCertificate($this->publicCertPath),
            'merchant_cert' => $this->validateCertificate($this->merchantCertPath),
            'directory_exists' => File::exists($this->keyDirectory),
            'files' => []
        ];
        
        // Check all files in the key directory
        if (File::exists($this->keyDirectory)) {
            $files = File::files($this->keyDirectory);
            foreach ($files as $file) {
                $results['files'][] = [
                    'name' => $file->getFilename(),
                    'size' => $file->getSize(),
                    'permissions' => substr(sprintf('%o', fileperms($file->getPathname())), -4)
                ];
            }
        }
        
        return $results;
    }

    /**
     * Set proper file permissions
     */
    public function setProperPermissions()
    {
        try {
            $permissions = [
                $this->privateKeyPath => 0600, // Private key: owner read/write only
                $this->publicCertPath => 0644, // Public cert: owner read/write, others read
                $this->merchantCertPath => 0644, // Merchant cert: owner read/write, others read
            ];
            
            $results = [];
            foreach ($permissions as $path => $permission) {
                $fullPath = base_path($path);
                if (File::exists($fullPath)) {
                    chmod($fullPath, $permission);
                    $results[$path] = [
                        'success' => true,
                        'permission' => $permission
                    ];
                } else {
                    $results[$path] = [
                        'success' => false,
                        'error' => 'File not found'
                    ];
                }
            }
            
            return $results;
        } catch (\Exception $e) {
            Log::error('Failed to set file permissions', [
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get OpenSSL version
     */
    public function getOpenSSLVersion()
    {
        try {
            $command = "openssl version";
            $version = shell_exec($command);
            
            return [
                'success' => true,
                'version' => trim($version)
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Generate test signature for validation
     */
    public function generateTestSignature($data = 'test')
    {
        try {
            $privateKeyPath = base_path($this->privateKeyPath);
            
            if (!File::exists($privateKeyPath)) {
                throw new \Exception('Private key not found');
            }
            
            $privateKey = file_get_contents($privateKeyPath);
            $pkeyid = openssl_get_privatekey($privateKey);
            
            if (!$pkeyid) {
                throw new \Exception('Failed to load private key');
            }
            
            $binarySignature = '';
            $result = openssl_sign($data, $binarySignature, $pkeyid, OPENSSL_ALGO_SHA1);
            
            if (!$result) {
                throw new \Exception('Failed to generate signature');
            }
            
            $signature = strtoupper(bin2hex($binarySignature));
            
            return [
                'success' => true,
                'signature' => $signature,
                'data' => $data
            ];
        } catch (\Exception $e) {
            Log::error('Failed to generate test signature', [
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
} 