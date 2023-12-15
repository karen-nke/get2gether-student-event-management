<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, you can use the session variables
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

}
// Retrieve clubs from the database
$sql = "SELECT id, club_name FROM clubs";
$result = mysqli_query($conn, $sql);

// Check if clubs were retrieved successfully
if ($result) {
    $clubs = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $clubs = []; // Set to empty array if there is an error
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Create Event</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="page-container">

    <div class="image-container">
            <img src="Image/Logo_Vertical.png" class ="image-banner" alt="Communication Badge">
    </div>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h2>Create Event</h2>

        <label for="eventTitle">Event Title</label>
        <input type="text" id="eventTitle" name="eventTitle" required>

        <label for="eventVenue">Event Venue</label>
        <input type="text" id="eventVenue" name="eventVenue" required>

        <label for="club">Select Club</label>
        <select class="club-option" id="club" name="club" required>
            <?php foreach ($clubs as $club): ?>
                <option value="<?= $club['id'] ?>"><?= $club['club_name'] ?></option>
            <?php endforeach; ?>
        </select>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="startTime">Start Time</label>
                <input type="time" id="startTime" name="startTime" required>
            </div>
            <div style="flex: 1;">
                <label for="endTime">End Time</label>
                <input type="time" id="endTime" name="endTime" required>
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" name="startDate" required>
            </div>
            <div style="flex: 1;">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" name="endDate" required>
            </div>
        </div>

        <h2>Event Description</h2>

        <label for="eventImage">Upload Event Image</label>
        <input type="file" id="eventImage" name="eventImage">

        <label for="eventDescription">Event Description</label>
        <textarea id="eventDescription" name="eventDescription" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>

        
      
    </div>

  

    
       
               

                        
</body>

</html>

