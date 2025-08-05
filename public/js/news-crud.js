/**
 * News CRUD Operations with SweetAlert2
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
function confirmDelete(newsTitle, deleteUrl) {
    Swal.fire({
        title: 'Delete News',
        text: `Are you sure you want to delete "${newsTitle}"? This action cannot be undone.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete News',
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
 * Confirm news restore
 */
function confirmRestore(newsTitle, restoreUrl) {
    Swal.fire({
        title: 'Restore News',
        text: `Are you sure you want to restore "${newsTitle}"? This will make it active again.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Restore News',
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
function confirmForceDelete(newsTitle, forceDeleteUrl) {
    Swal.fire({
        title: 'Permanently Delete News',
        text: `Are you sure you want to permanently delete "${newsTitle}"? This action cannot be undone and will remove all data permanently.`,
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
function confirmStatusChange(newsTitle, newStatus, changeUrl) {
    const statusText = newStatus === 'published' ? 'publish' : 'unpublish';
    const statusIcon = newStatus === 'published' ? 'success' : 'warning';
    
    Swal.fire({
        title: 'Change Status?',
        text: `Do you want to ${statusText} "${newsTitle}"?`,
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
 * Show news details in modal
 */
function showNewsDetails(news) {
    Swal.fire({
        title: 'News Details',
        html: `
            <div class="text-left max-h-96 overflow-y-auto">
                <p class="mb-3"><strong>Title:</strong> ${news.title}</p>
                <p class="mb-3"><strong>Content:</strong> ${news.content ? news.content.substring(0, 200) + '...' : 'No content'}</p>
                <p class="mb-3"><strong>Category:</strong> <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">${news.category}</span></p>
                <p class="mb-3"><strong>Status:</strong> <span class="px-2 py-1 rounded text-xs ${news.status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">${news.status}</span></p>
                <p class="mb-3"><strong>Featured:</strong> <span class="px-2 py-1 rounded text-xs ${news.featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'}">${news.featured ? 'Yes' : 'No'}</span></p>
                <p class="mb-3"><strong>Display Order:</strong> ${news.display_order}</p>
                <p class="mb-3"><strong>Created:</strong> ${news.created_at}</p>
                ${news.published_at ? `<p class="mb-3"><strong>Published:</strong> ${news.published_at}</p>` : ''}
            </div>
        `,
        width: '600px',
        showConfirmButton: true,
        confirmButtonText: 'Close',
        ...SwalConfig
    });
}

/**
 * Delete news with SweetAlert
 */
function deleteNews(id, title) {
    const deleteUrl = `/admin/news/${id}`;
    confirmDelete(title, deleteUrl);
}

/**
 * Restore news with SweetAlert
 */
function restoreNews(id, title) {
    const restoreUrl = `/admin/news/${id}/restore`;
    confirmRestore(title, restoreUrl);
}

/**
 * Force delete news with SweetAlert
 */
function forceDeleteNews(id, title) {
    const forceDeleteUrl = `/admin/news/${id}/force-delete`;
    confirmForceDelete(title, forceDeleteUrl);
}

/**
 * Initialize News CRUD functionality
 */
function initNewsCRUD() {
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
    const deleteButtons = document.querySelectorAll('[data-delete-news]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const newsTitle = this.getAttribute('data-news-title');
            const deleteUrl = this.getAttribute('data-delete-url');
            confirmDelete(newsTitle, deleteUrl);
        });
    });
    
    // Handle restore buttons
    const restoreButtons = document.querySelectorAll('[data-restore-news]');
    restoreButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const newsTitle = this.getAttribute('data-news-title');
            const restoreUrl = this.getAttribute('data-restore-url');
            confirmRestore(newsTitle, restoreUrl);
        });
    });
    
    // Handle force delete buttons
    const forceDeleteButtons = document.querySelectorAll('[data-force-delete-news]');
    forceDeleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const newsTitle = this.getAttribute('data-news-title');
            const forceDeleteUrl = this.getAttribute('data-force-delete-url');
            confirmForceDelete(newsTitle, forceDeleteUrl);
        });
    });
    
    // Handle status change buttons
    const statusButtons = document.querySelectorAll('[data-status-change]');
    statusButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const newsTitle = this.getAttribute('data-news-title');
            const newStatus = this.getAttribute('data-new-status');
            const changeUrl = this.getAttribute('data-change-url');
            confirmStatusChange(newsTitle, newStatus, changeUrl);
        });
    });
    
    // Handle view details buttons
    const viewButtons = document.querySelectorAll('[data-view-news]');
    viewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const newsData = JSON.parse(this.getAttribute('data-news-data'));
            showNewsDetails(newsData);
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
    initNewsCRUD();
}); 