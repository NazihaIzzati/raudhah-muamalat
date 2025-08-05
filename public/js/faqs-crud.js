/**
 * FAQ CRUD Operations with SweetAlert2
 */

// SweetAlert2 configuration
const SwalConfig = {
    confirmButtonColor: '#fe5000',
    cancelButtonColor: '#6b7280',
    customClass: {
        confirmButton: 'swal2-confirm',
        cancelButton: 'swal2-cancel',
        popup: 'swal2-popup'
    }
};

/**
 * Show success message
 */
function showSuccess(message, title = 'Success!') {
    // Decode HTML entities
    const decodedMessage = decodeHTMLEntities(message);
    
    Swal.fire({
        icon: 'success',
        title: title,
        text: decodedMessage,
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false,
        ...SwalConfig
    });
}

/**
 * Decode HTML entities
 */
function decodeHTMLEntities(text) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}

/**
 * Show error message
 */
function showError(message, title = 'Error!') {
    // Decode HTML entities
    const decodedMessage = decodeHTMLEntities(message);
    
    Swal.fire({
        icon: 'error',
        title: title,
        text: decodedMessage,
        ...SwalConfig
    });
}

/**
 * Show warning message
 */
function showWarning(message, title = 'Warning!') {
    // Decode HTML entities
    const decodedMessage = decodeHTMLEntities(message);
    
    Swal.fire({
        icon: 'warning',
        title: title,
        text: decodedMessage,
        ...SwalConfig
    });
}

/**
 * Show info message
 */
function showInfo(message, title = 'Info') {
    // Decode HTML entities
    const decodedMessage = decodeHTMLEntities(message);
    
    Swal.fire({
        icon: 'info',
        title: title,
        text: decodedMessage,
        ...SwalConfig
    });
}

/**
 * Confirm delete operation
 */
function confirmDelete(faqQuestion, deleteUrl) {
    Swal.fire({
        title: 'Delete FAQ',
        text: `Are you sure you want to delete "${faqQuestion}"? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete FAQ',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            // Add method override
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Confirm FAQ restore
 */
function confirmRestore(faqQuestion, restoreUrl) {
    Swal.fire({
        title: 'Restore FAQ',
        text: `Are you sure you want to restore "${faqQuestion}"? This will make it active again.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Restore FAQ',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = restoreUrl;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Confirm permanent deletion
 */
function confirmForceDelete(faqQuestion, forceDeleteUrl) {
    Swal.fire({
        title: 'Permanently Delete FAQ',
        text: `Are you sure you want to permanently delete "${faqQuestion}"? This action cannot be undone and will remove all data permanently.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete Permanently',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        confirmButtonColor: '#dc2626',
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = forceDeleteUrl;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Confirm status change
 */
function confirmStatusChange(faqQuestion, newStatus, changeUrl) {
    const statusText = newStatus === 'active' ? 'activate' : 'deactivate';
    const statusIcon = newStatus === 'active' ? 'success' : 'warning';
    
    Swal.fire({
        title: 'Change Status?',
        text: `Do you want to ${statusText} "${faqQuestion}"?`,
        icon: statusIcon,
        showCancelButton: true,
        confirmButtonText: `Yes, ${statusText} it!`,
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = changeUrl;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            // Add method override
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            form.appendChild(methodInput);
            
            // Add status
            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = newStatus;
            form.appendChild(statusInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}

/**
 * Show loading state
 */
function showLoading(message = 'Processing...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

/**
 * Show form validation errors
 */
function showValidationErrors(errors) {
    let errorMessage = '<ul class="text-left">';
    if (typeof errors === 'object') {
        Object.keys(errors).forEach(key => {
            if (Array.isArray(errors[key])) {
                errors[key].forEach(error => {
                    errorMessage += `<li>• ${error}</li>`;
                });
            } else {
                errorMessage += `<li>• ${errors[key]}</li>`;
            }
        });
    } else if (Array.isArray(errors)) {
        errors.forEach(error => {
            errorMessage += `<li>• ${error}</li>`;
        });
    } else {
        errorMessage += `<li>• ${errors}</li>`;
    }
    errorMessage += '</ul>';
    
    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: errorMessage,
        ...SwalConfig
    });
}

/**
 * Confirm form submission
 */
function confirmFormSubmission(formId, message = 'Are you sure you want to submit this form?') {
    Swal.fire({
        title: 'Confirm Submission',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        ...SwalConfig
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

/**
 * Show FAQ details in modal
 */
function showFaqDetails(faq) {
    Swal.fire({
        title: 'FAQ Details',
        html: `
            <div class="text-left max-h-96 overflow-y-auto">
                <p class="mb-3"><strong>Question:</strong> ${faq.question}</p>
                <p class="mb-3"><strong>Answer:</strong> ${faq.answer}</p>
                <p class="mb-3"><strong>Category:</strong> <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">${faq.category}</span></p>
                <p class="mb-3"><strong>Status:</strong> <span class="px-2 py-1 rounded text-xs ${faq.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${faq.status}</span></p>
                <p class="mb-3"><strong>Featured:</strong> <span class="px-2 py-1 rounded text-xs ${faq.featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'}">${faq.featured ? 'Yes' : 'No'}</span></p>
                <p class="mb-3"><strong>Display Order:</strong> ${faq.display_order}</p>
                <p class="mb-3"><strong>Created:</strong> ${faq.created_at}</p>
            </div>
        `,
        width: '600px',
        showConfirmButton: true,
        confirmButtonText: 'Close',
        ...SwalConfig
    });
}

/**
 * Delete FAQ with SweetAlert
 */
function deleteFaq(id, question) {
    const deleteUrl = `/admin/faqs/${id}`;
    confirmDelete(question, deleteUrl);
}

/**
 * Restore FAQ with SweetAlert
 */
function restoreFaq(id, question) {
    const restoreUrl = `/admin/faqs/${id}/restore`;
    confirmRestore(question, restoreUrl);
}

/**
 * Force delete FAQ with SweetAlert
 */
function forceDeleteFaq(id, question) {
    const forceDeleteUrl = `/admin/faqs/${id}/force-delete`;
    confirmForceDelete(question, forceDeleteUrl);
}

/**
 * Initialize FAQ CRUD functionality
 */
function initFaqsCRUD() {
    // Handle form submissions with confirmation
    const forms = document.querySelectorAll('form[data-confirm]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = this.getAttribute('data-confirm');
            confirmFormSubmission(this.id, message);
        });
    });
    
    // Handle delete buttons
    const deleteButtons = document.querySelectorAll('[data-delete-faq]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const faqQuestion = this.getAttribute('data-faq-question');
            const deleteUrl = this.getAttribute('data-delete-url');
            confirmDelete(faqQuestion, deleteUrl);
        });
    });
    
    // Handle restore buttons
    const restoreButtons = document.querySelectorAll('[data-restore-faq]');
    restoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const faqQuestion = this.getAttribute('data-faq-question');
            const restoreUrl = this.getAttribute('data-restore-url');
            confirmRestore(faqQuestion, restoreUrl);
        });
    });
    
    // Handle force delete buttons
    const forceDeleteButtons = document.querySelectorAll('[data-force-delete-faq]');
    forceDeleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const faqQuestion = this.getAttribute('data-faq-question');
            const forceDeleteUrl = this.getAttribute('data-force-delete-url');
            confirmForceDelete(faqQuestion, forceDeleteUrl);
        });
    });
    
    // Handle status change buttons
    const statusButtons = document.querySelectorAll('[data-status-change]');
    statusButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const faqQuestion = this.getAttribute('data-faq-question');
            const newStatus = this.getAttribute('data-new-status');
            const changeUrl = this.getAttribute('data-change-url');
            confirmStatusChange(faqQuestion, newStatus, changeUrl);
        });
    });
    
    // Handle view details buttons
    const viewButtons = document.querySelectorAll('[data-view-faq]');
    viewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const faqData = JSON.parse(this.getAttribute('data-faq-data'));
            showFaqDetails(faqData);
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
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initFaqsCRUD();
}); 