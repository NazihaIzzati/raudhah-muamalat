#!/bin/bash

# Paynet FPX Key Generation Script
# Based on official Paynet documentation: https://docs.developer.paynet.my/docs/fpx/key-management

set -e

echo "🔐 Paynet FPX Key Generation Script"
echo "=================================="

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

# Create ssh-keygen directory if it doesn't exist
KEY_DIR="ssh-keygen"
if [ ! -d "$KEY_DIR" ]; then
    mkdir -p "$KEY_DIR"
    print_status "Created directory: $KEY_DIR"
else
    print_status "Directory exists: $KEY_DIR"
fi

# Check if private key already exists
PRIVATE_KEY="$KEY_DIR/merchant_private.key"
if [ -f "$PRIVATE_KEY" ]; then
    print_warning "Private key already exists: $PRIVATE_KEY"
    read -p "Do you want to overwrite it? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        print_info "Skipping private key generation"
    else
        print_info "Overwriting existing private key..."
        rm "$PRIVATE_KEY"
    fi
fi

# Generate private key if it doesn't exist or user wants to overwrite
if [ ! -f "$PRIVATE_KEY" ]; then
    print_info "Generating 2048-bit RSA private key..."
    openssl genrsa -out "$PRIVATE_KEY" 2048
    
    if [ $? -eq 0 ]; then
        print_status "Private key generated successfully"
        chmod 600 "$PRIVATE_KEY"
        print_status "Set private key permissions to 600"
    else
        print_error "Failed to generate private key"
        exit 1
    fi
fi

# Check if CSR already exists
CSR_FILE="$KEY_DIR/merchant_csr.csr"
if [ -f "$CSR_FILE" ]; then
    print_warning "CSR file already exists: $CSR_FILE"
    read -p "Do you want to overwrite it? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        print_info "Skipping CSR generation"
    else
        print_info "Overwriting existing CSR..."
        rm "$CSR_FILE"
    fi
fi

# Generate CSR if it doesn't exist or user wants to overwrite
if [ ! -f "$CSR_FILE" ]; then
    print_info "Generating Certificate Signing Request (CSR)..."
    print_info "You will be prompted for certificate information."
    print_info "Press Enter to use defaults or provide your information:"
    echo
    
    openssl req -out "$CSR_FILE" -key "$PRIVATE_KEY" -new -sha256
    
    if [ $? -eq 0 ]; then
        print_status "CSR generated successfully"
        chmod 644 "$CSR_FILE"
        print_status "Set CSR permissions to 644"
    else
        print_error "Failed to generate CSR"
        exit 1
    fi
fi

# Validate the generated files
echo
print_info "Validating generated files..."

# Check private key
if openssl rsa -in "$PRIVATE_KEY" -check -noout &> /dev/null; then
    print_status "Private key is valid"
else
    print_error "Private key validation failed"
    exit 1
fi

# Check CSR
if openssl req -in "$CSR_FILE" -text -noout &> /dev/null; then
    print_status "CSR is valid"
else
    print_error "CSR validation failed"
    exit 1
fi

# Display file information
echo
print_info "Generated files:"
echo "  📁 Private Key: $PRIVATE_KEY"
echo "  📁 CSR File: $CSR_FILE"
echo
print_info "File sizes:"
ls -lh "$PRIVATE_KEY" "$CSR_FILE"

echo
print_info "Next steps:"
echo "  1. Submit the CSR file to Paynet:"
echo "     - UAT: Paynet Developer Portal"
echo "     - Production: MSC Trustgate"
echo "  2. Download your approved certificate"
echo "  3. Download Paynet's public certificate"
echo "  4. Update your .env file with certificate paths"
echo
print_info "Environment variables to add to .env:"
echo "  PAYNET_PRIVATE_KEY_PATH=ssh-keygen/merchant_private.key"
echo "  PAYNET_PUBLIC_CERT_PATH=ssh-keygen/paynet_public.cer"
echo "  PAYNET_MERCHANT_CERT_PATH=ssh-keygen/merchant_certificate.cer"
echo
print_warning "IMPORTANT: Keep your private key secure and never share it!"
print_warning "Backup your private key and certificates securely."

echo
print_status "Key generation completed successfully! 🎉" 