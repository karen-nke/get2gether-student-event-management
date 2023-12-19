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
                $stmt = $conn->prepare("INSERT INTO events (club_id, event_title, event_venue, start_time, end_time, start_date, end_date, event_image_path, event_description, user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssssssi", $clubId, $eventTitle, $eventVenue, $startTime, $endTime, $startDate, $endDate, $uploadFile, $eventDescription, $user_id);

        if ($stmt->execute()) {
            // Get the last inserted event ID
            $event_id = $stmt->insert_id;
            $registrationUrl = 'event_single.php?id=' . $event_id;

                    $club = fetchClubDetails($clubId, $conn);
                    $clubName = $club['club_name'];

                    $event_id = $stmt->insert_id;
                    $registrationUrl = 'event_single.php?id=' . $event_id; 
                
                    $notificationMessage = "New Event Created: '$eventTitle' has been created in '$clubName' <a href='$registrationUrl'>View Now</a>!";
                    $notificationInsertSql = "INSERT INTO notifications (user_id, message) SELECT id, CONCAT('New Event Created: ', '$eventTitle', ' has been created in ', '$clubName', ' <a href=\"', '$registrationUrl', '\">View Now</a>!') FROM users WHERE id != $user_id";
                    
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

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'get2gethersunway@gmail.com';
        $mail->Password = 'iwxkjktuwsbifbox';
        $mail->SMTPSecure = 'tls'; // Change to 'tls'
        $mail->Port = 587; // Change to 587

        $mail->setFrom('get2gethersunway@gmail.com');

        // $mail->addAddress($_POST["email"]);
        $emailSql = "SELECT email FROM users";
        $emailResult = mysqli_query($conn, $emailSql);

        if ($conn->query($sql) === TRUE) {
            echo "Event created successfully";

            // Fetch additional information from the events table
            $eventInfoSql = "SELECT start_time, end_time, start_date, end_date, event_image_path, event_description FROM events WHERE event_title = '$eventTitle'";
            $eventInfoResult = mysqli_query($conn, $eventInfoSql);

            if ($eventInfoResult) {
                $eventInfo = mysqli_fetch_assoc($eventInfoResult);

                // Include additional information in the email body
                // $mail->Body .= "<br><img src='" . $eventInfo['event_image_path'] . "' alt='Event Image'>";
                $mail->Body .= "<br><img src='cid:event_image' alt='Event Image'>";
                $mail->Body .= "<br>Event Description: " . $eventInfo['event_description'];
                $mail->Body .= "<br>Start Time: " . $eventInfo['start_time'];
                $mail->Body .= "<br>End Time: " . $eventInfo['end_time'];
                $mail->Body .= "<br>Start Date: " . $eventInfo['start_date'];
                $mail->Body .= "<br>End Date: " . $eventInfo['end_date'];


                $mail->AddEmbeddedImage($eventInfo['event_image_path'], 'event_image', 'event_image.png');
            } else {
                echo "Error fetching event information from the database.";
            }

            // Fetch email addresses from the users table
            $emailSql = "SELECT email FROM users";
            $emailResult = mysqli_query($conn, $emailSql);

            if ($emailResult) {
                while ($row = mysqli_fetch_assoc($emailResult)) {
                    // Add each email address to the recipient list
                    $mail->addAddress($row['email']);
                }
            } else {
                echo "Error fetching emails from the database.";
            }

            $mail->isHTML(true);

            $mail->Subject = "New Event: " . $eventTitle;

            $mail->send();

            echo "
                <script>
                alert('Sent Successfully');
                document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Close the database connection
    $conn->close();
}
?>
