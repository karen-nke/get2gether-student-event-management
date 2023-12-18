<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cancel_event'])) {
    require_once('Part/db_controller.php'); 

    $event_id = $_POST['event_id'];

    // Delete the event from the database
    $sql = "DELETE FROM events WHERE id = $event_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Cancelled Confirmed');
                window.location.href = 'index.php';
            </script>";
    } else {
        echo "Error canceling event: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>