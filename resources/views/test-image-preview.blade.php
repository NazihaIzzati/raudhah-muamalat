<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Preview Test</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .test-section {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .file-input {
            margin: 10px 0;
        }
        button {
            background: #fe5000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background: #e04500;
        }
    </style>
</head>
<body>
    <h1>Image Preview Test Page</h1>
    
    <div class="test-section">
        <h2>Test SweetAlert2</h2>
        <button onclick="testSweetAlert()">Test SweetAlert</button>
        <button onclick="testImagePreview()">Test Image Preview</button>
    </div>
    
    <div class="test-section">
        <h2>File Upload Test</h2>
        <div class="file-input">
            <label for="test_image">Select Image:</label>
            <input type="file" id="test_image" accept="image/*">
        </div>
        <div id="preview_container"></div>
    </div>

    <script>
        // SweetAlert2 Configuration
        const SwalConfig = {
            confirmButtonColor: '#fe5000',
            cancelButtonColor: '#6b7280',
            reverseButtons: true,
            focusCancel: true
        };

        // Test SweetAlert function
        function testSweetAlert() {
            console.log('Testing SweetAlert...');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'SweetAlert Test!',
                    text: 'SweetAlert2 is working correctly!',
                    icon: 'success',
                    confirmButtonColor: '#fe5000'
                });
            } else {
                alert('SweetAlert2 is not loaded!');
            }
        }

        // Test image preview function
        function testImagePreview() {
            console.log('Testing image preview...');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Image Preview Test',
                    text: 'This is a test of the image preview functionality.',
                    icon: 'info',
                    confirmButtonColor: '#fe5000'
                });
            } else {
                alert('SweetAlert2 is not loaded!');
            }
        }

        // File input change handler
        document.getElementById('test_image').addEventListener('change', function(e) {
            console.log('File selected:', e.target.files[0]);
            const file = e.target.files[0];
            
            if (file) {
                // Validate file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large!',
                        text: 'Image must be less than 2MB.',
                        confirmButtonText: 'OK',
                        ...SwalConfig
                    });
                    this.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type!',
                        text: 'Please select an image file (PNG, JPG, GIF).',
                        confirmButtonText: 'OK',
                        ...SwalConfig
                    });
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('Image loaded for preview');
                    const imageUrl = e.target.result;
                    
                    // Show preview with SweetAlert
                    Swal.fire({
                        title: 'Image Preview Test',
                        imageUrl: imageUrl,
                        imageWidth: 400,
                        imageHeight: 300,
                        imageAlt: 'Test Image Preview',
                        showCancelButton: true,
                        confirmButtonText: 'Use This Image',
                        cancelButtonText: 'Choose Different Image',
                        ...SwalConfig
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                            // Reset the file input
                            document.getElementById('test_image').value = '';
                        }
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Check if SweetAlert2 is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            if (typeof Swal !== 'undefined') {
                console.log('SweetAlert2 is loaded');
            } else {
                console.log('SweetAlert2 is NOT loaded');
            }
        });
    </script>
</body>
</html> 