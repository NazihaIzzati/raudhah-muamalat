# Call-to-Action (CTA) Section Master Component Documentation

## Overview
The master CTA section component (`resources/views/components/cta-section.blade.php`) provides a standardized, flexible call-to-action section for all pages except the homepage. This ensures consistent design, animations, and user experience across the entire application.

## Features

### ✨ **Flexible Design Types**
- **Primary CTA**: High-impact sections with primary background and white text
- **Secondary CTA**: Subtle sections with gray or white backgrounds
- **Contact CTA**: Specialized for contact and partnership calls
- **Partner CTA**: Tailored for partnership opportunities

### 🎨 **Background Options**
- **Primary**: Orange background with white text and animated elements
- **Gray**: Light gray background with dark text
- **White**: White background with dark text

### 🎬 **Built-in Animations**
- **Floating elements**: Animated background decorations for primary CTAs
- **Fade-in-up**: Smooth entrance animations with staggered delays
- **Pulse buttons**: Attention-grabbing button animations
- **Scroll-triggered**: Animations activate when section comes into view

### 📱 **Responsive Design**
- Mobile-first approach with responsive typography
- Flexible button layouts (stack on mobile, row on desktop)
- Optimized spacing and padding for all screen sizes

## Usage

### Basic Implementation
```blade
@include('components.cta-section', [
    'title' => 'Ready to Make a Difference?',
    'description' => 'Join our community and start creating positive impact today.',
    'buttons' => [
        [
            'text' => 'Get Started',
            'url' => '/campaigns',
            'type' => 'primary'
        ],
        [
            'text' => 'Learn More',
            'url' => '/about',
            'type' => 'secondary'
        ]
    ]
])
```

### Primary CTA (Default)
```blade
@include('components.cta-section', [
    'type' => 'primary',
    'title' => 'Want to Become Our Partner?',
    'description' => 'If your organization is interested in partnering with Jariah Fund to help the community, contact us to learn about the application process.',
    'buttons' => [
        [
            'text' => 'Contact Us',
            'url' => '/contact',
            'type' => 'primary'
        ],
        [
            'text' => 'About Jariah Fund',
            'url' => '/about',
            'type' => 'secondary'
        ]
    ],
    'background' => 'primary',
    'animated' => true
])
```

### Secondary CTA
```blade
@include('components.cta-section', [
    'type' => 'secondary',
    'title' => 'Have Questions?',
    'description' => 'Our team is here to help you understand how our platform works.',
    'buttons' => [
        [
            'text' => 'View FAQ',
            'url' => '/faq',
            'type' => 'primary'
        ],
        [
            'text' => 'Contact Support',
            'url' => '/contact',
            'type' => 'secondary'
        ]
    ],
    'background' => 'gray',
    'animated' => true
])
```

### Contact CTA
```blade
@include('components.cta-section', [
    'type' => 'contact',
    'title' => 'Get in Touch',
    'subtitle' => 'We\'re Here to Help',
    'description' => 'Have questions about our platform or need assistance? Our expert team is ready to provide guidance.',
    'buttons' => [
        [
            'text' => 'Contact Us',
            'url' => '/contact',
            'type' => 'primary',
            'icon' => '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'
        ]
    ],
    'background' => 'primary'
])
```

## Parameters

### Required Parameters

#### `title` (string)
Main CTA title

#### `description` (string)
CTA description (supports HTML)

### Optional Parameters

#### `type` (string)
CTA type: 'primary', 'secondary', 'contact', 'partner'
- **Default**: 'primary'

#### `subtitle` (string)
Optional subtitle displayed below title

#### `buttons` (array)
Array of button configurations:
- **text** (string): Button text
- **url** (string): Button URL
- **type** (string): 'primary' or 'secondary'
- **icon** (string): Optional SVG icon HTML

#### `background` (string)
Background style: 'primary', 'gray', 'white'
- **Default**: 'primary'

#### `animated` (boolean)
Enable/disable animations
- **Default**: true

#### `centered` (boolean)
Center-align content
- **Default**: true

## Pre-configured CTA Types

### 1. Partnership CTA
```blade
@include('components.cta-section', [
    'type' => 'partner',
    'title' => 'Want to Become Our Partner?',
    'description' => 'If your organization is interested in partnering with Jariah Fund to help the community, contact us to learn about the application process to become a verified partner.',
    'buttons' => [
        ['text' => 'Contact Us', 'url' => '/contact', 'type' => 'primary'],
        ['text' => 'About Jariah Fund', 'url' => '/about', 'type' => 'secondary']
    ]
])
```

### 2. Campaign CTA
```blade
@include('components.cta-section', [
    'type' => 'campaign',
    'title' => 'Ready to Make a Difference?',
    'description' => 'Join thousands of donors supporting verified campaigns that create real impact in communities worldwide.',
    'buttons' => [
        ['text' => 'View Campaigns', 'url' => '/campaigns', 'type' => 'primary'],
        ['text' => 'Start Donating', 'url' => '/donate', 'type' => 'secondary']
    ]
])
```

### 3. Support CTA
```blade
@include('components.cta-section', [
    'type' => 'support',
    'title' => 'Need Help?',
    'description' => 'Our support team is available 24/7 to assist you with any questions about donations, campaigns, or our platform.',
    'buttons' => [
        ['text' => 'Contact Support', 'url' => '/contact', 'type' => 'primary'],
        ['text' => 'View FAQ', 'url' => '/faq', 'type' => 'secondary']
    ],
    'background' => 'gray'
])
```

## Page-Specific Implementations

### About Page
```blade
@include('components.cta-section', [
    'title' => 'Ready to Join Our Mission?',
    'description' => 'Start making a difference today by supporting verified campaigns or becoming a partner organization.',
    'buttons' => [
        ['text' => 'View Campaigns', 'url' => '/campaigns', 'type' => 'primary'],
        ['text' => 'Become a Partner', 'url' => '/contact', 'type' => 'secondary']
    ]
])
```

### Campaigns Page
```blade
@include('components.cta-section', [
    'title' => 'Start Your Impact Journey',
    'description' => 'Every donation makes a difference. Choose a campaign that resonates with you and start creating positive change.',
    'buttons' => [
        ['text' => 'Donate Now', 'url' => '/donate', 'type' => 'primary'],
        ['text' => 'Learn How It Works', 'url' => '/about', 'type' => 'secondary']
    ]
])
```

### Contact Page
```blade
@include('components.cta-section', [
    'title' => 'Let\'s Connect',
    'subtitle' => 'We\'re Here to Help',
    'description' => 'Whether you\'re a donor, partner, or just curious about our mission, we\'d love to hear from you.',
    'buttons' => [
        ['text' => 'Send Message', 'url' => '#contact-form', 'type' => 'primary'],
        ['text' => 'Call Us', 'url' => 'tel:+60123456789', 'type' => 'secondary']
    ],
    'background' => 'gray'
])
```

## Animation System

### Entrance Animations
- **Fade-in-up**: Main content slides up with fade effect
- **Staggered delays**: Title, description, and buttons animate in sequence
- **Scroll-triggered**: Animations activate when section enters viewport

### Background Animations (Primary CTAs)
- **Floating elements**: Subtle animated background decorations
- **Multiple layers**: Different sized elements with varying animation speeds
- **Blur effects**: Soft, non-distracting background movement

### Button Animations
- **Pulse effect**: Primary buttons have subtle pulsing animation
- **Hover states**: Scale and shadow effects on interaction
- **Smooth transitions**: All state changes are smoothly animated

## Customization

### Adding Custom Icons
Icons should be SVG format with these classes:
```html
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <!-- SVG path -->
</svg>
```

### Custom Background Colors
Add new background options by extending the component:
```php
$bgClasses = [
    'primary' => 'bg-primary-500',
    'gray' => 'bg-gray-50',
    'white' => 'bg-white',
    'custom' => 'bg-gradient-to-r from-blue-500 to-purple-600'
];
```

### Custom Button Styles
Extend button types for specific use cases:
```blade
@if($button['type'] === 'custom')
    <a href="{{ $button['url'] }}" class="custom-button-classes">
        {{ $button['text'] }}
    </a>
@endif
```

## Benefits

### 🎯 **Consistency**
- Uniform CTA design across all pages
- Standardized animation timing and effects
- Consistent user interaction patterns

### 🔧 **Maintainability**
- Single source of truth for CTA sections
- Easy updates across all pages
- Reduced code duplication

### ⚡ **Performance**
- Optimized animations and transitions
- Conditional loading of animation scripts
- Efficient CSS and JavaScript

### 📱 **Accessibility**
- Semantic HTML structure
- Keyboard navigation support
- Screen reader friendly
- Focus management

## Best Practices

### Content Guidelines
- **Title**: Keep under 60 characters for optimal display
- **Description**: 1-2 sentences, focus on value proposition
- **Buttons**: Maximum 2 buttons per CTA for clarity

### Design Guidelines
- **Primary CTAs**: Use sparingly, for main conversion goals
- **Secondary CTAs**: Use for supporting actions and information
- **Button hierarchy**: Primary button for main action, secondary for alternatives

### Performance Guidelines
- **Animations**: Use `animated: false` for performance-critical pages
- **Images**: Optimize any custom background images
- **Scripts**: Animation scripts only load when needed

## Implementation Examples

### Replace Existing CTAs
To replace existing CTA sections in pages, simply replace the old HTML with the component include:

**Before:**
```html
<section class="py-20 bg-primary-500">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Want to Become Our Partner?</h2>
        <p class="text-xl text-primary-100 mb-8">Contact us to learn about partnership opportunities.</p>
        <a href="/contact" class="bg-white text-primary-500 px-8 py-4 rounded-lg">Contact Us</a>
    </div>
</section>
```

**After:**
```blade
@include('components.cta-section', [
    'title' => 'Want to Become Our Partner?',
    'description' => 'Contact us to learn about partnership opportunities.',
    'buttons' => [
        ['text' => 'Contact Us', 'url' => '/contact', 'type' => 'primary']
    ]
])
```

## Troubleshooting

### Animations Not Working
- Ensure `animated: true` is set
- Check that CSS and JavaScript are properly loaded
- Verify scroll position triggers

### Layout Issues
- Check button array structure
- Verify background parameter values
- Test responsive behavior on different screen sizes

### Performance Issues
- Disable animations on slower devices
- Optimize custom icons and images
- Consider reducing animation complexity
