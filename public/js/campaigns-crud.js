// Campaigns CRUD JavaScript with SweetAlert2 Integration
// =====================================================

// SweetAlert2 Configuration
const SwalConfig = {
    confirmButtonColor: '#fe5000',
    cancelButtonColor: '#6b7280',
    reverseButtons: true,
    focusCancel: true
};

// Show success message with SweetAlert
function showSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
        confirmButtonText: 'OK',
        ...SwalConfig
    });
}

// Show error message with SweetAlert
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
        confirmButtonText: 'OK',
        ...SwalConfig
    });
}

// Show warning message with SweetAlert
function showWarning(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        text: message,
        confirmButtonText: 'OK',
        ...SwalConfig
    });
}

// Show info message with SweetAlert
function showInfo(message) {
    Swal.fire({
        icon: 'info',
        title: 'Info!',
        text: message,
        confirmButtonText: 'OK',
        ...SwalConfig
    });
}

// Confirm delete with SweetAlert
function confirmDelete(campaignId, campaignTitle) {
    Swal.fire({
        title: 'Delete Campaign?',
        text: `Are you sure you want to delete "${campaignTitle}"? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Delete!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/campaigns/${campaignId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Confirm restore with SweetAlert
function confirmRestore(campaignId, campaignTitle) {
    Swal.fire({
        title: 'Restore Campaign?',
        text: `Are you sure you want to restore "${campaignTitle}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#059669',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Restore!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the restore form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/campaigns/${campaignId}/restore`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Confirm force delete with SweetAlert
function confirmForceDelete(campaignId, campaignTitle) {
    Swal.fire({
        title: 'Permanently Delete Campaign?',
        text: `Are you sure you want to permanently delete "${campaignTitle}"? This action cannot be undone and will remove all associated data.`,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Delete Permanently!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the force delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/campaigns/${campaignId}/force-delete`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Preview image before upload with SweetAlert
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'File Too Large!',
                text: 'Image must be less than 2MB.',
                confirmButtonText: 'OK',
                ...SwalConfig
            });
            input.value = '';
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
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const imageUrl = e.target.result;
            
            // Update preview element if it exists
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = imageUrl;
                preview.style.display = 'block';
            }
            
            // Show SweetAlert preview
            const imageType = input.name === 'featured_image' ? 'Featured Image' :
                             input.name === 'qr_code_image' ? 'QR Code Image' :
                             input.name === 'organization_logo' ? 'Organization Logo' : 'Image';
            
            const imageWidth = input.name === 'qr_code_image' ? 300 : 400;
            const imageHeight = input.name === 'qr_code_image' ? 300 : 200;
            
            Swal.fire({
                title: `${imageType} Preview`,
                imageUrl: imageUrl,
                imageWidth: imageWidth,
                imageHeight: imageHeight,
                imageAlt: `${imageType} Preview`,
                showCancelButton: true,
                confirmButtonText: 'Use This Image',
                cancelButtonText: 'Choose Different Image',
                ...SwalConfig
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel) {
                    // Reset the file input
                    input.value = '';
                    if (preview) {
                        preview.style.display = 'none';
                    }
                }
            });
        };
        reader.readAsDataURL(file);
    }
}

// Initialize image previews
document.addEventListener('DOMContentLoaded', function() {
    // Featured image preview
    const featuredImageInput = document.getElementById('featured_image');
    if (featuredImageInput) {
        featuredImageInput.addEventListener('change', function() {
            previewImage(this, 'featured_image_preview');
        });
    }

    // QR code image preview
    const qrCodeImageInput = document.getElementById('qr_code_image');
    if (qrCodeImageInput) {
        qrCodeImageInput.addEventListener('change', function() {
            previewImage(this, 'qr_code_image_preview');
        });
    }

    // Organization logo preview
    const orgLogoInput = document.getElementById('organization_logo');
    if (orgLogoInput) {
        orgLogoInput.addEventListener('change', function() {
            previewImage(this, 'organization_logo_preview');
        });
    }

    // Auto-calculate percentage
    const goalAmountInput = document.getElementById('goal_amount');
    const raisedAmountInput = document.getElementById('raised_amount');
    const percentageDisplay = document.getElementById('percentage_display');

    if (goalAmountInput && raisedAmountInput && percentageDisplay) {
        function calculatePercentage() {
            const goal = parseFloat(goalAmountInput.value) || 0;
            const raised = parseFloat(raisedAmountInput.value) || 0;
            
            if (goal > 0) {
                const percentage = (raised / goal) * 100;
                percentageDisplay.textContent = percentage.toFixed(1) + '%';
            } else {
                percentageDisplay.textContent = '0%';
            }
        }

        goalAmountInput.addEventListener('input', calculatePercentage);
        raisedAmountInput.addEventListener('input', calculatePercentage);
    }

    // Form validation
    const campaignForm = document.getElementById('campaign-form');
    if (campaignForm) {
        campaignForm.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const goalAmount = document.getElementById('goal_amount').value;

            if (!title) {
                e.preventDefault();
                showError('Campaign title is required.');
                return false;
            }

            if (!description) {
                e.preventDefault();
                showError('Campaign description is required.');
                return false;
            }

            if (!goalAmount || parseFloat(goalAmount) <= 0) {
                e.preventDefault();
                showError('Goal amount must be greater than 0.');
                return false;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Save Campaign?',
                text: 'Are you sure you want to save this campaign?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#fe5000',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Save!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (!result.isConfirmed) {
                    e.preventDefault();
                }
            });
        });
    }
});

// Display session messages on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check for session messages and display them
    const successMessage = document.querySelector('[data-success]');
    const errorMessage = document.querySelector('[data-error]');
    const warningMessage = document.querySelector('[data-warning]');
    const infoMessage = document.querySelector('[data-info]');

    if (successMessage) {
        showSuccess(successMessage.getAttribute('data-success'));
    }

    if (errorMessage) {
        showError(errorMessage.getAttribute('data-error'));
    }

    if (warningMessage) {
        showWarning(warningMessage.getAttribute('data-warning'));
    }

    if (infoMessage) {
        showInfo(infoMessage.getAttribute('data-info'));
    }
});

// Export functions for global use
window.CampaignCRUD = {
    showSuccess,
    showError,
    showWarning,
    showInfo,
    confirmDelete,
    confirmRestore,
    confirmForceDelete,
    previewImage
}; 