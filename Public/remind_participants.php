<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('logic_controller.php');

// Check if the session variables are set
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['remind_participants'])) {
        require_once('Part/db_controller.php');

        $event_id = $_POST['event_id'];

        // Fetch event details
        $event = fetchEventDetails($event_id, $conn);

        if ($event) {
            $eventTitle = $event['event_title'];
            $clubId = $event['club_id'];

            $club = fetchClubDetails($clubId, $conn);

            if ($club) {
                $clubName = $club['club_name'];

                // Fetch registered participants
                $participantsSql = "SELECT users.id, users.username FROM event_registrations
                                    JOIN users ON event_registrations.user_id = users.id
                                    WHERE event_registrations.event_id = $event_id";
                $participantsResult = $conn->query($participantsSql);

                if ($participantsResult) {
                    if ($participantsResult->num_rows > 0) {
                        // Send reminder notifications
                        while ($participant = $participantsResult->fetch_assoc()) {
                            $userId = $participant['id'];
                            $username = $participant['username'];
                        
                            $reminderMessage = "Reminder: Your registered Event '{$eventTitle}' with '{$clubName}' is starting tomorrow, see you soon!";
                            $escapedReminderMessage = mysqli_real_escape_string($conn, $reminderMessage);
                        
                            $reminderInsertSql = "INSERT INTO notifications (user_id, message, is_read) VALUES ($userId, '$escapedReminderMessage', 0)";
                        
                            if (mysqli_query($conn, $reminderInsertSql)) {
                                // Successful query
                            } else {
                                echo "Error sending reminder for user '$username': " . mysqli_error($conn);
                            
                            }
                        }

                        // Display confirmation alert
                        echo "<script>
                                alert('Reminder Sent!');
                                window.history.back();
                            </script>";
                    } else {
                        echo "No participants registered for this event.";
                    }
                } else {
                    echo "Error fetching participants: " . $conn->error;
                }
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
