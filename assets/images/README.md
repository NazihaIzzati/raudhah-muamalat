# Jariah Fund Images Organization

This folder contains all images used in the Jariah Fund website, organized into logical subfolders for better management and maintenance.

## Folder Structure

### `/campaigns/`
Contains images related to fundraising campaigns and charitable initiatives:
- `emergency-food-relief.svg` - Food relief campaign illustration
- `education-initiative.svg` - Education program illustration  
- `medical-mission.svg` - Medical assistance campaign illustration

### `/gallery/`
Contains images for photo galleries and community events:
- `community-gathering.svg` - Community event illustration
- `food-distribution.svg` - Food distribution event illustration

### `/logos/`
Contains brand logos and organizational graphics:
- `jariah-fund-logo.svg` - Main Jariah Fund logo
- `organization-avatar.svg` - Generic organization avatar

### `/news/`
Contains images for news articles and blog posts:
- `community-event.svg` - Community event news illustration
- `workshop.svg` - Workshop and training event illustration

### `/payment/`
Contains payment method logos and related graphics:
- `duitnow-logo.svg` - DuitNow payment system logo
- `duitnow-transfer.svg` - DuitNow transfer illustration
- `fpx-logo.svg` - FPX payment system logo
- `fpx-payment.jpg` - FPX payment illustration

## Usage Guidelines

### File Naming Convention
- Use lowercase letters and hyphens for file names
- Be descriptive but concise
- Include file extension (.svg, .jpg, .png)

### Image Formats
- **SVG**: Preferred for logos, icons, and illustrations (scalable)
- **JPG**: For photographs and complex images
- **PNG**: For images requiring transparency

### Accessing Images in Blade Templates
Use Laravel's `asset()` helper function:

```php
<!-- Example usage -->
<img src="{{ asset('images/logos/jariah-fund-logo.svg') }}" alt="Jariah Fund Logo">
<img src="{{ asset('images/campaigns/emergency-food-relief.svg') }}" alt="Emergency Food Relief">
```

### Adding New Images
1. Choose the appropriate subfolder based on image purpose
2. Follow the naming convention
3. Update this README if adding new categories
4. Optimize images for web use (compress file sizes)

## Image Optimization
- SVG files should be optimized and minified
- JPG files should be compressed (quality 80-90%)
- PNG files should use appropriate compression
- Consider using WebP format for better compression

## Maintenance
- Regularly review and remove unused images
- Update image references when moving or renaming files
- Keep this documentation updated with new additions

## Notes
- All images should be web-optimized for fast loading
- Maintain consistent visual style across similar image types
- Ensure proper alt text is provided for accessibility
- Consider responsive image requirements for different screen sizes
