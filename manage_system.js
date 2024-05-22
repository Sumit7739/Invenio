function loadNotificationIcon() {
    const notificationIcon = document.getElementById("notification-icon");
    const notificationDropdown = document.getElementById("notification-dropdown");

    notificationIcon.addEventListener("click", (event) => {
        event.stopPropagation(); // Prevent the click event from bubbling up
        notificationDropdown.style.display = notificationDropdown.style.display === "block" ? "none" : "block";
    });

    document.addEventListener("click", (event) => {
        if (!notificationDropdown.contains(event.target) && event.target !== notificationIcon) {
            notificationDropdown.style.display = "none";
        }
    });
}

function markAsRead() {
    const markAsReadCheckboxes = document.querySelectorAll('.mark-as-read');

    markAsReadCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (event) => {
            if (event.target.checked) {
                const notificationId = event.target.getAttribute('data-id');

                fetch('mark_as_read.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: notificationId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            event.target.closest('.notification-item').remove();
                            const notificationCount = document.getElementById('notification-count');
                            const count = parseInt(notificationCount.textContent) - 1;
                            notificationCount.textContent = count;
                            if (count === 0) {
                                notificationCount.style.display = 'none';
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });
}

// Load the notification icon and mark as read functionality when the DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    loadNotificationIcon();
    markAsRead();
});