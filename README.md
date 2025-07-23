# Raudhah Muamalat - Islamic Charity Platform

<p align="center">
<img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.1+-blue.svg" alt="PHP Version">
<img src="https://img.shields.io/badge/MySQL-8.0+-green.svg" alt="Database">
<img src="https://img.shields.io/badge/TailwindCSS-3.x-38B2AC.svg" alt="TailwindCSS">
<img src="https://img.shields.io/badge/Cardzone-3DS-orange.svg" alt="Payment Gateway">
</p>

## 🕌 About Raudhah Muamalat

Raudhah Muamalat is a comprehensive Islamic charity platform that enables secure online donations and fundraising campaigns. The platform integrates with Cardzone 3DS payment gateway to provide secure, Shariah-compliant payment processing for charitable giving.

### 🌟 Key Features

- **Multi-language Support**: English and Bahasa Malaysia
- **Campaign Management**: Create and manage fundraising campaigns
- **Secure Donations**: Cardzone 3DS payment integration
- **User Management**: Admin and donor user roles
- **Real-time Notifications**: Email and system notifications
- **Responsive Design**: Mobile-first approach with TailwindCSS
- **Admin Dashboard**: Comprehensive management interface
- **Event Management**: Islamic events and activities
- **Partner Management**: Charity partner organizations
- **FAQ System**: Help and support documentation

## 🛠 Technology Stack

### Backend
- **Framework**: Laravel 10.x
- **PHP**: 8.1+
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Breeze
- **Payment Gateway**: Cardzone 3DS

### Frontend
- **CSS Framework**: TailwindCSS 3.x
- **JavaScript**: Alpine.js
- **Icons**: UXWing Icon System
- **Responsive**: Mobile-first design

### Security
- **RSA Encryption**: 4096-bit key pairs
- **MAC Signing**: SHA256 algorithm
- **3DS Authentication**: Cardzone integration
- **Session Management**: Laravel sessions

## 📁 Project Structure

```
raudhah-muamalat/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # Admin controllers
│   │   ├── Auth/            # Authentication
│   │   └── Payment/         # Payment processing
│   ├── Models/              # Eloquent models
│   ├── Services/            # Business logic
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database schema
│   ├── seeders/             # Sample data
│   └── factories/           # Model factories
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript
├── ssh-keygen/              # RSA keys for Cardzone
├── docs/                    # Documentation
└── tests/                   # Test suites
```

## 🚀 Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Node.js and NPM
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mralif93/raudhah-muamalat.git
   cd raudhah-muamalat
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   ```bash
   # Update .env with your database credentials
   php artisan migrate
   php artisan db:seed
   ```

6. **Configure Cardzone integration**
   ```bash
   # Add Cardzone environment variables to .env
   CARDZONE_MERCHANT_ID=your_merchant_id
   CARDZONE_UAT_KEY_EXCHANGE_URL=https://3dsecureczuat.muamalat.com.my/3dss/mkReq
CARDZONE_UAT_MPIREQ_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpReq
CARDZONE_UAT_OBW_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpReqObw
CARDZONE_UAT_QR_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpQrReq
   CARDZONE_RESPONSE_URL=https://your-domain.com/payment/cardzone/callback
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔐 Key Management

### RSA Key Pair
The project uses a persistent RSA key pair for Cardzone integration:

- **Private Key**: `ssh-keygen/jariahfund-dev` (PEM format)
- **Public Key**: `ssh-keygen/jariahfund-dev_public.pem` (PEM format)
- **Key Size**: 2048-bit RSA (Cardzone requirement)
- **Usage**: MAC signing and data encryption

### Key Generation
```bash
# Generate 2048-bit RSA private key (Cardzone requirement)
openssl genrsa -out ssh-keygen/jariahfund-dev 2048

# Extract public key in PEM format
openssl rsa -in ssh-keygen/jariahfund-dev -pubout -out ssh-keygen/jariahfund-dev_public.pem
```

## 💳 Payment Integration

### Cardzone 3DS Integration
The platform integrates with Cardzone 3DS payment gateway for secure payment processing:

- **Supported Methods**: Credit/Debit Cards, Online Banking (OBW), QR Payments
- **Security**: RSA encryption, MAC signing, 3DS authentication
- **Compliance**: PCI DSS compliant payment processing

### Payment Flow
1. **Donation Creation**: User fills donation form
2. **Payment Initiation**: System generates transaction and performs key exchange
3. **3DS Authentication**: User completes authentication on Cardzone
4. **Callback Processing**: System verifies payment and updates status
5. **Completion**: User redirected to success/failure page

## 🧪 Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --filter=PaymentTest

# Run Cardzone integration test
php test_cardzone_integration.php
```

### Test Scripts
- `test_cardzone_integration.php` - Cardzone API verification
- `test_payment.php` - Payment flow testing
- `test_donation_redirect.php` - Donation redirect testing

## 📚 Documentation

### Project Documentation
- [Cardzone Integration Guide](docs/cardzone-integration.md)
- [Verification Report](docs/cardzone-verification-report.md)
- [Authentication Setup](docs/AUTHENTICATION_SETUP.md)
- [Seeders Guide](docs/SEEDERS-README.md)

### API Documentation
- **Payment API**: `/api/payment/process`
- **Bank List API**: `/api/banks`
- **Cardzone Callback**: `/payment/cardzone/callback`

## 🔧 Development

### Code Style
- Follow PSR-12 coding standards
- Use Laravel conventions
- Write comprehensive tests
- Document complex logic

### Database Migrations
```bash
# Create new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback
```

### Seeding Data
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=CampaignSeeder
```

## 🚀 Deployment

### Production Checklist
- [ ] Update environment variables for production
- [ ] Configure SSL certificates
- [ ] Set up monitoring and logging
- [ ] Configure Cardzone production endpoints
- [ ] Test payment flows thoroughly
- [ ] Set up backup procedures
- [ ] Configure error reporting

### Environment Variables
```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Cardzone Production URLs
CARDZONE_PRODUCTION_KEY_EXCHANGE_URL=https://3dsecurecz.muamalat.com.my/3dss/mkReq
CARDZONE_PRODUCTION_MPIREQ_URL=https://3dsecurecz.muamalat.com.my/3dss/mpReq
CARDZONE_PRODUCTION_OBW_URL=https://3dsecurecz.muamalat.com.my/3dss/mpReqObw
CARDZONE_PRODUCTION_QR_URL=https://3dsecurecz.muamalat.com.my/3dss/mpQrReq
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- **Documentation**: Check the [docs/](docs/) directory
- **Issues**: Create an issue on GitHub
- **Email**: Contact the development team

## 🙏 Acknowledgments

- **Laravel Framework** for the robust PHP framework
- **Cardzone** for secure payment processing
- **TailwindCSS** for the utility-first CSS framework
- **UXWing** for the icon system

---

**Built with ❤️ for the Islamic community**
