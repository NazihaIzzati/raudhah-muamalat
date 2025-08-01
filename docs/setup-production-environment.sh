#!/bin/bash

# Environment Setup Script for Jariah Fund
# This script sets up the production environment for FPX Paynet integration

echo "🚀 Setting up Environment for Jariah Fund"
echo ""

# Check if we're in the right directory
if [ ! -f "composer.json" ]; then
    echo "❌ Error: Please run this script from the project root directory"
    exit 1
fi

echo "📋 Step 1: Environment Configuration"
echo "   Creating production environment configuration..."

# Create production environment file
cat > .env.production << 'EOF'
# Production Environment Configuration for Jariah Fund

# Application Settings
APP_NAME="Jariah Fund"
APP_ENV=production
APP_KEY=base64:your-production-app-key-here
APP_DEBUG=false
APP_URL=https://your-production-domain.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jariah_fund_prod
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Paynet Production Configuration
PAYNET_ENVIRONMENT=production
PAYNET_PROD_API_URL=https://api.paynet.my
PAYNET_PROD_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
PAYNET_PROD_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList
PAYNET_PROD_REDIRECT_URL=https://www.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp
PAYNET_PROD_TERMS_URL=https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp
PAYNET_PROD_CALLBACK_URL=https://your-production-domain.com/payment/paynet/callback

# Paynet Production Credentials
PAYNET_PROD_MERCHANT_ID=your-production-merchant-id
PAYNET_PROD_MERCHANT_NAME="Jariah Fund"
PAYNET_PROD_PRIVATE_KEY_PATH=storage/keys/prod/merchant_private.key
PAYNET_PROD_PUBLIC_CERT_PATH=storage/keys/prod/paynet_public.cer
PAYNET_PROD_MERCHANT_CERT_PATH=storage/keys/prod/merchant_certificate.cer

# Paynet Production Settings
PAYNET_PROD_TIMEOUT=60
PAYNET_PROD_RETRY_ATTEMPTS=5
PAYNET_PROD_LOGGING_LEVEL=info

# Transaction Limits
PAYNET_MIN_AMOUNT=1.00
PAYNET_MAX_AMOUNT=50000.00

# Mail Configuration (for production)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-smtp-username
MAIL_PASSWORD=your-smtp-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-production-domain.com
MAIL_FROM_NAME="${APP_NAME}"

# Cache and Session
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Redis Configuration
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Logging
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=info

# Security
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict
EOF

echo "   ✅ Production environment file created: .env.production"
echo ""

echo "🔑 Step 2: Production Key Generation"
echo "   Creating production keys directory..."

# Create production keys directory
mkdir -p ssh-keygen/prod

echo "   Generating production merchant private key..."
openssl genrsa -out ssh-keygen/prod_merchant_private.key 2048

echo "   Generating production merchant certificate..."
openssl req -new -x509 -key ssh-keygen/prod_merchant_private.key -out ssh-keygen/prod_merchant_certificate.cer -days 365 -subj "/C=MY/ST=Kuala Lumpur/L=Kuala Lumpur/O=Jariah Fund/OU=IT/CN=jariahfund.com"

echo "   Creating production Paynet public certificate placeholder..."
echo "-----BEGIN CERTIFICATE-----" > ssh-keygen/prod_paynet_public.cer
echo "PLACEHOLDER: Replace with actual Paynet production public certificate" >> ssh-keygen/prod_paynet_public.cer
echo "-----END CERTIFICATE-----" >> ssh-keygen/prod_paynet_public.cer

echo "   ✅ Production keys generated"
echo ""

echo "📊 Step 3: Database Setup"
echo "   Running database migrations..."

# Run migrations
php artisan migrate --force

echo "   Seeding production data..."
php artisan db:seed --class=FpxBankSeeder

echo "   ✅ Database setup complete"
echo ""

echo "🧪 Step 4: Production Testing"
echo "   Testing production configuration..."

# Test production configuration
php artisan test:fpx-processing --detailed

echo "   ✅ Production tests completed"
echo ""

echo "📋 Step 5: Production Checklist"
echo ""
echo "   ⚠️  IMPORTANT: Manual steps required:"
echo ""
echo "   1. Update .env.production with your actual values:"
echo "      - APP_KEY (generate with: php artisan key:generate)"
echo "      - APP_URL (your production domain)"
echo "      - Database credentials"
echo "      - Mail configuration"
echo "      - PAYNET_PROD_MERCHANT_ID (from Paynet)"
echo ""
echo "   2. Replace placeholder certificates:"
echo "      - ssh-keygen/prod_paynet_public.cer (get from Paynet)"
echo "      - ssh-keygen/prod_merchant_certificate.cer (if needed)"
echo ""
echo "   3. Set proper file permissions:"
echo "      - chmod 600 ssh-keygen/prod_merchant_private.key"
echo "      - chmod 644 ssh-keygen/prod_merchant_certificate.cer"
echo "      - chmod 644 ssh-keygen/prod_paynet_public.cer"
echo ""
echo "   4. Configure web server:"
echo "      - Set document root to /public"
echo "      - Enable HTTPS"
echo "      - Configure SSL certificates"
echo ""
echo "   5. Set up monitoring:"
echo "      - Configure log rotation"
echo "      - Set up error monitoring"
echo "      - Configure backup system"
echo ""

echo "🎉 Production Environment Setup Complete!"
echo ""
echo "   Next steps:"
echo "   1. Review and update .env.production"
echo "   2. Deploy to production server"
echo "   3. Test payment flow"
echo "   4. Monitor logs and transactions"
echo ""
echo "   Commands for production:"
echo "   - php artisan fpx:show-bank-status --refresh"
echo "   - php artisan fpx:update-bank-status"
echo "   - php artisan test:fpx-processing"
echo "" 