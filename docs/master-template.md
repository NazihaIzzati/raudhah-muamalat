# Master Template Documentation

## Overview
The master template (`resources/views/layouts/master.blade.php`) provides a consistent header and footer design based on the homepage layout. This template ensures all pages maintain the same branding, navigation, and user experience.

## Features

### Header
- **Consistent Branding**: Jariah Fund logo with primary color
- **Smart Navigation**: Active page highlighting with conditional classes
- **Responsive Design**: Mobile-friendly with collapsible menu
- **Authentication Links**: Login/Register or Dashboard based on auth status
- **Smooth Transitions**: Hover effects and color transitions

### Footer
- **4-Column Layout**: Company info, quick links, areas of support, contact info
- **Social Media Icons**: Twitter, Facebook, Pinterest placeholders
- **Contact Information**: Phone, email, and location
- **Legal Links**: Privacy policy, terms of service, cookie policy
- **Copyright**: Dynamic year with "All rights reserved"

### Mobile Features
- **Responsive Navigation**: Hamburger menu for mobile devices
- **Touch-Friendly**: Proper spacing and touch targets
- **Smooth Scrolling**: JavaScript-powered smooth scrolling for anchor links

## Usage

### Basic Page Structure
```blade
@extends('layouts.master')

@section('title', 'Page Title - Jariah Fund')
@section('description', 'Page description for SEO')

@section('content')
    <!-- Your page content here -->
@endsection
```

### Adding Custom Styles
```blade
@push('styles')
    <style>
        /* Custom page styles */
    </style>
@endpush
```

### Adding Custom Scripts
```blade
@push('scripts')
    <script>
        // Custom page scripts
    </script>
@endpush
```

## Navigation Highlighting
The template automatically highlights the active page in navigation using Laravel's `request()->is()` helper:

- **Home**: Highlighted when on `/` route
- **About**: Highlighted when on `/about` route  
- **Partners**: Highlighted when on `/partners` route
- **Campaigns**: Highlighted when on `/campaigns` route

## Customization

### Colors
The template uses Tailwind CSS classes with primary color variables:
- `text-primary-500`: Main brand color
- `hover:text-primary-500`: Hover states
- `bg-primary-500`: Background elements

### Typography
- **Font**: Instrument Sans from Google Fonts
- **Headings**: Bold weights for hierarchy
- **Body**: Regular weight for readability

### Responsive Breakpoints
- **Mobile**: Default styles
- **Tablet**: `md:` prefix (768px+)
- **Desktop**: `lg:` prefix (1024px+)

## Converting Existing Pages

### Step 1: Update Page Structure
Replace the existing HTML structure with:
```blade
@extends('layouts.master')

@section('title', 'Your Page Title')
@section('description', 'Your page description')

@section('content')
    <!-- Move your main content here -->
@endsection
```

### Step 2: Remove Duplicate Elements
Remove these elements from existing pages:
- `<!DOCTYPE html>` and `<html>` tags
- `<head>` section
- Header navigation
- Footer section
- `</body>` and `</html>` closing tags

### Step 3: Update Content Structure
Keep only the main content sections:
- Hero sections
- Main content areas
- Call-to-action sections

## Benefits

### Consistency
- **Visual Harmony**: All pages look cohesive
- **User Experience**: Familiar navigation across pages
- **Brand Recognition**: Consistent logo and color usage

### Maintainability
- **Single Source**: Update header/footer in one place
- **Easy Updates**: Navigation changes apply to all pages
- **Reduced Code**: Less duplication across pages

### Performance
- **Optimized Assets**: Shared CSS and JavaScript
- **Caching**: Better browser caching of common elements
- **Mobile Optimized**: Responsive design built-in

## Example Implementation

### Simple Page
```blade
@extends('layouts.master')

@section('title', 'Services - Jariah Fund')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Our Services</h1>
            <p class="text-xl text-gray-600">Content goes here...</p>
        </div>
    </section>
@endsection
```

### Page with Custom Styles
```blade
@extends('layouts.master')

@section('title', 'Special Page - Jariah Fund')

@push('styles')
    <style>
        .custom-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
@endpush

@section('content')
    <section class="custom-section py-16">
        <!-- Custom content -->
    </section>
@endsection
```

## Best Practices

1. **Always use the master template** for new pages
2. **Keep content sections focused** on the main content only
3. **Use semantic HTML** within content sections
4. **Follow Tailwind CSS conventions** for styling
5. **Test mobile responsiveness** on all devices
6. **Optimize images** for web performance
7. **Use descriptive page titles** for SEO

## Troubleshooting

### Navigation Not Highlighting
Check that your route matches the `request()->is()` condition in the template.

### Mobile Menu Not Working
Ensure JavaScript is enabled and the mobile menu script is loading properly.

### Styling Issues
Verify that Tailwind CSS is properly compiled and loaded.

### Custom Styles Not Applying
Make sure custom styles are added using `@push('styles')` directive.
