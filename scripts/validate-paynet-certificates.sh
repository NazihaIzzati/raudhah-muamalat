#!/bin/bash

# Paynet FPX Certificate Validation Script
# Based on official Paynet documentation: https://docs.developer.paynet.my/docs/fpx/key-management

set -e

echo "🔍 Paynet FPX Certificate Validation Script"
echo "=========================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✓${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_info() {
    echo -e "${BLUE}ℹ${NC} $1"
}

# Check if OpenSSL is installed
if ! command -v openssl &> /dev/null; then
    print_error "OpenSSL is not installed. Please install OpenSSL first."
    exit 1
fi

print_status "OpenSSL found: $(openssl version)"

# Define file paths
KEY_DIR="ssh-keygen"
PRIVATE_KEY="$KEY_DIR/merchant_private.key"
PUBLIC_CERT="$KEY_DIR/paynet_public.cer"
MERCHANT_CERT="$KEY_DIR/merchant_certificate.cer"
CSR_FILE="$KEY_DIR/merchant_csr.csr"

echo
print_info "Checking Paynet FPX certificates and keys..."

# Check if ssh-keygen directory exists
if [ ! -d "$KEY_DIR" ]; then
    print_error "ssh-keygen directory not found: $KEY_DIR"
    print_info "Run the key generation script first: ./scripts/generate-paynet-keys.sh"
    exit 1
fi

print_status "Directory exists: $KEY_DIR"

# Function to check file existence and permissions
check_file() {
    local file="$1"
    local description="$2"
    local expected_perms="$3"
    
    if [ -f "$file" ]; then
        print_status "$description exists: $file"
        
        # Check file size
        local size=$(stat -f%z "$file" 2>/dev/null || stat -c%s "$file" 2>/dev/null)
        print_info "  Size: ${size} bytes"
        
        # Check permissions
        local perms=$(stat -f%Lp "$file" 2>/dev/null || stat -c%a "$file" 2>/dev/null)
        print_info "  Permissions: $perms"
        
        if [ "$perms" != "$expected_perms" ]; then
            print_warning "  Expected permissions: $expected_perms"
            print_info "  Run: chmod $expected_perms $file"
        fi
        
        return 0
    else
        print_error "$description not found: $file"
        return 1
    fi
}

# Function to validate private key
validate_private_key() {
    local file="$1"
    if [ -f "$file" ]; then
        print_info "Validating private key..."
        if openssl rsa -in "$file" -check -noout &> /dev/null; then
            print_status "Private key is valid"
            return 0
        else
            print_error "Private key validation failed"
            return 1
        fi
    fi
    return 1
}

# Function to validate certificate
validate_certificate() {
    local file="$1"
    local description="$2"
    
    if [ -f "$file" ]; then
        print_info "Validating $description..."
        
        # Check if it's a valid certificate
        if openssl x509 -in "$file" -text -noout &> /dev/null; then
            print_status "$description is valid"
            
            # Get certificate expiry
            local expiry=$(openssl x509 -in "$file" -noout -enddate 2>/dev/null | cut -d= -f2)
            if [ ! -z "$expiry" ]; then
                print_info "  Expires: $expiry"
                
                # Check if certificate is expired
                local expiry_epoch=$(date -j -f "%b %d %H:%M:%S %Y %Z" "$expiry" +%s 2>/dev/null || date -d "$expiry" +%s 2>/dev/null)
                local current_epoch=$(date +%s)
                
                if [ $expiry_epoch -lt $current_epoch ]; then
                    print_error "  Certificate is EXPIRED!"
                else
                    local days_left=$(( (expiry_epoch - current_epoch) / 86400 ))
                    if [ $days_left -lt 30 ]; then
                        print_warning "  Certificate expires in $days_left days"
                    else
                        print_status "  Certificate expires in $days_left days"
                    fi
                fi
            fi
            
            # Get certificate subject
            local subject=$(openssl x509 -in "$file" -noout -subject 2>/dev/null | sed 's/subject=//')
            if [ ! -z "$subject" ]; then
                print_info "  Subject: $subject"
            fi
            
            return 0
        else
            print_error "$description validation failed"
            return 1
        fi
    fi
    return 1
}

# Function to validate CSR
validate_csr() {
    local file="$1"
    if [ -f "$file" ]; then
        print_info "Validating CSR..."
        if openssl req -in "$file" -text -noout &> /dev/null; then
            print_status "CSR is valid"
            
            # Get CSR subject
            local subject=$(openssl req -in "$file" -noout -subject 2>/dev/null | sed 's/subject=//')
            if [ ! -z "$subject" ]; then
                print_info "  Subject: $subject"
            fi
            
            return 0
        else
            print_error "CSR validation failed"
            return 1
        fi
    fi
    return 1
}

# Check all files
echo
print_info "Checking file existence and permissions..."

check_file "$PRIVATE_KEY" "Private key" "600"
check_file "$PUBLIC_CERT" "Paynet public certificate" "644"
check_file "$MERCHANT_CERT" "Merchant certificate" "644"
check_file "$CSR_FILE" "CSR file" "644"

# Validate files
echo
print_info "Validating file contents..."

validate_private_key "$PRIVATE_KEY"
validate_certificate "$PUBLIC_CERT" "Paynet public certificate"
validate_certificate "$MERCHANT_CERT" "Merchant certificate"
validate_csr "$CSR_FILE"

# Check environment variables
echo
print_info "Checking environment variables..."

check_env_var() {
    local var="$1"
    local value="${!var}"
    if [ ! -z "$value" ]; then
        print_status "$var is set"
        print_info "  Value: $value"
        
        # Check if file exists
        if [ -f "$value" ]; then
            print_status "  File exists: $value"
        else
            print_warning "  File not found: $value"
        fi
    else
        print_warning "$var is not set"
    fi
}

check_env_var "PAYNET_PRIVATE_KEY_PATH"
check_env_var "PAYNET_PUBLIC_CERT_PATH"
check_env_var "PAYNET_MERCHANT_CERT_PATH"

# List all files in ssh-keygen directory
echo
print_info "Files in $KEY_DIR directory:"
if [ -d "$KEY_DIR" ]; then
    ls -la "$KEY_DIR"
else
    print_error "Directory not found"
fi

# Summary
echo
print_info "Validation Summary:"
echo "===================="

# Count issues
issues=0
warnings=0

# Check for missing files
for file in "$PRIVATE_KEY" "$PUBLIC_CERT" "$MERCHANT_CERT"; do
    if [ ! -f "$file" ]; then
        ((issues++))
    fi
done

# Check for expired certificates
for cert in "$PUBLIC_CERT" "$MERCHANT_CERT"; do
    if [ -f "$cert" ]; then
        expiry=$(openssl x509 -in "$cert" -noout -enddate 2>/dev/null | cut -d= -f2)
        if [ ! -z "$expiry" ]; then
            expiry_epoch=$(date -j -f "%b %d %H:%M:%S %Y %Z" "$expiry" +%s 2>/dev/null || date -d "$expiry" +%s 2>/dev/null)
            current_epoch=$(date +%s)
            if [ $expiry_epoch -lt $current_epoch ]; then
                ((issues++))
            elif [ $(( (expiry_epoch - current_epoch) / 86400 )) -lt 30 ]; then
                ((warnings++))
            fi
        fi
    fi
done

if [ $issues -eq 0 ] && [ $warnings -eq 0 ]; then
    print_status "All certificates and keys are valid! 🎉"
elif [ $issues -eq 0 ]; then
    print_warning "Certificates are valid but some have warnings"
else
    print_error "Found $issues critical issues and $warnings warnings"
fi

echo
print_info "Recommendations:"
echo "=================="

if [ ! -f "$PRIVATE_KEY" ]; then
    print_info "• Generate private key: ./scripts/generate-paynet-keys.sh"
fi

if [ ! -f "$PUBLIC_CERT" ]; then
    print_info "• Download Paynet public certificate from Paynet Developer Portal"
fi

if [ ! -f "$MERCHANT_CERT" ]; then
    print_info "• Submit CSR to Paynet and download approved certificate"
fi

if [ ! -z "$(find "$KEY_DIR" -name "*.cer" -exec openssl x509 -in {} -noout -enddate \; 2>/dev/null | grep -E 'expired|EXPIRED')" ]; then
    print_info "• Renew expired certificates"
fi

echo
print_info "For more information, see: docs/paynet-key-management.md" 