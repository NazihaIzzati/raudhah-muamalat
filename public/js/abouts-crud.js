/**
 * About Content CRUD Operations with SweetAlert2
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
function confirmDelete(aboutName, deleteUrl) {
    Swal.fire({
        title: 'Delete About Content',
        text: `Are you sure you want to delete "${aboutName}"? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete Content',
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
 * Confirm about content restore
 */
function confirmRestore(aboutName, restoreUrl) {
    Swal.fire({
        title: 'Restore About Content',
        text: `Are you sure you want to restore "${aboutName}"? This will make it active again.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Restore Content',
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
function confirmForceDelete(aboutName, forceDeleteUrl) {
    Swal.fire({
        title: 'Permanently Delete About Content',
        text: `Are you sure you want to permanently delete "${aboutName}"? This action cannot be undone and will remove all data permanently.`,
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
function confirmStatusChange(aboutName, newStatus, changeUrl) {
    const statusText = newStatus === 'active' ? 'activate' : 'deactivate';
    const statusIcon = newStatus === 'active' ? 'success' : 'warning';
    
    Swal.fire({
        title: 'Change Status?',
        text: `Do you want to ${statusText} "${aboutName}"?`,
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
 * Show about content details in modal
 */
function showAboutDetails(about) {
    let highlightsHtml = '';
    if (about.hero_highlights && about.hero_highlights.length > 0) {
        highlightsHtml = '<p class="mb-2"><strong>Hero Highlights:</strong></p><ul class="list-disc list-inside mb-3">';
        about.hero_highlights.forEach(highlight => {
            highlightsHtml += `<li>${highlight.text}</li>`;
        });
        highlightsHtml += '</ul>';
    }

    let pillsHtml = '';
    if (about.hero_pills && about.hero_pills.length > 0) {
        pillsHtml = '<p class="mb-2"><strong>Hero Pills:</strong></p><ul class="list-disc list-inside mb-3">';
        about.hero_pills.forEach(pill => {
            pillsHtml += `<li>${pill.text}</li>`;
        });
        pillsHtml += '</ul>';
    }

    let ctaButtonsHtml = '';
    if (about.hero_cta_buttons && about.hero_cta_buttons.length > 0) {
        ctaButtonsHtml = '<p class="mb-2"><strong>CTA Buttons:</strong></p><ul class="list-disc list-inside mb-3">';
        about.hero_cta_buttons.forEach(button => {
            ctaButtonsHtml += `<li>${button.text} (${button.type})</li>`;
        });
        ctaButtonsHtml += '</ul>';
    }

    Swal.fire({
        title: about.title,
        html: `
            <div class="text-left max-h-96 overflow-y-auto">
                <p class="mb-3"><strong>Status:</strong> <span class="px-2 py-1 rounded text-xs ${about.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${about.status}</span></p>
                <p class="mb-3"><strong>Is Active:</strong> <span class="px-2 py-1 rounded text-xs ${about.is_active ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'}">${about.is_active ? 'Yes' : 'No'}</span></p>
                <p class="mb-3"><strong>Display Order:</strong> ${about.display_order}</p>
                <p class="mb-3"><strong>Hero Badge:</strong> ${about.hero_badge_text || 'Not set'}</p>
                <p class="mb-3"><strong>Hero Title:</strong> ${about.hero_title || 'Not set'}</p>
                <p class="mb-3"><strong>Hero Subtitle:</strong> ${about.hero_subtitle || 'Not set'}</p>
                <p class="mb-3"><strong>Hero Description:</strong> ${about.hero_description || 'Not set'}</p>
                ${highlightsHtml}
                ${pillsHtml}
                ${ctaButtonsHtml}
                <p class="mb-3"><strong>Mission:</strong> ${about.mission ? about.mission.substring(0, 100) + '...' : 'Not set'}</p>
                <p class="mb-3"><strong>Vision:</strong> ${about.vision ? about.vision.substring(0, 100) + '...' : 'Not set'}</p>
                <p class="mb-3"><strong>Values:</strong> ${about.values ? about.values.substring(0, 100) + '...' : 'Not set'}</p>
                <p class="mb-3"><strong>Bank Muamalat Title:</strong> ${about.bank_muamalat_title || 'Not set'}</p>
                <p class="mb-3"><strong>Payment Section Title:</strong> ${about.payment_section_title || 'Not set'}</p>
                <p class="mb-3"><strong>Created:</strong> ${about.created_at}</p>
            </div>
        `,
        width: '700px',
        showConfirmButton: true,
        confirmButtonText: 'Close',
        ...SwalConfig
    });
}

/**
 * Delete about content with SweetAlert
 */
function deleteAbout(id, title) {
    const deleteUrl = `/admin/abouts/${id}`;
    confirmDelete(title, deleteUrl);
}

/**
 * Restore about content with SweetAlert
 */
function restoreAbout(id, title) {
    const restoreUrl = `/admin/abouts/${id}/restore`;
    confirmRestore(title, restoreUrl);
}

/**
 * Force delete about content with SweetAlert
 */
function forceDeleteAbout(id, title) {
    const forceDeleteUrl = `/admin/abouts/${id}/force-delete`;
    confirmForceDelete(title, forceDeleteUrl);
}

/**
 * Initialize about content CRUD functionality
 */
function initAboutsCRUD() {
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
    const deleteButtons = document.querySelectorAll('[data-delete-about]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const aboutName = this.getAttribute('data-about-name');
            const deleteUrl = this.getAttribute('data-delete-url');
            confirmDelete(aboutName, deleteUrl);
        });
    });
    
    // Handle restore buttons
    const restoreButtons = document.querySelectorAll('[data-restore-about]');
    restoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const aboutName = this.getAttribute('data-about-name');
            const restoreUrl = this.getAttribute('data-restore-url');
            confirmRestore(aboutName, restoreUrl);
        });
    });
    
    // Handle force delete buttons
    const forceDeleteButtons = document.querySelectorAll('[data-force-delete-about]');
    forceDeleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const aboutName = this.getAttribute('data-about-name');
            const forceDeleteUrl = this.getAttribute('data-force-delete-url');
            confirmForceDelete(aboutName, forceDeleteUrl);
        });
    });
    
    // Handle status change buttons
    const statusButtons = document.querySelectorAll('[data-status-change]');
    statusButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const aboutName = this.getAttribute('data-about-name');
            const newStatus = this.getAttribute('data-new-status');
            const changeUrl = this.getAttribute('data-change-url');
            confirmStatusChange(aboutName, newStatus, changeUrl);
        });
    });
    
    // Handle view details buttons
    const viewButtons = document.querySelectorAll('[data-view-about]');
    viewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const aboutData = JSON.parse(this.getAttribute('data-about-data'));
            showAboutDetails(aboutData);
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
    initAboutsCRUD();
}); 