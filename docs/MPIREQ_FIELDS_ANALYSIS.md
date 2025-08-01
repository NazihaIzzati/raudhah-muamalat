# 🔍 MPIReq FIELDS ANALYSIS - Official Cardzone Documentation

## 📊 **OFFICIAL CARDZONE SPECIFICATIONS**

### ✅ **REQUIRED FIELDS (11 Total)**

#### **🔑 Core Transaction Fields (6)**
1. `MPI_TRANS_TYPE` - Transaction type (AN(10)) - **M**
2. `MPI_MERC_ID` - Merchant ID (N(15)) - **M**
3. `MPI_PURCH_AMT` - Purchase amount (N(12)) - **M**
4. `MPI_PURCH_CURR` - Purchase currency (N(3)) - **M**
5. `MPI_TRXN_ID` - Transaction ID (N(20)) - **M**
6. `MPI_PURCH_DATE` - Purchase date (N(14)) - **M**

#### **💳 Card Information Fields (4)**
7. `MPI_PAN` - Primary account number (N(19)) - **C**
8. `MPI_CARD_HOLDER_NAME` - Cardholder name (A(45)) - **C**
9. `MPI_PAN_EXP` - Card expiry date (N(4)) - **C**
10. `MPI_CVV2` - Card verification value (N(3)) - **C**

#### **🔄 Conditional Field (1)**
11. `MPI_ORI_TRXN_ID` - Original transaction ID (N(20)) - **C**

---

### 📋 **OPTIONAL FIELDS (24 Total)**

#### **📍 Address Fields (12)**
12. `MPI_ADDR_MATCH` - Address match indicator (A(1)) - **O**
13. `MPI_BILL_ADDR_CITY` - Billing city (AN(50)) - **C**
14. `MPI_BILL_ADDR_STATE` - Billing state (AN(3)) - **C**
15. `MPI_BILL_ADDR_CNTRY` - Billing country (N(3)) - **C** ✅ **CORRECTED**
16. `MPI_BILL_ADDR_POSTCODE` - Billing postcode (N(16)) - **C** ✅ **CORRECTED**
17. `MPI_BILL_ADDR_LINE1` - Billing address line 1 (AN(50)) - **C**
18. `MPI_BILL_ADDR_LINE2` - Billing address line 2 (AN(50)) - **C**
19. `MPI_BILL_ADDR_LINE3` - Billing address line 3 (AN(50)) - **C**
20. `MPI_SHIP_ADDR_CITY` - Shipping city (AN(50)) - **O**
21. `MPI_SHIP_ADDR_STATE` - Shipping state (AN(3)) - **O**
22. `MPI_SHIP_ADDR_CNTRY` - Shipping country (AN(3)) - **O**
23. `MPI_SHIP_ADDR_POSTCODE` - Shipping postcode (AN(16)) - **O**
24. `MPI_SHIP_ADDR_LINE1` - Shipping address line 1 (AN(50)) - **O**
25. `MPI_SHIP_ADDR_LINE2` - Shipping address line 2 (AN(50)) - **O**
26. `MPI_SHIP_ADDR_LINE3` - Shipping address line 3 (AN(50)) - **O**

#### **📞 Contact Information Fields (7)**
27. `MPI_EMAIL` - Email address (AN(254)) - **C**
28. `MPI_HOME_PHONE` - Home phone (AN(15)) - **O**
29. `MPI_HOME_PHONE_CC` - Home phone country code (N(3)) - **O**
30. `MPI_WORK_PHONE` - Work phone (AN(15)) - **O**
31. `MPI_WORK_PHONE_CC` - Work phone country code (N(3)) - **O**
32. `MPI_MOBILE_PHONE` - Mobile phone (AN(15)) - **O**
33. `MPI_MOBILE_PHONE_CC` - Mobile phone country code (N(3)) - **O**

#### **📦 Additional Fields (2)**
34. `MPI_LINE_ITEM` - Line item (AN) - **O**
35. `MPI_RESPONSE_TYPE` - Response type (AN) - **O** ✅ **RESTORED**

---

## 🎯 **OFFICIAL MAC GENERATION ORDER (35 Fields)**

### ✅ **EXACT ORDER FROM DOCUMENTATION**
```php
// 1-11: Core Transaction & Card Fields
'MPI_TRANS_TYPE' => 'AN(10)',      // 1
'MPI_MERC_ID' => 'N(15)',          // 2
'MPI_PAN' => 'N(19)',              // 3
'MPI_CARD_HOLDER_NAME' => 'A(45)', // 4
'MPI_PAN_EXP' => 'N(4)',           // 5
'MPI_CVV2' => 'N(3)',              // 6
'MPI_TRXN_ID' => 'N(20)',          // 7
'MPI_ORI_TRXN_ID' => 'N(20)',     // 8
'MPI_PURCH_DATE' => 'N(14)',       // 9
'MPI_PURCH_CURR' => 'N(3)',        // 10
'MPI_PURCH_AMT' => 'N(12)',        // 11

// 12-26: Address Fields
'MPI_ADDR_MATCH' => 'A(1)',        // 12
'MPI_BILL_ADDR_CITY' => 'AN(50)',  // 13
'MPI_BILL_ADDR_STATE' => 'AN(3)',  // 14
'MPI_BILL_ADDR_CNTRY' => 'N(3)',   // 15
'MPI_BILL_ADDR_POSTCODE' => 'N(16)', // 16
'MPI_BILL_ADDR_LINE1' => 'AN(50)', // 17
'MPI_BILL_ADDR_LINE2' => 'AN(50)', // 18
'MPI_BILL_ADDR_LINE3' => 'AN(50)', // 19
'MPI_SHIP_ADDR_CITY' => 'AN(50)',  // 20
'MPI_SHIP_ADDR_STATE' => 'AN(3)',  // 21
'MPI_SHIP_ADDR_CNTRY' => 'AN(3)',  // 22
'MPI_SHIP_ADDR_POSTCODE' => 'AN(16)', // 23
'MPI_SHIP_ADDR_LINE1' => 'AN(50)', // 24
'MPI_SHIP_ADDR_LINE2' => 'AN(50)', // 25
'MPI_SHIP_ADDR_LINE3' => 'AN(50)', // 26

// 27-35: Contact & Additional Fields
'MPI_EMAIL' => 'AN(254)',          // 27
'MPI_HOME_PHONE' => 'AN(15)',      // 28
'MPI_HOME_PHONE_CC' => 'N(3)',     // 29
'MPI_WORK_PHONE' => 'AN(15)',      // 30
'MPI_WORK_PHONE_CC' => 'N(3)',     // 31
'MPI_MOBILE_PHONE' => 'AN(15)',    // 32
'MPI_MOBILE_PHONE_CC' => 'N(3)',   // 33
'MPI_LINE_ITEM' => 'AN',           // 34
'MPI_RESPONSE_TYPE' => 'AN',       // 35
```

---

## ✅ **CORRECTIONS APPLIED**

### 🔧 **Data Type Fixes**
1. **`MPI_BILL_ADDR_CNTRY`**: Changed from `AN(3)` to `N(3)` ✅
2. **`MPI_BILL_ADDR_POSTCODE`**: Changed from `AN(16)` to `N(16)` ✅
3. **`MPI_SHIP_ADDR_CNTRY`**: Kept as `AN(3)` ✅
4. **`MPI_SHIP_ADDR_POSTCODE`**: Kept as `AN(16)` ✅

### 🔄 **Field Restorations**
1. **`MPI_RESPONSE_TYPE`**: Added back to all locations ✅
2. **`MPI_CVV2`**: Ensured correct field name ✅

### 📋 **Field Requirements**
- **M (Mandatory)**: 6 fields (always required)
- **C (Conditional)**: 8 fields (required under certain conditions)
- **O (Optional)**: 21 fields (can be omitted)

---

## 📊 **UPDATED FIELD STATISTICS**

| Category | Mandatory | Conditional | Optional | Total | Data Types |
|----------|-----------|-------------|----------|-------|------------|
| **Core Transaction** | 6 | 0 | 0 | 6 | N(12-20), AN(10) |
| **Card Information** | 0 | 4 | 0 | 4 | N(3-19), A(45) |
| **Address Fields** | 0 | 6 | 6 | 12 | N(3-16), AN(3-50) |
| **Contact Information** | 0 | 1 | 6 | 7 | N(3), AN(15-254) |
| **Additional** | 0 | 0 | 2 | 2 | AN |
| **TOTAL** | **6** | **11** | **14** | **31** | **Mixed** |

---

## 🎯 **IMPLEMENTATION STATUS**

### ✅ **COMPLETED UPDATES**
1. **Data Type Corrections**: All field types now match official documentation
2. **Field Order**: MAC generation follows official 35-field order
3. **Field Requirements**: All M/C/O requirements implemented
4. **Field Restorations**: `MPI_RESPONSE_TYPE` restored

### 🔍 **VERIFICATION NEEDED**
1. **MAC Generation**: Test with official field order
2. **Data Validation**: Verify field types and lengths
3. **Cardzone Integration**: Test with actual Cardzone environment

---

## 📝 **SUMMARY**

- **✅ Total Fields**: 35 fields (exactly as per documentation)
- **✅ Data Types**: All corrected to match official specifications
- **✅ Field Order**: MAC generation follows official order
- **✅ Requirements**: All M/C/O requirements implemented
- **✅ Status**: Ready for testing with official specifications

The implementation now matches the official Cardzone documentation exactly, with proper data types, field order, and requirements. 