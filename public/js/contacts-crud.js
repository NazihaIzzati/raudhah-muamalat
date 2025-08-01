// SweetAlert2 Configuration for Contact Module
const SwalConfig = {
    confirmButtonColor: '#fe5000',
    cancelButtonColor: '#6b7280',
    reverseButtons: true,
    focusCancel: true
};

// Decode HTML entities for proper display
function decodeHTMLEntities(text) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}

// Success notification
function showSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: decodeHTMLEntities(message),
        ...SwalConfig
    });
}

// Error notification
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: decodeHTMLEntities(message),
        ...SwalConfig
    });
}

// Warning notification
function showWarning(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        text: decodeHTMLEntities(message),
        ...SwalConfig
    });
}

// Info notification
function showInfo(message) {
    Swal.fire({
        icon: 'info',
        title: 'Information',
        text: decodeHTMLEntities(message),
        ...SwalConfig
    });
}

// Confirm delete with SweetAlert2
function confirmDelete(contactName, deleteUrl) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to move "${decodeHTMLEntities(contactName)}" to trash?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, move to trash!',
        cancelButtonText: 'Cancel',
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
            
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

// Confirm restore with SweetAlert2
function confirmRestore(contactName, restoreUrl) {
    Swal.fire({
        title: 'Restore Contact?',
        text: `Do you want to restore "${decodeHTMLEntities(contactName)}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, restore!',
        cancelButtonText: 'Cancel',
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = restoreUrl;
            
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

// Confirm force delete with SweetAlert2
function confirmForceDelete(contactName, forceDeleteUrl) {
    Swal.fire({
        title: 'Permanently Delete?',
        text: `Are you sure you want to permanently delete "${decodeHTMLEntities(contactName)}"? This action cannot be undone!`,
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete permanently!',
        cancelButtonText: 'Cancel',
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = forceDeleteUrl;
            
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

// Confirm status change with SweetAlert2
function confirmStatusChange(contactName, newStatus, updateUrl) {
    Swal.fire({
        title: 'Update Status?',
        text: `Do you want to change the status of "${decodeHTMLEntities(contactName)}" to "${newStatus}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, update!',
        cancelButtonText: 'Cancel',
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = updateUrl;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PUT';
            
            const statusField = document.createElement('input');
            statusField.type = 'hidden';
            statusField.name = 'status';
            statusField.value = newStatus;
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            form.appendChild(statusField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Show loading state
function showLoading() {
    Swal.fire({
        title: 'Processing...',
        text: 'Please wait while we process your request.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

// Show validation errors
function showValidationErrors(errors) {
    let errorMessage = 'Please fix the following errors:\n\n';
    for (const [field, messages] of Object.entries(errors)) {
        errorMessage += `${field}: ${messages.join(', ')}\n`;
    }
    
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: errorMessage,
        ...SwalConfig
    });
}

// Confirm form submission
function confirmFormSubmission(formId, confirmMessage = 'Are you sure you want to submit this form?') {
    Swal.fire({
        title: 'Confirm Submission',
        text: confirmMessage,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit!',
        cancelButtonText: 'Cancel',
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// Show contact details in modal
function showContactDetails(contact) {
    Swal.fire({
        title: contact.subject,
        html: `
            <div class="text-left">
                <p><strong>From:</strong> ${contact.full_name}</p>
                <p><strong>Email:</strong> ${contact.email}</p>
                <p><strong>Phone:</strong> ${contact.phone || 'Not provided'}</p>
                <p><strong>Status:</strong> <span class="badge ${contact.status_badge_class}">${contact.status_display_name}</span></p>
                <p><strong>Message:</strong></p>
                <div class="bg-gray-100 p-3 rounded mt-2">${contact.message}</div>
            </div>
        `,
        width: '600px',
        confirmButtonText: 'Close',
        ...SwalConfig
    });
}

// Initialize contact CRUD functionality
function initContactsCRUD() {
    // Handle form submissions with confirmation
    const forms = document.querySelectorAll('form[data-confirm]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const confirmMessage = this.getAttribute('data-confirm');
            confirmFormSubmission(this.id, confirmMessage);
        });
    });

    // Handle delete buttons
    const deleteButtons = document.querySelectorAll('[data-delete-url]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const contactName = this.getAttribute('data-contact-name');
            const deleteUrl = this.getAttribute('data-delete-url');
            confirmDelete(contactName, deleteUrl);
        });
    });

    // Handle restore buttons
    const restoreButtons = document.querySelectorAll('[data-restore-url]');
    restoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const contactName = this.getAttribute('data-contact-name');
            const restoreUrl = this.getAttribute('data-restore-url');
            confirmRestore(contactName, restoreUrl);
        });
    });

    // Handle force delete buttons
    const forceDeleteButtons = document.querySelectorAll('[data-force-delete-url]');
    forceDeleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const contactName = this.getAttribute('data-contact-name');
            const forceDeleteUrl = this.getAttribute('data-force-delete-url');
            confirmForceDelete(contactName, forceDeleteUrl);
        });
    });

    // Handle status change buttons
    const statusButtons = document.querySelectorAll('[data-status-change]');
    statusButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const contactName = this.getAttribute('data-contact-name');
            const newStatus = this.getAttribute('data-new-status');
            const updateUrl = this.getAttribute('data-update-url');
            confirmStatusChange(contactName, newStatus, updateUrl);
        });
    });

    // Show success messages from session
    const successMessage = document.querySelector('[data-success-message]');
    if (successMessage) {
        const message = successMessage.getAttribute('data-success-message');
        showSuccess(message);
    }

    // Show error messages from session
    const errorMessage = document.querySelector('[data-error-message]');
    if (errorMessage) {
        const message = errorMessage.getAttribute('data-error-message');
        showError(message);
    }

    // Show validation errors
    const validationErrors = document.querySelector('[data-validation-errors]');
    if (validationErrors) {
        try {
            const errors = JSON.parse(validationErrors.getAttribute('data-validation-errors'));
            showValidationErrors(errors);
        } catch (e) {
            console.error('Error parsing validation errors:', e);
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initContactsCRUD();
}); 