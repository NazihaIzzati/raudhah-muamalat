# Paynet FPX Routes Guide

## 📋 **Overview**

This guide provides a comprehensive overview of the **Paynet FPX payment routes** organized by payment flow stages. The routes are designed to be intuitive and follow the natural payment processing flow.

## 🎯 **Route Organization Philosophy**

Routes are organized by **payment flow stages** rather than technical implementation, making it easy for developers to understand the payment process:

1. **Step 1**: Payment Initiation & Processing
2. **Step 2**: Payment Gateway Redirection  
3. **Step 3**: Payment Callback Processing
4. **Step 4**: Payment Results & Receipts

## 📊 **Route Structure**

### **🔹 Step 1: Payment Initiation & Processing**

**Purpose**: Initialize payment, get bank lists, process payment data

| Route | Method | Purpose | FPX Message |
|-------|--------|---------|-------------|
| `/fpx/process` | POST | Process FPX payment (AR message) | AR |
| `/fpx/page` | GET | Display payment page | - |
| `/fpx/banks` | GET | Get FPX bank list | - |
| `/fpx/banks/active` | GET | Get active FPX banks | - |
| `/fpx/banks/update-status` | POST | Update bank status | BE |
| `/fpx/banks/status-summary` | GET | Get bank status summary | - |

### **🔹 Step 2: Payment Gateway Redirection**

**Purpose**: Redirect user to FPX gateway for payment

| Route | Method | Purpose | FPX Message |
|-------|--------|---------|-------------|
| `/fpx/redirect` | GET | Redirect to FPX gateway | AR |
| `/fpx/test-connection` | GET | Test Paynet connection | - |

### **🔹 Step 3: Payment Callback Processing**

**Purpose**: Handle payment callbacks and status enquiries

| Route | Method | Purpose | FPX Message |
|-------|--------|---------|-------------|
| `/fpx/callback` | POST | Handle Paynet callback | AC |
| `/fpx/enquiry` | POST | Manual status enquiry | AE |
| `/fpx/history/{transaction_id}` | GET | View message history | - |

### **🔹 Step 4: Payment Results & Receipts**

**Purpose**: Display payment results and receipts

| Route | Method | Purpose | FPX Message |
|-------|--------|---------|-------------|
| `/fpx/success` | GET | Payment success page | - |
| `/fpx/failure` | GET | Payment failure page | - |
| `/fpx/receipt` | GET | Payment receipt | - |

## 🔄 **Payment Flow Examples**

### **Standard Payment Flow**

```mermaid
graph LR
    A[User selects FPX] --> B[/fpx/page]
    B --> C[Select bank] --> D[/fpx/process]
    D --> E[/fpx/redirect] --> F[FPX Gateway]
    F --> G[Bank Login] --> H[Payment Complete]
    H --> I[/fpx/callback] --> J[/fpx/success]
```

**Route Sequence:**
1. `GET /fpx/page` - Display payment page
2. `POST /fpx/process` - Process payment (AR message)
3. `GET /fpx/redirect` - Redirect to gateway
4. `POST /fpx/callback` - Handle callback (AC message)
5. `GET /fpx/success` - Show success page

### **Payment with Manual Enquiry**

```mermaid
graph LR
    A[Payment Processed] --> B[/fpx/callback]
    B --> C[Callback Failed] --> D[/fpx/enquiry]
    D --> E[Manual Check] --> F[/fpx/history/{id}]
```

**Route Sequence:**
1. `POST /fpx/process` - Process payment (AR message)
2. `POST /fpx/callback` - Handle callback (AC message)
3. `POST /fpx/enquiry` - Manual enquiry (AE message)
4. `GET /fpx/history/{id}` - View message history

## 📋 **Detailed Route Documentation**

### **🔸 Step 1: Payment Initiation & Processing**

#### **`POST /fpx/process`**
- **Purpose**: Process FPX payment and create AR message
- **Request**: Payment form data (amount, bank, donor info)
- **Response**: Payment processing result
- **FPX Message**: AR (Authorization Request)

```php
// Example request
POST /fpx/process
{
    "donation_id": "123",
    "amount": "100.00",
    "fpx_bank": "MB2U0227",
    "fpx_buyer_name": "John Doe",
    "fpx_buyer_email": "john@example.com"
}

// Example response
{
    "success": true,
    "message": "Payment processed successfully",
    "redirect_url": "/fpx/redirect",
    "transaction_id": "TXN123456789"
}
```

#### **`GET /fpx/page`**
- **Purpose**: Display FPX payment page
- **Request**: None
- **Response**: Payment page with bank selection

#### **`GET /fpx/banks`**
- **Purpose**: Get list of available FPX banks
- **Request**: None
- **Response**: JSON array of banks

```json
{
    "success": true,
    "banks": [
        {
            "code": "MB2U0227",
            "name": "Maybank",
            "status": "A"
        }
    ]
}
```

#### **`GET /fpx/banks/active`**
- **Purpose**: Get only active FPX banks
- **Request**: None
- **Response**: JSON array of active banks

#### **`POST /fpx/banks/update-status`**
- **Purpose**: Update bank status (BE message)
- **Request**: None
- **Response**: Bank status update result
- **FPX Message**: BE (Bank Enquiry)

#### **`GET /fpx/banks/status-summary`**
- **Purpose**: Get bank status summary
- **Request**: None
- **Response**: Bank status statistics

### **🔸 Step 2: Payment Gateway Redirection**

#### **`GET /fpx/redirect`**
- **Purpose**: Redirect user to FPX gateway
- **Request**: Transaction ID
- **Response**: Redirect to FPX gateway
- **FPX Message**: AR (Authorization Request)

#### **`GET /fpx/test-connection`**
- **Purpose**: Test Paynet connection
- **Request**: None
- **Response**: Connection test result

### **🔸 Step 3: Payment Callback Processing**

#### **`POST /fpx/callback`**
- **Purpose**: Handle Paynet callback (AC message)
- **Request**: Callback data from Paynet
- **Response**: OK (200)
- **FPX Message**: AC (Acknowledgement)

```php
// Example callback data
POST /fpx/callback
{
    "fpx_msgType": "AC",
    "fpx_debitAuthCode": "00",
    "fpx_fpxTxnId": "FPX987654321",
    "fpx_sellerExOrderNo": "TXN123456789"
}
```

#### **`POST /fpx/enquiry`**
- **Purpose**: Manual transaction status enquiry (AE message)
- **Request**: Transaction ID
- **Response**: Transaction status
- **FPX Message**: AE (Acknowledgement Enquiry)

```php
// Example request
POST /fpx/enquiry
{
    "transaction_id": "TXN123456789"
}

// Example response
{
    "success": true,
    "data": {
        "transaction_id": "TXN123456789",
        "response_code": "00",
        "status": "completed"
    }
}
```

#### **`GET /fpx/history/{transaction_id}`**
- **Purpose**: View complete FPX message history
- **Request**: Transaction ID in URL
- **Response**: Message history JSON

```json
{
    "success": true,
    "data": {
        "transaction_id": "TXN123456789",
        "messages": {
            "AR": { /* AR message data */ },
            "AC": { /* AC message data */ },
            "AE": { /* AE message data */ }
        },
        "fpx_info": {
            "message_sequence": "AR->AC->AE",
            "last_message_type": "AE"
        }
    }
}
```

### **🔸 Step 4: Payment Results & Receipts**

#### **`GET /fpx/success`**
- **Purpose**: Display payment success page
- **Request**: Transaction ID
- **Response**: Success page

#### **`GET /fpx/failure`**
- **Purpose**: Display payment failure page
- **Request**: Transaction ID
- **Response**: Failure page

#### **`GET /fpx/receipt`**
- **Purpose**: Display payment receipt
- **Request**: Transaction ID
- **Response**: Receipt page

## 🔗 **API Routes**

### **`/api/fpx/banks`**
- **Purpose**: Get FPX bank list (API endpoint)
- **Method**: GET
- **Response**: JSON bank list

### **`/api/fpx/banks/active`**
- **Purpose**: Get active FPX banks (API endpoint)
- **Method**: GET
- **Response**: JSON active banks

### **`/api/fpx/banks/update-status`**
- **Purpose**: Update bank status (API endpoint)
- **Method**: POST
- **Response**: Update result

### **`/api/fpx/banks/status-summary`**
- **Purpose**: Get bank status summary (API endpoint)
- **Method**: GET
- **Response**: Status summary



## 🧪 **Testing Routes**

### **Test Payment Flow**
```bash
# 1. Test payment page
curl -X GET http://localhost:8080/fpx/page

# 2. Test bank list
curl -X GET http://localhost:8080/fpx/banks

# 3. Test payment processing
curl -X POST http://localhost:8080/fpx/process \
  -H "Content-Type: application/json" \
  -d '{"donation_id": "123", "amount": "100.00", "fpx_bank": "MB2U0227"}'

# 4. Test connection
curl -X GET http://localhost:8080/fpx/test-connection

# 5. Test manual enquiry
curl -X POST http://localhost:8080/fpx/enquiry \
  -H "Content-Type: application/json" \
  -d '{"transaction_id": "TXN123456789"}'

# 6. Test message history
curl -X GET http://localhost:8080/fpx/history/TXN123456789
```

## 📊 **Route Summary Table**

| Stage | Route | Method | Purpose | FPX Message |
|-------|-------|--------|---------|-------------|
| **Initiation** | `/fpx/process` | POST | Process payment | AR |
| **Initiation** | `/fpx/page` | GET | Payment page | - |
| **Initiation** | `/fpx/banks` | GET | Bank list | - |
| **Initiation** | `/fpx/banks/active` | GET | Active banks | - |
| **Initiation** | `/fpx/banks/update-status` | POST | Update status | BE |
| **Initiation** | `/fpx/banks/status-summary` | GET | Status summary | - |
| **Redirection** | `/fpx/redirect` | GET | Gateway redirect | AR |
| **Redirection** | `/fpx/test-connection` | GET | Test connection | - |
| **Callback** | `/fpx/callback` | POST | Handle callback | AC |
| **Callback** | `/fpx/enquiry` | POST | Manual enquiry | AE |
| **Callback** | `/fpx/history/{id}` | GET | Message history | - |
| **Results** | `/fpx/success` | GET | Success page | - |
| **Results** | `/fpx/failure` | GET | Failure page | - |
| **Results** | `/fpx/receipt` | GET | Receipt page | - |

## ✅ **Benefits of New Route Structure**

1. **🎯 Intuitive Flow**: Routes follow payment process naturally
2. **📚 Easy to Understand**: Clear stage-based organization
3. **🔧 Developer Friendly**: Logical grouping by functionality
4. **📊 FPX Message Mapping**: Clear correlation with FPX messages
5. **✅ Clean Architecture**: Organized route structure
6. **📋 Comprehensive Documentation**: Detailed route descriptions
7. **🧪 Testing Support**: Easy testing with clear examples

## 🎯 **Summary**

The new Paynet FPX route structure provides:

- **✅ Logical organization** by payment flow stages
- **✅ Clear FPX message mapping** (AR, AC, BE, AE)
- **✅ Intuitive naming** for easy developer understanding
- **✅ Comprehensive documentation** for each route
- **✅ Clean architecture** with organized routes
- **✅ Testing support** with clear examples

This structure makes it easy for developers to understand and implement the complete FPX payment flow! 🚀 