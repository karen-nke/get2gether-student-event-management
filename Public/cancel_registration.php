<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $event_id = $_GET['id'];

    require_once('Part/db_controller.php');

    // Delete the user's registration for the event
    $deleteSql = "DELETE FROM event_registrations WHERE user_id = $user_id AND event_id = $event_id";
    if ($conn->query($deleteSql)) {
        // Registration successfully canceled
        echo "<script>
                alert('Cancelled Confirmed');
                window.location.href = 'event_single.php?id=" . urlencode($event_id) . "';
            </script>";
        exit();
    } else {
        echo "Error canceling registration: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to an error page or handle the case where user_id or event_id is not set
    header("Location: error.php");
    exit();
}
?>