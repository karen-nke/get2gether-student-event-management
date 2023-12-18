<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Part/db_controller.php');
require_once('Part/navbar.php');
require_once('logic_controller.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    $uploadDir = 'uploads/';
    $eventTitle = $_POST['eventTitle'];

    // Create a new file name based on the event name
    $newFileName = strtolower($eventTitle) . '.png';
    $uploadFile = $uploadDir . $newFileName;

    if (move_uploaded_file($_FILES['eventImage']['tmp_name'], $uploadFile)) {
        // File uploaded successfully
        echo "File is valid and was successfully uploaded.";

        // Retrieve other form data
        $eventVenue = $_POST['eventVenue'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $clubId = $_POST['club'];
        $eventDescription = $_POST['eventDescription'];

        // Check user role for the specified club
        $roleSql = "SELECT role FROM memberships WHERE user_id = '$user_id' AND club_id = '$clubId'";
        $roleResult = mysqli_query($conn, $roleSql);

        if ($roleResult) {
            $userRole = mysqli_fetch_assoc($roleResult)['role'];

            // Allow event creation only for "PIC" or "committee"
            if ($userRole == "pic" || $userRole == "committee") {
                // Insert data into the database
                $sql = "INSERT INTO events (club_id, event_title, event_venue, start_time, end_time, start_date, end_date, event_image_path, event_description, user_id)
                        VALUES ('$clubId', '$eventTitle', '$eventVenue', '$startTime', '$endTime', '$startDate', '$endDate', '$uploadFile', '$eventDescription', '$user_id')";

                if ($conn->query($sql) === TRUE) {

                    $club = fetchClubDetails($clubId, $conn);
                    $clubName = $club['club_name'];

                    $notificationMessage = "New Event Created: '$eventTitle' has been created in '$clubName'";
                    $notificationInsertSql = "INSERT INTO notifications (user_id, message) SELECT id, CONCAT('New Event Created: ', '$eventTitle', ' has been created in ', '$clubName') FROM users WHERE id != $user_id";
                    
                    mysqli_query($conn, $notificationInsertSql);


                    echo "<script>
                        alert('Event created successfully');
                        window.location.href = 'index.php';
                    </script>";
                                    
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "You don't have the necessary permissions to create events for this club.";
            }
        } else {
            echo "Error fetching user role from the database.";
        }
    } else {
        echo "Error uploading the file.";
    }

    // Close the database connection
    $conn->close();
}
?>
