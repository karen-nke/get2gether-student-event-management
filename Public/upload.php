<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

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

        // Insert data into the database
        $sql = "INSERT INTO events (club_id, event_title, event_venue, start_time, end_time, start_date, end_date, event_image_path, event_description)
                VALUES ('$clubId', '$eventTitle', '$eventVenue', '$startTime', '$endTime', '$startDate', '$endDate', '$uploadFile', '$eventDescription')";

        if ($conn->query($sql) === TRUE) {
            echo "Event created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }

    // Close the database connection
    $conn->close();
}


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get form data
//     $eventTitle = $_POST['eventTitle'];
//     $eventVenue = $_POST['eventVenue'];
//     $startTime = $_POST['startTime'];
//     $endTime = $_POST['endTime'];
//     $startDate = $_POST['startDate'];
//     $endDate = $_POST['endDate'];
//     $eventDescription = $_POST['eventDescription'];

//     // Upload image
//     $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Applications/XAMPP/xamppfiles/htdocs/Untitled/Public/uploads/";
//     $fileName = uniqid() . '_' . basename($_FILES["eventImage"]["name"]);
//     $targetPath = $uploadDirectory . $fileName;

//     if (move_uploaded_file($_FILES["eventImage"]["tmp_name"], $targetPath)) {

//         // Insert data into the database
//         $sql = "INSERT INTO events (event_title, event_venue, start_time, end_time, start_date, end_date, event_image_path, event_description)
//                 VALUES ('$eventTitle', '$eventVenue', '$startTime', '$endTime', '$startDate', '$endDate', '$targetPath', '$eventDescription')";

//         if ($conn->query($sql) === TRUE) {
//             echo "Event created successfully";
//         } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     } else {
//         echo "Error uploading the file.";
//     }

//     // Close the database connection
//     $conn->close();
// }



?>