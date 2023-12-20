<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('logic_controller.php');

// Check if the session variables are set
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cancel_event'])) {
        require_once('Part/db_controller.php'); 

        $event_id = $_POST['event_id'];

        // Fetch event details before deletion
        $event = fetchEventDetails($event_id, $conn);

        if ($event) {
            $eventTitle = $event['event_title'];
            $clubId = $event['club_id'];

            // Delete registrations for the event from the event_registrations table
            $deleteRegistrationsSql = "DELETE FROM event_registrations WHERE event_id = $event_id";

            if ($conn->query($deleteRegistrationsSql) === TRUE) {
                
                $deleteEventSql = "DELETE FROM events WHERE id = $event_id";

                if ($conn->query($deleteEventSql) === TRUE) {
                    // Fetch club details for notification
                    $club = fetchClubDetails($clubId, $conn);

                    if ($club) {
                        $clubName = $club['club_name'];

                        // Create notification message
                        $notificationMessage = "Event: '$eventTitle' has been cancelled by '$clubName'";
                        $notificationInsertSql = "INSERT INTO notifications (user_id, message, is_read) SELECT id, CONCAT('Event: ', '$eventTitle', ' has been cancelled by ', '$clubName'), 0 FROM users WHERE id != $user_id";

                        // Insert notification into the database
                        mysqli_query($conn, $notificationInsertSql);

                        // Display confirmation alert
                        echo "<script>
                                alert('Cancelled Confirmed');
                                window.location.href = 'index.php';
                            </script>";
                    } else {
                        echo "Error fetching club details: Club not found.";
                    }
                } else {
                    echo "Error canceling event: " . $conn->error;
                }
            } else {
                echo "Error deleting event registrations: " . $conn->error;
            }
        } else {
            echo "Error fetching event details: Event not found.";
        }

        // Close the database connection
        $conn->close();
    }
} else {

    header("Location: Login/login.php");
    exit();
}
?>
