# FPX Environment Variables & Configuration Documentation

## Overview
This document outlines all environment variables, configuration values, and sensitive data required for FPX payment gateway integration based on the JariahFund project implementation.

## 🔐 **Sensitive Data & Security Credentials**

### **FPX Account Credentials**
```bash
# FPX Merchant Account Details
FPX_SELLER_EX_ID=EX00010946          # Primary Seller Exchange ID
FPX_SELLER_EX_ID_ALT=EX00011382      # Alternative Seller Exchange ID
FPX_SELLER_ID=SE00039889             # Primary Seller ID
FPX_SELLER_ID_ALT=SE00012894         # Alternative Seller ID
FPX_SELLER_BANK_CODE=01              # Seller Bank Code
FPX_VERSION=7.0                      # FPX Protocol Version
FPX_CURRENCY=MYR                     # Transaction Currency
```

### **PAYNET Integration Credentials**
```bash
# PAYNET Merchant Account Details (PROVIDED BY PAYNET)
PAYNET_MERCHANT_KEY=your-paynet-merchant-key-here    # PAYNET Merchant Authentication Key
PAYNET_API_BASE_URL=https://api.paynet.com.my        # PAYNET API Base URL
PAYNET_ENVIRONMENT=production                         # Environment: production/sandbox
PAYNET_SERVICE_ENDPOINTS={"fpx":"/api/v1/fpx","duitnow":"/api/v1/duitnow"}  # Service endpoints

# PAYNET Service-Specific IDs (PROVIDED BY PAYNET)
PAYNET_DUITNOW_RECIPIENT_ID=your-duitnow-recipient-id    # DuitNow recipient ID
PAYNET_JOMPAY_BILL_CODE=your-jompay-bill-code            # JomPAY bill code
PAYNET_MEPS_ACCOUNT_ID=your-meps-account-id              # MEPS account ID
```

### **RSA Key Files**
```bash
# RSA Private Keys (Critical Security Files)
FPX_PRIVATE_KEY_PATH=EX00010946.key  # Primary RSA private key
FPX_PRIVATE_KEY_ALT=EX00011382.key   # Alternative RSA private key
FPX_CERTIFICATE_PATH=EX00010946.cer  # Certificate file
```

### **FPX Gateway URLs**
```bash
# Production FPX Gateway URLs
FPX_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
FPX_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList
```

## 📧 **Email Configuration**

### **SendGrid Email Settings**
```bash
# SendGrid SMTP Configuration
EMAIL_BACKEND=django.core.mail.backends.smtp.EmailBackend
EMAIL_HOST=smtp.sendgrid.net
EMAIL_PORT=465
EMAIL_USE_TLS=False
EMAIL_USE_SSL=True
EMAIL_HOST_USER=apikey
EMAIL_HOST_PASSWORD=YOUR_SENDGRID_API_KEY_HERE
DEFAULT_FROM_EMAIL=jariahfund@muamalat.com.my
```

### **Email Recipients**
```bash
# Admin Email Addresses
ADMIN_EMAIL=JariahFund@muamalat.com.my
SERVER_EMAIL=jariahfund@muamalat.com.my
COMMENTS_XTD_FROM_EMAIL=noreply@example.com
COMMENTS_XTD_CONTACT_EMAIL=helpdesk@example.com
```

## 🗄️ **Database Configuration**

### **Development Database**
```bash
# SQLite Database (Development)
DATABASE_ENGINE=django.db.backends.sqlite3
DATABASE_NAME=/db/db.sqlite3
```

### **Production Database (Commented Out)**
```bash
# MySQL Database (Production - Uncomment when needed)
# DATABASE_ENGINE=django.db.backends.mysql
# DATABASE_HOST=localhost
# DATABASE_NAME=JariahFund
# DATABASE_USER=JariahFund
# DATABASE_PASSWORD=
# DATABASE_SSL_CA=/path/to/certificate-authority.pem
```

## 🔑 **Django Security Settings**

### **Secret Keys**
```bash
# Django Secret Key (CRITICAL - Change in production)
SECRET_KEY=YOUR_DJANGO_SECRET_KEY_HERE
```

### **Security Headers**
```bash
# SSL/HTTPS Configuration
SECURE_PROXY_SSL_HEADER=('HTTP_X_FORWARDED_PROTO', 'https')
SECURE_SSL_REDIRECT=True
SESSION_COOKIE_SECURE=True
CSRF_COOKIE_SECURE=True
```

### **Host Configuration**
```bash
# Allowed Hosts
ALLOWED_HOSTS=['*']  # WARNING: Too permissive for production
```

## 🌐 **Application Settings**

### **Django Configuration**
```bash
# Basic Django Settings
DEBUG=False
SITE_ID=1
TIME_ZONE=Asia/Kuala_Lumpur
LANGUAGE_CODE=en-us
USE_I18N=True
USE_L10N=True
USE_TZ=True
```

### **Wagtail CMS Settings**
```bash
# Wagtail Configuration
WAGTAIL_SITE_NAME=Jariah Fund
WAGTAIL_ENABLE_UPDATE_CHECK=False
BASE_URL=http://localhost
WAGTAIL_CACHE=False
```

### **Static & Media Files**
```bash
# File Storage Configuration
STATIC_ROOT=/code/static
STATIC_URL=/static/
MEDIA_ROOT=/code/media
MEDIA_URL=/media/
```

## 🔐 **Authentication & User Management**

### **User Model & Authentication**
```bash
# Custom User Model
AUTH_USER_MODEL=user.User
LOGIN_URL=/login/
LOGIN_REDIRECT_URL=/
```

### **AllAuth Configuration**
```bash
# AllAuth Settings
ACCOUNT_AUTHENTICATION_METHOD=username_email
ACCOUNT_CONFIRM_EMAIL_ON_GET=True
ACCOUNT_EMAIL_REQUIRED=True
ACCOUNT_EMAIL_VERIFICATION=none
ACCOUNT_LOGIN_ON_EMAIL_CONFIRMATION=True
ACCOUNT_LOGOUT_ON_GET=True
ACCOUNT_LOGIN_ON_PASSWORD_RESET=True
ACCOUNT_LOGOUT_REDIRECT_URL=/
ACCOUNT_PRESERVE_USERNAME_CASING=False
ACCOUNT_SESSION_REMEMBER=True
ACCOUNT_SIGNUP_PASSWORD_ENTER_TWICE=True
ACCOUNT_USERNAME_BLACKLIST=["admin", "god"]
ACCOUNT_USERNAME_MIN_LENGTH=2
ACCOUNT_SIGNUP_FORM_CLASS=user.forms.SignupForm
```

### **Comments Configuration**
```bash
# Comments System
COMMENTS_APP=django_comments_xtd
COMMENTS_XTD_SALT=b"Timendi causa est nescire. Aequam memento rebus in arduis servare mentem."
COMMENTS_XTD_MAX_THREAD_LEVEL=1
COMMENTS_XTD_CONFIRM_EMAIL=True
COMMENTS_XTD_LIST_ORDER=('-thread_id', 'order')
```

## 📦 **Dependencies & Packages**

### **Python Dependencies**
```bash
# Core Framework
Django==4.1.12
Wagtail==4.2.4

# FPX Integration
pycryptodome==3.19.0
requests==2.31.0

# Forms & UI
django-crispy-forms==2.0
crispy-bootstrap4==2022.1
crispy-bootstrap5==0.7
django-bootstrap4==23.2
django-bootstrap5==22.2

# Authentication
django-allauth==0.57.0

# Comments
django-comments-xtd==2.9.10
django-contrib-comments==2.2.0

# Utilities
django-import-export==3.3.1
django-maintenance-mode==0.19.0
django-password-validators==1.7.1
django-taggit==3.1.0
django-widget-tweaks==1.5.0

# CMS & Content
coderedcms==2.0.0
wagtail-cache==2.3.0
wagtail-seo==2.4.0
wagtailfontawesome==1.2.1
```

## 🐳 **Docker Configuration**

### **Docker Environment Variables**
```bash
# Docker Runtime Configuration
PYTHONUNBUFFERED=1
DJANGO_ENV=dev
```

### **Docker User Configuration**
```bash
# Docker User Setup
DOCKER_USER_ID=996
DOCKER_GROUP_ID=995
DOCKER_USER=coderedcms
```

## 📋 **Environment-Specific Configuration**

### **Development Environment (.env.dev)**
```bash
# =============================================================================
# DEVELOPMENT ENVIRONMENT CONFIGURATION
# =============================================================================

# Environment Type
DJANGO_ENV=development
DEBUG=True
ALLOWED_HOSTS=localhost,127.0.0.1

# FPX Configuration (Development)
FPX_SELLER_EX_ID=EX00010946
FPX_SELLER_ID=SE00039889
FPX_SELLER_BANK_CODE=01
FPX_VERSION=7.0
FPX_CURRENCY=MYR

# FPX Gateway URLs (Development)
FPX_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
FPX_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList

# RSA Key Files (Development)
FPX_PRIVATE_KEY_PATH=EX00010946.key
FPX_CERTIFICATE_PATH=EX00010946.cer

# PAYNET Configuration (Development)
PAYNET_MERCHANT_KEY=dev_paynet_merchant_key_here
PAYNET_API_BASE_URL=https://api-dev.paynet.com.my
PAYNET_ENVIRONMENT=sandbox
PAYNET_SERVICE_ENDPOINTS={"fpx":"/api/v1/fpx","duitnow":"/api/v1/duitnow"}

# Database Configuration (Development)
DATABASE_ENGINE=django.db.backends.sqlite3
DATABASE_NAME=/db/db.sqlite3

# Email Configuration (Development)
EMAIL_BACKEND=django.core.mail.backends.console.EmailBackend
DEFAULT_FROM_EMAIL=dev@jariahfund.com.my

# Security Settings (Development)
SECRET_KEY=dev-secret-key-change-in-production
SECURE_SSL_REDIRECT=False
SESSION_COOKIE_SECURE=False
CSRF_COOKIE_SECURE=False
```

### **UAT Environment (.env.uat)**
```bash
# =============================================================================
# UAT ENVIRONMENT CONFIGURATION
# =============================================================================

# Environment Type
DJANGO_ENV=uat
DEBUG=False
ALLOWED_HOSTS=uat.jariahfund.com.my,uat-api.jariahfund.com.my

# FPX Configuration (UAT)
FPX_SELLER_EX_ID=EX00010946
FPX_SELLER_ID=SE00039889
FPX_SELLER_BANK_CODE=01
FPX_VERSION=7.0
FPX_CURRENCY=MYR

# FPX Gateway URLs (UAT - Same as Production)
FPX_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
FPX_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList

# RSA Key Files (UAT)
FPX_PRIVATE_KEY_PATH=/secure/keys/uat/EX00010946.key
FPX_CERTIFICATE_PATH=/secure/certs/uat/EX00010946.cer

# PAYNET Configuration (UAT)
PAYNET_MERCHANT_KEY=uat_paynet_merchant_key_here
PAYNET_API_BASE_URL=https://api-uat.paynet.com.my
PAYNET_ENVIRONMENT=uat
PAYNET_SERVICE_ENDPOINTS={"fpx":"/api/v1/fpx","duitnow":"/api/v1/duitnow"}

# PAYNET Service-Specific IDs (UAT)
PAYNET_DUITNOW_RECIPIENT_ID=uat_duitnow_recipient_123
PAYNET_JOMPAY_BILL_CODE=uat_jompay_bill_456
PAYNET_MEPS_ACCOUNT_ID=uat_meps_account_789

# Database Configuration (UAT)
DATABASE_ENGINE=django.db.backends.mysql
DATABASE_HOST=uat-db.jariahfund.com.my
DATABASE_NAME=JariahFund_UAT
DATABASE_USER=JariahFund_UAT
DATABASE_PASSWORD=uat_secure_password_here
DATABASE_SSL_CA=/path/to/uat/certificate-authority.pem

# Email Configuration (UAT)
EMAIL_BACKEND=django.core.mail.backends.smtp.EmailBackend
EMAIL_HOST=smtp.sendgrid.net
EMAIL_PORT=465
EMAIL_USE_TLS=False
EMAIL_USE_SSL=True
EMAIL_HOST_USER=apikey
EMAIL_HOST_PASSWORD=SG.uat_sendgrid_api_key_here
DEFAULT_FROM_EMAIL=uat@jariahfund.com.my

# Security Settings (UAT)
SECRET_KEY=uat-secret-key-change-in-production
SECURE_SSL_REDIRECT=True
SESSION_COOKIE_SECURE=True
CSRF_COOKIE_SECURE=True
SECURE_PROXY_SSL_HEADER=('HTTP_X_FORWARDED_PROTO', 'https')

# Monitoring & Logging (UAT)
LOG_LEVEL=INFO
LOG_FILE=/var/log/django/uat-app.log
SENTRY_DSN=https://uat-sentry-dsn-here
```

### **Production Environment (.env.prod)**
```bash
# =============================================================================
# PRODUCTION ENVIRONMENT CONFIGURATION
# =============================================================================

# Environment Type
DJANGO_ENV=production
DEBUG=False
ALLOWED_HOSTS=www.jariahfund.com.my,api.jariahfund.com.my

# FPX Configuration (Production)
FPX_SELLER_EX_ID=EX00010946
FPX_SELLER_ID=SE00039889
FPX_SELLER_BANK_CODE=01
FPX_VERSION=7.0
FPX_CURRENCY=MYR

# FPX Gateway URLs (Production)
FPX_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
FPX_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList

# RSA Key Files (Production)
FPX_PRIVATE_KEY_PATH=/secure/keys/prod/EX00010946.key
FPX_CERTIFICATE_PATH=/secure/certs/prod/EX00010946.cer

# PAYNET Configuration (Production)
PAYNET_MERCHANT_KEY=prod_paynet_merchant_key_here
PAYNET_API_BASE_URL=https://api.paynet.com.my
PAYNET_ENVIRONMENT=production
PAYNET_SERVICE_ENDPOINTS={"fpx":"/api/v1/fpx","duitnow":"/api/v1/duitnow"}

# PAYNET Service-Specific IDs (Production)
PAYNET_DUITNOW_RECIPIENT_ID=prod_duitnow_recipient_123
PAYNET_JOMPAY_BILL_CODE=prod_jompay_bill_456
PAYNET_MEPS_ACCOUNT_ID=prod_meps_account_789

# Database Configuration (Production)
DATABASE_ENGINE=django.db.backends.mysql
DATABASE_HOST=prod-db.jariahfund.com.my
DATABASE_NAME=JariahFund_Prod
DATABASE_USER=JariahFund_Prod
DATABASE_PASSWORD=prod_secure_password_here
DATABASE_SSL_CA=/path/to/prod/certificate-authority.pem

# Email Configuration (Production)
EMAIL_BACKEND=django.core.mail.backends.smtp.EmailBackend
EMAIL_HOST=smtp.sendgrid.net
EMAIL_PORT=465
EMAIL_USE_TLS=False
EMAIL_USE_SSL=True
EMAIL_HOST_USER=apikey
EMAIL_HOST_PASSWORD=SG.prod_sendgrid_api_key_here
DEFAULT_FROM_EMAIL=jariahfund@muamalat.com.my

# Security Settings (Production)
SECRET_KEY=prod-secret-key-change-in-production
SECURE_SSL_REDIRECT=True
SESSION_COOKIE_SECURE=True
CSRF_COOKIE_SECURE=True
SECURE_PROXY_SSL_HEADER=('HTTP_X_FORWARDED_PROTO', 'https')

# Monitoring & Logging (Production)
LOG_LEVEL=WARNING
LOG_FILE=/var/log/django/prod-app.log
SENTRY_DSN=https://prod-sentry-dsn-here
NEW_RELIC_LICENSE_KEY=prod_newrelic_key_here

# Performance & Caching (Production)
CACHE_URL=redis://prod-redis.jariahfund.com.my:6379/0
WAGTAIL_CACHE=True
```

## 📋 **Environment Variables Template**

```bash
# =============================================================================
# FPX PAYMENT GATEWAY CONFIGURATION
# =============================================================================

# FPX Account Credentials
FPX_SELLER_EX_ID=EX00010946
FPX_SELLER_ID=SE00039889
FPX_SELLER_BANK_CODE=01
FPX_VERSION=7.0
FPX_CURRENCY=MYR

# FPX Gateway URLs
FPX_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
FPX_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList

# RSA Key Files (Update paths as needed)
FPX_PRIVATE_KEY_PATH=EX00010946.key
FPX_CERTIFICATE_PATH=EX00010946.cer

# =============================================================================
# PAYNET INTEGRATION CONFIGURATION
# =============================================================================

# PAYNET Merchant Account Details (PROVIDED BY PAYNET)
PAYNET_MERCHANT_KEY=your-paynet-merchant-key-here
PAYNET_API_BASE_URL=https://api.paynet.com.my
PAYNET_ENVIRONMENT=production
PAYNET_SERVICE_ENDPOINTS={"fpx":"/api/v1/fpx","duitnow":"/api/v1/duitnow"}

# PAYNET Service-Specific IDs (PROVIDED BY PAYNET)
PAYNET_DUITNOW_RECIPIENT_ID=your-duitnow-recipient-id
PAYNET_JOMPAY_BILL_CODE=your-jompay-bill-code
PAYNET_MEPS_ACCOUNT_ID=your-meps-account-id

# PAYNET Security Settings (SYSTEM CONFIGURED)
PAYNET_KEY_ROTATION_INTERVAL=90
PAYNET_REQUEST_TIMEOUT=30
PAYNET_MAX_RETRIES=3

# =============================================================================
# DJANGO SECURITY SETTINGS
# =============================================================================

# Change this in production!
SECRET_KEY=your-secret-key-here
DEBUG=False
ALLOWED_HOSTS=localhost,127.0.0.1,your-domain.com

# SSL/HTTPS Settings
SECURE_SSL_REDIRECT=True
SESSION_COOKIE_SECURE=True
CSRF_COOKIE_SECURE=True

# =============================================================================
# DATABASE CONFIGURATION
# =============================================================================

# Development (SQLite)
DATABASE_ENGINE=django.db.backends.sqlite3
DATABASE_NAME=/db/db.sqlite3

# Production (MySQL) - Uncomment and configure
# DATABASE_ENGINE=django.db.backends.mysql
# DATABASE_HOST=localhost
# DATABASE_NAME=your_database_name
# DATABASE_USER=your_database_user
# DATABASE_PASSWORD=your_database_password

# =============================================================================
# EMAIL CONFIGURATION
# =============================================================================

# SendGrid Configuration
EMAIL_BACKEND=django.core.mail.backends.smtp.EmailBackend
EMAIL_HOST=smtp.sendgrid.net
EMAIL_PORT=465
EMAIL_USE_TLS=False
EMAIL_USE_SSL=True
EMAIL_HOST_USER=apikey
EMAIL_HOST_PASSWORD=your-sendgrid-api-key
DEFAULT_FROM_EMAIL=your-email@domain.com

# Admin Email
ADMIN_EMAIL=admin@domain.com
SERVER_EMAIL=noreply@domain.com

# =============================================================================
# APPLICATION SETTINGS
# =============================================================================

# Django Settings
SITE_ID=1
TIME_ZONE=Asia/Kuala_Lumpur
LANGUAGE_CODE=en-us

# Wagtail Settings
WAGTAIL_SITE_NAME=Your Site Name
BASE_URL=https://your-domain.com

# =============================================================================
# DOCKER CONFIGURATION
# =============================================================================

PYTHONUNBUFFERED=1
DJANGO_ENV=production
```

## 🔧 **Configuration Management**

### **Settings Structure**
```python
# settings/base.py - Base configuration
# settings/dev.py - Development settings
# settings/uat.py - UAT settings
# settings/prod.py - Production settings
# settings/local_settings.py - Local overrides (gitignored)
```

### **Environment-Specific Settings Files**

#### **Development Settings (settings/dev.py)**
```python
from .base import *

# Environment
DJANGO_ENV = 'development'
DEBUG = True
ALLOWED_HOSTS = ['localhost', '127.0.0.1']

# Database (SQLite for development)
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.sqlite3',
        'NAME': '/db/db.sqlite3',
    }
}

# Email (Console backend for development)
EMAIL_BACKEND = 'django.core.mail.backends.console.EmailBackend'
DEFAULT_FROM_EMAIL = 'dev@jariahfund.com.my'

# Security (Relaxed for development)
SECURE_SSL_REDIRECT = False
SESSION_COOKIE_SECURE = False
CSRF_COOKIE_SECURE = False

# FPX Configuration (Development)
FPX_SETTINGS = {
    'SELLER_EX_ID': 'EX00010946',
    'SELLER_ID': 'SE00039889',
    'SELLER_BANK_CODE': '01',
    'PRIVATE_KEY_PATH': 'EX00010946.key',
    'FPX_VERSION': '7.0',
    'CURRENCY': 'MYR',
    'GATEWAY_URL': 'https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp',
    'BANK_LIST_URL': 'https://www.mepsfpx.com.my/FPXMain/RetrieveBankList',
}

# PAYNET Configuration (Development)
PAYNET_SETTINGS = {
    'MERCHANT_KEY': 'dev_paynet_merchant_key_here',
    'API_BASE_URL': 'https://api-dev.paynet.com.my',
    'ENVIRONMENT': 'sandbox',
    'SERVICE_ENDPOINTS': {
        'fpx': '/api/v1/fpx',
        'duitnow': '/api/v1/duitnow'
    }
}

# Logging (Development)
LOGGING = {
    'version': 1,
    'disable_existing_loggers': False,
    'handlers': {
        'console': {
            'class': 'logging.StreamHandler',
        },
    },
    'root': {
        'handlers': ['console'],
        'level': 'DEBUG',
    },
}
```

#### **UAT Settings (settings/uat.py)**
```python
from .base import *

# Environment
DJANGO_ENV = 'uat'
DEBUG = False
ALLOWED_HOSTS = ['uat.jariahfund.com.my', 'uat-api.jariahfund.com.my']

# Database (MySQL for UAT)
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.mysql',
        'HOST': 'uat-db.jariahfund.com.my',
        'NAME': 'JariahFund_UAT',
        'USER': 'JariahFund_UAT',
        'PASSWORD': 'uat_secure_password_here',
        'OPTIONS': {
            'ssl': {'ca': '/path/to/uat/certificate-authority.pem'}
        }
    }
}

# Email (SendGrid for UAT)
EMAIL_BACKEND = 'django.core.mail.backends.smtp.EmailBackend'
EMAIL_HOST = 'smtp.sendgrid.net'
EMAIL_PORT = 465
EMAIL_USE_TLS = False
EMAIL_USE_SSL = True
EMAIL_HOST_USER = 'apikey'
EMAIL_HOST_PASSWORD = 'SG.uat_sendgrid_api_key_here'
DEFAULT_FROM_EMAIL = 'uat@jariahfund.com.my'

# Security (Production-like for UAT)
SECURE_SSL_REDIRECT = True
SESSION_COOKIE_SECURE = True
CSRF_COOKIE_SECURE = True
SECURE_PROXY_SSL_HEADER = ('HTTP_X_FORWARDED_PROTO', 'https')

# FPX Configuration (UAT)
FPX_SETTINGS = {
    'SELLER_EX_ID': 'EX00010946',
    'SELLER_ID': 'SE00039889',
    'SELLER_BANK_CODE': '01',
    'PRIVATE_KEY_PATH': '/secure/keys/uat/EX00010946.key',
    'FPX_VERSION': '7.0',
    'CURRENCY': 'MYR',
    'GATEWAY_URL': 'https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp',
    'BANK_LIST_URL': 'https://www.mepsfpx.com.my/FPXMain/RetrieveBankList',
}

# PAYNET Configuration (UAT)
PAYNET_SETTINGS = {
    'MERCHANT_KEY': 'uat_paynet_merchant_key_here',
    'API_BASE_URL': 'https://api-uat.paynet.com.my',
    'ENVIRONMENT': 'uat',
    'SERVICE_ENDPOINTS': {
        'fpx': '/api/v1/fpx',
        'duitnow': '/api/v1/duitnow'
    },
    'DUITNOW_RECIPIENT_ID': 'uat_duitnow_recipient_123',
    'JOMPAY_BILL_CODE': 'uat_jompay_bill_456',
    'MEPS_ACCOUNT_ID': 'uat_meps_account_789'
}

# Monitoring & Logging (UAT)
LOGGING = {
    'version': 1,
    'disable_existing_loggers': False,
    'handlers': {
        'file': {
            'class': 'logging.FileHandler',
            'filename': '/var/log/django/uat-app.log',
        },
        'sentry': {
            'class': 'raven.contrib.django.handlers.SentryHandler',
        },
    },
    'root': {
        'handlers': ['file', 'sentry'],
        'level': 'INFO',
    },
}

# Sentry Configuration (UAT)
SENTRY_DSN = 'https://uat-sentry-dsn-here'
```

#### **Production Settings (settings/prod.py)**
```python
from .base import *

# Environment
DJANGO_ENV = 'production'
DEBUG = False
ALLOWED_HOSTS = ['www.jariahfund.com.my', 'api.jariahfund.com.my']

# Database (MySQL for Production)
DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.mysql',
        'HOST': 'prod-db.jariahfund.com.my',
        'NAME': 'JariahFund_Prod',
        'USER': 'JariahFund_Prod',
        'PASSWORD': 'prod_secure_password_here',
        'OPTIONS': {
            'ssl': {'ca': '/path/to/prod/certificate-authority.pem'}
        }
    }
}

# Email (SendGrid for Production)
EMAIL_BACKEND = 'django.core.mail.backends.smtp.EmailBackend'
EMAIL_HOST = 'smtp.sendgrid.net'
EMAIL_PORT = 465
EMAIL_USE_TLS = False
EMAIL_USE_SSL = True
EMAIL_HOST_USER = 'apikey'
EMAIL_HOST_PASSWORD = 'SG.prod_sendgrid_api_key_here'
DEFAULT_FROM_EMAIL = 'jariahfund@muamalat.com.my'

# Security (Production)
SECURE_SSL_REDIRECT = True
SESSION_COOKIE_SECURE = True
CSRF_COOKIE_SECURE = True
SECURE_PROXY_SSL_HEADER = ('HTTP_X_FORWARDED_PROTO', 'https')

# FPX Configuration (Production)
FPX_SETTINGS = {
    'SELLER_EX_ID': 'EX00010946',
    'SELLER_ID': 'SE00039889',
    'SELLER_BANK_CODE': '01',
    'PRIVATE_KEY_PATH': '/secure/keys/prod/EX00010946.key',
    'FPX_VERSION': '7.0',
    'CURRENCY': 'MYR',
    'GATEWAY_URL': 'https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp',
    'BANK_LIST_URL': 'https://www.mepsfpx.com.my/FPXMain/RetrieveBankList',
}

# PAYNET Configuration (Production)
PAYNET_SETTINGS = {
    'MERCHANT_KEY': 'prod_paynet_merchant_key_here',
    'API_BASE_URL': 'https://api.paynet.com.my',
    'ENVIRONMENT': 'production',
    'SERVICE_ENDPOINTS': {
        'fpx': '/api/v1/fpx',
        'duitnow': '/api/v1/duitnow'
    },
    'DUITNOW_RECIPIENT_ID': 'prod_duitnow_recipient_123',
    'JOMPAY_BILL_CODE': 'prod_jompay_bill_456',
    'MEPS_ACCOUNT_ID': 'prod_meps_account_789'
}

# Monitoring & Logging (Production)
LOGGING = {
    'version': 1,
    'disable_existing_loggers': False,
    'handlers': {
        'file': {
            'class': 'logging.FileHandler',
            'filename': '/var/log/django/prod-app.log',
        },
        'sentry': {
            'class': 'raven.contrib.django.handlers.SentryHandler',
        },
    },
    'root': {
        'handlers': ['file', 'sentry'],
        'level': 'WARNING',
    },
}

# Sentry Configuration (Production)
SENTRY_DSN = 'https://prod-sentry-dsn-here'

# New Relic Configuration (Production)
NEW_RELIC_LICENSE_KEY = 'prod_newrelic_key_here'

# Performance & Caching (Production)
CACHES = {
    'default': {
        'BACKEND': 'django_redis.cache.RedisCache',
        'LOCATION': 'redis://prod-redis.jariahfund.com.my:6379/0',
        'OPTIONS': {
            'CLIENT_CLASS': 'django_redis.client.DefaultClient',
        }
    }
}

# Wagtail Cache (Production)
WAGTAIL_CACHE = True
```

### **Environment-Specific Settings**

#### **Development Environment**
```python
# settings/dev.py
DEBUG = False  # Set to True for development
EMAIL_BACKEND = 'django.core.mail.backends.smtp.EmailBackend'
WAGTAIL_CACHE = False
```

#### **Production Environment**
```python
# settings/prod.py
DEBUG = False
EMAIL_BACKEND = 'django_sendmail_backend.backends.EmailBackend'
WAGTAIL_CACHE = False
```

## 🚨 **Security Best Practices**

### **Critical Security Notes**
1. **NEVER commit sensitive data to version control**
2. **Use environment variables for all secrets**
3. **Rotate keys and passwords regularly**
4. **Use strong, unique passwords**
5. **Enable HTTPS in production**
6. **Restrict ALLOWED_HOSTS in production**

### **Required Security Updates**
```bash
# Change these values in production:
SECRET_KEY=generate-new-secret-key
ALLOWED_HOSTS=['your-domain.com']  # Don't use ['*']
EMAIL_HOST_PASSWORD=your-actual-sendgrid-key
FPX_PRIVATE_KEY_PATH=secure-path-to-key
```

## 📊 **Monitoring & Logging**

### **Recommended Environment Variables for Monitoring**
```bash
# Logging Configuration
LOG_LEVEL=INFO
LOG_FILE=/var/log/django/app.log

# Monitoring
SENTRY_DSN=your-sentry-dsn
NEW_RELIC_LICENSE_KEY=your-newrelic-key

# Performance
CACHE_URL=redis://localhost:6379/0
```

## 🔄 **Environment-Specific Deployment**

### **Development Deployment**
```bash
# Development Environment Setup
DJANGO_SETTINGS_MODULE=JariahFund.settings.dev
python manage.py runserver 0.0.0.0:8000

# Development Database
python manage.py migrate
python manage.py collectstatic --noinput

# Development Testing
python manage.py test
```

### **UAT Deployment**
```bash
# UAT Environment Setup
export DJANGO_SETTINGS_MODULE=JariahFund.settings.uat
export DJANGO_ENV=uat

# UAT Database Migration
python manage.py migrate --settings=JariahFund.settings.uat
python manage.py collectstatic --noinput --settings=JariahFund.settings.uat

# UAT Static Files
python manage.py compress --settings=JariahFund.settings.uat

# UAT Health Check
python manage.py check --deploy --settings=JariahFund.settings.uat
```

### **Production Deployment**
```bash
# Production Environment Setup
export DJANGO_SETTINGS_MODULE=JariahFund.settings.prod
export DJANGO_ENV=production

# Production Database Migration
python manage.py migrate --settings=JariahFund.settings.prod
python manage.py collectstatic --noinput --settings=JariahFund.settings.prod

# Production Static Files
python manage.py compress --settings=JariahFund.settings.prod

# Production Health Check
python manage.py check --deploy --settings=JariahFund.settings.prod

# Production Cache Warmup
python manage.py cache_warmup --settings=JariahFund.settings.prod
```

### **Docker Environment Configuration**
```bash
# Development Docker
docker-compose -f docker-compose.dev.yml up -d

# UAT Docker
docker-compose -f docker-compose.uat.yml up -d

# Production Docker
docker-compose -f docker-compose.prod.yml up -d
```

### **Environment-Specific Commands**
```bash
# Development Commands
DJANGO_ENV=dev python manage.py shell
DJANGO_ENV=dev python manage.py createsuperuser
DJANGO_ENV=dev python manage.py loaddata dev_data.json

# UAT Commands
DJANGO_ENV=uat python manage.py shell --settings=JariahFund.settings.uat
DJANGO_ENV=uat python manage.py createsuperuser --settings=JariahFund.settings.uat
DJANGO_ENV=uat python manage.py loaddata uat_data.json --settings=JariahFund.settings.uat

# Production Commands
DJANGO_ENV=prod python manage.py shell --settings=JariahFund.settings.prod
DJANGO_ENV=prod python manage.py createsuperuser --settings=JariahFund.settings.prod
DJANGO_ENV=prod python manage.py loaddata prod_data.json --settings=JariahFund.settings.prod
```

## 🔄 **Deployment Checklist**

### **Pre-Deployment**
- [ ] Update all sensitive credentials
- [ ] Configure production database
- [ ] Set up SSL certificates
- [ ] Configure email settings
- [ ] Update FPX credentials
- [ ] Test all payment flows

### **Post-Deployment**
- [ ] Verify HTTPS is working
- [ ] Test FPX payment flow
- [ ] Check email delivery
- [ ] Monitor error logs
- [ ] Set up backup procedures

## 📞 **Support Information**

### **FPX Support**
- **FPX Documentation**: https://www.mepsfpx.com.my/
- **Technical Support**: Contact FPX support team
- **Bank Integration**: Contact individual banks

### **Application Support**
- **Email**: JariahFund@muamalat.com.my
- **Server Email**: jariahfund@muamalat.com.my

---

**⚠️ IMPORTANT**: This document contains sensitive information. Ensure it's stored securely and not committed to public repositories. 