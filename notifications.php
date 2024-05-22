<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other appropriate page
    header('Location: login.php');
    exit();
}

include('config.php');

$userID = $_SESSION['id'];

// Fetch notifications with showupdates = 0 for the logged-in user
$sql = "SELECT * FROM updates WHERE showupdates = 0 ORDER BY timestamp DESC";
$result = $conn->query($sql);

// Array to store notifications
$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="notifications.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>All Notifications</h1><br>
            <a href="manage_system.php">Back to Dashboard</a><br><br>
            <button id="show-hidden-btn">Show Hidden</button>&nbsp;
            <button><a href="view_query.php">View Query</a></button>
        </header>
        <div class="notifications-list">
            <?php if (!empty($notifications)) : ?>
                <?php foreach ($notifications as $notification) : ?>
                    <div class="notification-item">
                        <p><?php echo htmlspecialchars($notification['update_text']); ?></p>
                        <small><?php echo htmlspecialchars($notification['timestamp']); ?></small>
                        <form action="hide.php" method="POST" class="mark-as-read-form">
                            <input type="hidden" name="notification_id" value="<?php echo $notification['id']; ?>">
                            <button type="button" class="mark-as-read-btn">
                                <i class="fas fa-eye-slash"></i> <!-- Font Awesome icon for hide -->
                            </button>
                            <button type="button" class="delete-btn" data-notification-id="1">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No unread notifications to display.</p>
            <?php endif; ?>
        </div>

    </div>

    <div id="popup-overlay" class="overlay"></div>
    <!-- Popup Container -->
    <div id="popup-container" class="popup" style="display: none;">
        <div class="query-form-container">
            <h1>Raise Query</h1>
            <p>Note : enter your problems here</p>
            <form id="query-form" action="process_query.php" method="POST">
                <div class="input-group">
                    <label for="query">Enter your query:</label><br><br>
                    <input type="text" id="query" name="query" required><br><br>
                </div>
                <input type="submit" value="Submit">
                &nbsp;&nbsp;<button id="close-popup">Close</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const markAsReadForms = document.querySelectorAll('.mark-as-read-form');

            markAsReadForms.forEach(form => {
                const markAsReadBtn = form.querySelector('.mark-as-read-btn');

                markAsReadBtn.addEventListener('click', () => {
                    fetch('hide.php', {
                            method: 'POST',
                            body: new FormData(form)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                form.closest('.notification-item').remove();
                                // Optionally update notification count or other UI elements
                            } else {
                                console.error('Error marking notification as read:', data.error);
                            }
                        })
                        .catch(error => console.error('Error marking notification as read:', error));
                });
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
            const showHiddenBtn = document.getElementById('show-hidden-btn');
            const notificationsList = document.querySelector('.notifications-list');

            showHiddenBtn.addEventListener('click', () => {
                // Fetch hidden notifications and append them to the notifications list
                fetch('fetch_hidden_notifications.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const hiddenNotifications = data.notifications;
                            hiddenNotifications.forEach(notification => {
                                const notificationItem = document.createElement('div');
                                notificationItem.classList.add('notification-item');
                                notificationItem.innerHTML = `
                            <p>${notification.update_text}</p>
                            <small>${notification.timestamp}</small>
                            <form action="mark_as_read.php" method="POST" class="mark-as-read-form">
                                <input type="hidden" name="notification_id" value="${notification.id}">
                                <button type="button" class="mark-as-read-btn">
                                    <i class="fas fa-eye"></i> <!-- Font Awesome icon for mark as read -->
                                </button>
                            </form>
                            <button type="button" class="delete-btn" data-notification-id="${notification.id}">
                                Delete
                            </button>
                        `;
                                notificationsList.appendChild(notificationItem);
                            });
                        } else {
                            console.error('Error fetching hidden notifications:', data.error);
                        }
                    })
                    .catch(error => console.error('Error fetching hidden notifications:', error));
            });

            // Add event listener for delete buttons
            notificationsList.addEventListener('click', (event) => {
                if (event.target.classList.contains('delete-btn')) {
                    const notificationId = event.target.dataset.notificationId;
                    if (confirm('Are you sure you want to delete this notification?')) {
                        fetch('delete_notification.php', {
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
                                } else {
                                    console.error('Error deleting notification:', data.error);
                                }
                            })
                            .catch(error => console.error('Error deleting notification:', error));
                    }
                }
            });
        });
        // JavaScript for Popup Interaction
        document.addEventListener("DOMContentLoaded", () => {
            const raiseQueryBtn = document.createElement('button');
            raiseQueryBtn.textContent = 'Raise Query';
            raiseQueryBtn.id = 'raise-query-btn';
            raiseQueryBtn.style.display = 'none'; // Initially hide the button
            document.querySelector('header').appendChild(raiseQueryBtn);

            const popupOverlay = document.getElementById('popup-overlay');
            const popupContainer = document.getElementById('popup-container');
            const raiseQueryPopupBtn = document.getElementById('raise-query-btn');
            const closePopupBtn = document.getElementById('close-popup');

            raiseQueryPopupBtn.addEventListener('click', () => {
                popupOverlay.style.display = 'block';
                popupContainer.style.display = 'block';
            });

            closePopupBtn.addEventListener('click', () => {
                popupOverlay.style.display = 'none';
                popupContainer.style.display = 'none';
            });

            const showHiddenBtn = document.getElementById('show-hidden-btn');
            showHiddenBtn.insertAdjacentElement('afterend', raiseQueryBtn); // Insert after "Show Hidden" button
            raiseQueryBtn.style.display = 'inline-block'; // Show the "Raise Query" button
        });
    </script>
</body>

</html>