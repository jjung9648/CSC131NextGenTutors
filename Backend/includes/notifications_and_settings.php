<?php
require_once __DIR__ . '/../includes/notification.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not authenticated
    header('Location: /Frontend/landing-page.html');
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receiveEmail = isset($_POST['receive_email']) ? 1 : 0;
    Notification::setUserPreference($userId, $receiveEmail);
    echo "Preferences updated.";
}

$preference = Notification::getUserPreference($userId);
$notifications = Notification::getNotifications($userId);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notifications and Settings</title>
    <link rel="stylesheet" type="text/css" href="/Frontend/style.css">
</head>
<body>
    <h2>Notification Settings</h2>
    <form method="POST" action="">
        <label>
            <input type="checkbox" name="receive_email" <?php echo ($preference && $preference['receive_email']) ? 'checked' : ''; ?>>
            Receive notifications by email
        </label>
        <button type="submit">Save</button>
    </form>

    <h2>Notifications</h2>
    <ul>
        <?php foreach ($notifications as $notification): ?>
            <li><?php echo htmlspecialchars($notification['message']); ?> - <?php echo $notification['created_at']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>