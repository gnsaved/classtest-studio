document.addEventListener('DOMContentLoaded', function() {
    console.log('ClassTest Studio loaded');
});

function confirmDelete(message) {
    return confirm(message || 'Are you sure you want to delete this?');
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
