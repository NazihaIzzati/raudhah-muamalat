<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert Test</title>
    <script src="https://unpkg.com/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .test-button {
            background: #fe5000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }
        .test-button:hover {
            background: #e04500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>SweetAlert Test Page</h1>
        <p>This page tests if SweetAlert is working properly.</p>
        
        <button class="test-button" onclick="testBasic()">Test Basic SweetAlert</button>
        <button class="test-button" onclick="testConfirm()">Test Confirmation</button>
        <button class="test-button" onclick="testForm()">Test Form Submission</button>
        
        <div id="status" style="margin-top: 20px; padding: 10px; background: #f0f0f0; border-radius: 5px;">
            <strong>Status:</strong> <span id="status-text">Loading...</span>
        </div>
    </div>

    <script>
        // Check if SweetAlert is loaded
        window.addEventListener('load', function() {
            const statusText = document.getElementById('status-text');
            
            if (typeof Swal !== 'undefined') {
                statusText.textContent = '✅ SweetAlert is loaded successfully';
                statusText.style.color = 'green';
            } else {
                statusText.textContent = '❌ SweetAlert failed to load';
                statusText.style.color = 'red';
            }
        });

        function testBasic() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Basic Test',
                    text: 'This is a basic SweetAlert test',
                    icon: 'success',
                    confirmButtonColor: '#fe5000'
                });
            } else {
                alert('SweetAlert is not available!');
            }
        }

        function testConfirm() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Confirmation Test',
                    text: 'Do you want to proceed?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#fe5000',
                    cancelButtonColor: '#6b7280'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Confirmed!', 'You clicked Yes', 'success');
                    } else {
                        Swal.fire('Cancelled!', 'You clicked No', 'info');
                    }
                });
            } else {
                alert('SweetAlert is not available!');
            }
        }

        function testForm() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Form Test',
                    text: 'This simulates form submission confirmation',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Submit Form',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#fe5000',
                    cancelButtonColor: '#6b7280'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Submitting...',
                            text: 'Please wait...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Simulate form submission
                        setTimeout(() => {
                            Swal.fire('Success!', 'Form submitted successfully', 'success');
                        }, 2000);
                    }
                });
            } else {
                alert('SweetAlert is not available!');
            }
        }
    </script>
</body>
</html> 