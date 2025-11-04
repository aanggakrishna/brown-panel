# Company Settings Feature

## Overview
The Company Settings feature allows administrators to manage comprehensive company information including basic details, legal information, contact details, banking information, and social media links.

## Features

### 1. Basic Information
- Company Name (required)
- Company Short Name
- Company Description
- Company Logo (image upload, max 2MB)
- Company Favicon (image upload, max 1MB)

### 2. Contact Information
- Company Email (required)
- Company Phone (required)
- Company Website
- Complete Address (required)
  - Street Address
  - City (required)
  - Province
  - Postal Code
  - Country (default: Indonesia)

### 3. Legal Information
- NPWP Number (Tax ID)
- SIUP Number (Business License)
- TDP Number (Company Registration)
- Establishment Date
- Legal Entity Type (PT, CV, UD, Firma, Koperasi, Yayasan, Perorangan)

### 4. Contact Person
- Contact Person Name
- Position
- Phone
- Email

### 5. Banking Information
- Bank Name
- Account Number
- Account Holder Name

### 6. Social Media
- Facebook URL
- Instagram URL
- LinkedIn URL
- Twitter URL

### 7. Business Settings
- Business Hours
- Timezone (default: Asia/Jakarta)
- Active Status

### 8. Content Management
- Terms and Conditions
- Privacy Policy
- About Us

## Technical Implementation

### Database
- Table: `company_settings`
- Single record design (only one company settings record)
- Comprehensive field validation

### File Upload
- Logo: `storage/app/public/company/` directory
- Favicon: `storage/app/public/company/` directory
- Automatic old file cleanup on update

### Validation Rules
- Required fields: company_name, company_email, company_phone, company_address, company_city, company_country
- File validation: image types, size limits
- Email and URL format validation
- Date validation for establishment date

### Access Control
- Protected by `auth` middleware
- Accessible via Settings menu in sidebar

## Usage

### Accessing Company Settings
1. Login as administrator
2. Navigate to Settings → Company Settings in the sidebar
3. Fill in all required company information
4. Upload logo and favicon if needed
5. Save settings

### File Upload Guidelines
- **Logo**: Recommended size 200x200px, formats: JPG, PNG, GIF, SVG, max 2MB
- **Favicon**: Recommended size 64x64px, formats: JPG, PNG, GIF, ICO, max 1MB

### Data Retrieval
```php
use App\Models\CompanySetting;

// Get company settings
$settings = CompanySetting::getSettings();

// Access specific fields
$companyName = $settings->company_name;
$logoUrl = $settings->company_logo_url; // Auto-generated accessor
$formattedAddress = $settings->formatted_address; // Auto-generated accessor
```

## Routes
- `GET /settings/company` - Edit company settings form
- `PATCH /settings/company` - Update company settings

## Menu Structure
```
Settings
└── Company Settings
```

## Future Enhancements
- Multiple company support
- Company branches management
- Document management for legal papers
- Integration with third-party services
- Multi-language support</content>
<parameter name="filePath">/Users/angga/laravel-coreui/COMPANY_SETTINGS_README.md
