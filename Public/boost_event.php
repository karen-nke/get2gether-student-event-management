<?php
session_start();

require_once('logic_controller.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['boost_event'])) {
        require_once('Part/db_controller.php');

        $event_id = $_POST['event_id'];

        // Fetch event details
        $event = fetchEventDetails($event_id, $conn);

        if ($event) {
            $eventTitle = $event['event_title'];
            $clubId = $event['club_id'];

            // Fetch club details for notification
            $club = fetchClubDetails($clubId, $conn);

            if ($club) {
                $clubName = $club['club_name'];

                // Create notification message

                $registrationUrl = 'event_single.php?id=' . $event_id; 
                $notificationMessage = "Event: '$eventTitle' by '$clubName' is around the corner! <a href='$registrationUrl'>Register Now</a>!";
                $notificationInsertSql = "INSERT INTO notifications (user_id, message, is_read) SELECT id, CONCAT('Event: ', '$eventTitle', ' by ', '$clubName', ' is around the corner! <a href=\"$registrationUrl\">Register Now</a>!'), 0 FROM users WHERE id != $user_id";
                
                // Insert notification into the database
                mysqli_query($conn, $notificationInsertSql);

                // Display confirmation alert
                echo "<script>
                        alert('Event Boosted!');
                        window.history.back();
                    </script>";
            } else {
                echo "Error fetching club details: Club not found.";
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