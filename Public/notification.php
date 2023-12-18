<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

}

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

$sql = "SELECT * FROM notifications WHERE user_id = $user_id AND is_read = FALSE ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $notification = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
} else {
    echo "Error fetching notifications: " . mysqli_error($conn);
}



// Fetch unread notifications
$sql = "SELECT * FROM notifications WHERE user_id = $user_id AND is_read = FALSE ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['mark_as_read'])) {
    // Mark all notifications as read
    $updateSql = "UPDATE notifications SET is_read = TRUE WHERE user_id = $user_id AND is_read = FALSE";
    mysqli_query($conn, $updateSql);

    echo "<script>
    alert('Marked All As Read');
    window.location.href = 'notification.php';
    </script>";
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    .notification {
    background-color: #f8f8f8; /* Adjust the background color as needed */
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.notification p {
    margin: 0;
}

.notification small {
    color: #888;
}
</style>

<body>

<div class ="page-container">
        <div class="image-container">
            <img src="Image/Logo_Banner.png" class="image-banner" alt="Logo">
        </div>

    <div class ="section-container">
        <p class ="title">Notification</p>

    </div>

<?php
if ($result) {
    while ($notification = mysqli_fetch_assoc($result)) {
        echo '<div class="notification">';
        echo '<p>' . $notification['message'] . '</p>';
        echo '<small>' . $notification['created_at'] . '</small>';
        echo '</div>';


    }
} else {
    echo "Error fetching notifications: " . mysqli_error($conn);
}
?>


<form method="post" action="" style="all: initial;">
                        
    <button type="submit" class="btn" name="mark_as_read">Mark As Read</button>
</form>

</div>

</body>