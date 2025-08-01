# Hero Section Master Component Documentation

## Overview
The master hero section component (`resources/views/components/hero-section.blade.php`) provides a standardized, animated hero section for all pages except the homepage. This ensures consistent design, animations, and user experience across the entire application.

## Features

### ✨ **Consistent Design Elements**
- **Badge**: Animated badge with icon and page identifier
- **Title**: Large, bold title with optional animated subtitle and underline
- **Description**: Rich text description with highlighted keywords
- **Feature Pills**: Interactive feature badges with hover effects
- **CTA Buttons**: Optional call-to-action buttons for action-oriented pages

### 🎬 **Built-in Animations**
- **Fade-in-up**: Smooth entrance animations with staggered delays
- **Bounce-in**: Playful entrance for feature pills
- **Draw-line**: SVG line drawing animation for subtitle underlines
- **Highlight**: Text highlighting animation for keywords
- **Pulse-button**: Attention-grabbing button animation

### 📱 **Responsive Design**
- Mobile-first approach with responsive typography
- Flexible layout that adapts to all screen sizes
- Touch-friendly interactive elements

## Usage

### Basic Implementation
```blade
@include('components.hero-section', [
    'badge' => [
        'text' => 'Page Name',
        'icon' => '<svg>...</svg>'
    ],
    'title' => 'Page Title',
    'description' => 'Page description with <strong>highlights</strong>.',
    'pills' => [
        ['text' => 'Feature 1', 'delay' => '0.7s'],
        ['text' => 'Feature 2', 'delay' => '0.8s'],
        ['text' => 'Feature 3', 'delay' => '0.9s']
    ]
])
```

### With Subtitle and Underline
```blade
@include('components.hero-section', [
    'badge' => [...],
    'title' => 'Main Title',
    'subtitle' => 'Animated Subtitle',
    'description' => '...',
    'pills' => [...]
])
```

### With CTA Buttons (Action-Oriented Pages)
```blade
@include('components.hero-section', [
    'badge' => [...],
    'title' => '...',
    'description' => '...',
    'cta_buttons' => [
        [
            'text' => 'Primary Action',
            'url' => '/action',
            'type' => 'primary'
        ],
        [
            'text' => 'Secondary Action',
            'url' => '/secondary',
            'type' => 'secondary'
        ]
    ],
    'pills' => [...]
])
```

### With Highlighted Keywords
```blade
@include('components.hero-section', [
    'badge' => [...],
    'title' => '...',
    'description' => 'Description with highlighted keywords.',
    'highlights' => [
        ['text' => 'keyword one', 'delay' => '0.6s'],
        ['text' => 'keyword two', 'delay' => '0.8s']
    ],
    'pills' => [...]
])
```

## Parameters

### Required Parameters

#### `badge` (array)
- **text** (string): Badge text (e.g., "About Us", "Our Campaigns")
- **icon** (string): SVG icon HTML

#### `title` (string)
Main page title

#### `description` (string)
Page description (supports HTML)

#### `pills` (array)
Feature pills array with:
- **text** (string): Pill text
- **delay** (string): Animation delay (e.g., "0.7s")

### Optional Parameters

#### `subtitle` (string)
Animated subtitle with underline effect

#### `highlights` (array)
Highlighted keywords in description:
- **text** (string): Text to highlight
- **delay** (string): Animation delay

#### `cta_buttons` (array)
Call-to-action buttons:
- **text** (string): Button text
- **url** (string): Button URL
- **type** (string): 'primary' or 'secondary'

## Page Configurations

### About Page
```blade
@include('components.hero-section', [
    'badge' => [
        'text' => 'About Us',
        'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    ],
    'title' => 'Empowering Communities Through Trusted Giving',
    'description' => 'Join our mission to create lasting impact through <strong>Islamic crowdfunding</strong>. We connect generous donors with verified campaigns that transform lives through education, healthcare, and economic empowerment.',
    'highlights' => [
        ['text' => 'complete transparency', 'delay' => '0.6s'],
        ['text' => 'effective impact', 'delay' => '0.8s']
    ],
    'cta_buttons' => [
        ['text' => 'View Our Campaigns', 'url' => '/campaigns', 'type' => 'primary'],
        ['text' => 'Start Donating', 'url' => '/donate', 'type' => 'secondary']
    ],
    'pills' => [
        ['text' => '100% Secure', 'delay' => '0.7s'],
        ['text' => 'Tax Deductible', 'delay' => '0.8s'],
        ['text' => 'Transparent & Trusted', 'delay' => '0.9s']
    ]
])
```

### Campaigns Page
```blade
@include('components.hero-section', [
    'badge' => [
        'text' => 'Our Campaigns',
        'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
    ],
    'title' => 'Empowering Communities Through Trusted Giving',
    'description' => 'Join thousands of donors supporting <strong>verified campaigns</strong> that make a real difference in communities worldwide. Each campaign is thoroughly vetted to ensure complete transparency and effective impact.',
    'highlights' => [
        ['text' => 'complete transparency', 'delay' => '0.6s'],
        ['text' => 'effective impact', 'delay' => '0.8s']
    ],
    'pills' => [
        ['text' => '100% Secure', 'delay' => '0.7s'],
        ['text' => 'Tax Deductible', 'delay' => '0.8s'],
        ['text' => 'Transparent & Trusted', 'delay' => '0.9s']
    ]
])
```

## Animation Timing

### Standard Timing Sequence
1. **Badge**: 0.1s
2. **Title**: 0.2s
3. **Subtitle**: 0.3s (if present)
4. **Description**: 0.4s
5. **CTA Buttons**: 0.5s (if present)
6. **Feature Pills**: 0.6s base (if no CTAs) or 0.7s+ (if CTAs present)
7. **Highlights**: 0.6s+ (staggered)

### Best Practices
- Keep animation delays between 0.1s-0.2s apart
- Feature pills should have 0.1s stagger between each
- Highlights should start after description is visible
- Total animation sequence should complete within 1.5s

## Customization

### Adding New Icons
Icons should be SVG format with these classes:
```html
<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <!-- SVG path -->
</svg>
```

### Custom Animations
Additional animations can be added to the component's `@push('styles')` section.

### Responsive Breakpoints
- **Mobile**: Base styles
- **md**: 768px+
- **lg**: 1024px+
- **xl**: 1280px+

## Benefits

### 🎯 **Consistency**
- Uniform design across all pages
- Standardized animation timing
- Consistent user experience

### 🔧 **Maintainability**
- Single source of truth for hero sections
- Easy updates across all pages
- Reduced code duplication

### ⚡ **Performance**
- Optimized animations
- Shared CSS styles
- Efficient rendering

### 📱 **Accessibility**
- Semantic HTML structure
- Keyboard navigation support
- Screen reader friendly

## Migration Guide

### From Individual Hero Sections
1. Replace existing hero section HTML with component include
2. Extract content into component parameters
3. Remove duplicate CSS animations
4. Test animations and responsiveness

### Example Migration
**Before:**
```blade
<section class="py-20 bg-gradient-to-br from-primary-50 to-white">
    <!-- Complex hero HTML -->
</section>
```

**After:**
```blade
@include('components.hero-section', [
    // Component parameters
])
```

## Troubleshooting

### Animations Not Working
- Ensure CSS is properly loaded
- Check animation delay syntax
- Verify JavaScript isn't conflicting

### Layout Issues
- Check parameter syntax
- Verify all required parameters are provided
- Test on different screen sizes

### Performance Issues
- Minimize animation complexity
- Use CSS transforms over position changes
- Consider reducing animation duration for slower devices
