<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];
} else {
    // If the user is not logged in, set $userId to null or any default value
    $userId = null;
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch event details based on the id
    $sql = "SELECT events.*, clubs.club_name, clubs.contact_email FROM events
            JOIN clubs ON events.club_id = clubs.id
            WHERE events.id = $event_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Event not found";
        exit; // Stop further execution if event not found
    }
} else {
    echo "No event selected";
    exit; // Stop further execution if no event selected
}

$userRegistered = false; // Default value, user not registered

// Check if the user is registered for the event
$checkRegistrationSql = "SELECT * FROM event_registrations WHERE user_id = $userId AND event_id = $event_id";
$checkRegistrationResult = $conn->query($checkRegistrationSql);

if ($checkRegistrationResult && $checkRegistrationResult->num_rows > 0) {
    // User is registered for the event
    $userRegistered = true;
}




function hasPermissionToViewParticipants($user_id, $club_id) {
    global $conn;

    $sql = "SELECT role FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userRole = $row['role'];

        // Check if the user has the role of 'pic' or 'committee'
        return ($userRole === 'pic' || $userRole === 'committee');
    } else {
        return false; // Assuming false if there's no role
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title><?php echo $row['event_title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    .page-container{
        max-width: 1300px;
        margin:auto;
        padding:25px
    }

    .image-container{
        display:flex;
        justify-content: center;
    }

    .image-banner{
        
        margin-left:auto;
        margin-right:auto;
        width:50%
    }

.single-event-container .title{
    color: black;
    font-size: 64px;
    font-weight: 700;
    margin-top: 35px;
    margin-bottom: 25px;
}

.single-event-container .field-name{
    color: black;
    font-size: 24px;
    font-weight: 700;
    margin-top: 50px;
}

.single-event-container .desc{

    color: #7E7E7E;
    font-size: 16px;
    font-weight: 400;

}





</style>

<body>

    <div class ="page-container">
       
    <div class="image-container">
            <img src="<?= htmlspecialchars($row["event_image_path"]) ?>" class="image-banner" alt="Event Banner">
        </div>

        <div class="single-event-container">
            <h2 class="title"><?= $row["event_title"] ?></h2>


            <p class="field-name">Description</p>
            <p class="desc"><?= $row["event_description"] ?></p>

            <p class="field-name">Event Date & Time</p>
            <p class="desc">Event Date: <?= $row["start_date"] ?></p>
            <p class="desc">Event Time: <?= $row["start_time"] ?> - <?= $row["end_time"] ?></p>

            <p class="field-name">Event Venue</p>
            <p class="desc"><?= $row["event_venue"] ?></p>

            <p class="field-name">Organizer</p>
            <p class="desc">Club Name: <?= $row["club_name"] ?></p>
            <p class="desc">Contact Email Address: <?= $row["contact_email"] ?></p>


            <a href="club_single.php?id=<?php echo $row['club_id']; ?>"><button class="btn">View Club Details</button></a>
           <?php
            if (isset($_SESSION["username"])) { 
                if (!$userRegistered) { ?>
                    <a href="register_event.php?id=<?php echo $event_id; ?>"><button class="btn">Register</button></a>
            <?php } else{ ?>
                <a href="cancel_registration.php?id=<?php echo $event_id; ?>"><button class="btn">Cancel Registration</button></a>
                <?php }
            
            } else{ ?>

                <a href="Login/login.php"><button class="btn">Login to Register</button></a>

            <?php } ?>

            <?php
                if ($userId !== null && hasPermissionToViewParticipants($userId, $row['club_id'])) {
                    $eventId = $row['id'];
                
                    // Fetch registered participants
                    $participantsSql = "SELECT users.username FROM event_registrations
                                        JOIN users ON event_registrations.user_id = users.id
                                        WHERE event_registrations.event_id = $eventId";
                    $participantsResult = $conn->query($participantsSql);
                
                    if ($participantsResult->num_rows > 0) {
                        echo '<div class="participants-section">';
                        echo '<p class="field-name"> Registered Participants </p>';

                        echo '<ul>';
                        
                        while ($participant = $participantsResult->fetch_assoc()) {
                            echo '<li>' . htmlspecialchars($participant['username']) . '</li>';
                        }
                
                        echo '</ul>';
                        echo '</div>';
                    } else {
                        echo '<p>No registered participants for this event.</p>';
                    }
                }
        
            ?>
        </div> <!-- Close div for single-event-container -->

        <?php

        require_once('Part/event_section.php');
        require_once('Part/club_section.php');
        
        ?>
    </div>

    
            
                        
</body>

</html>

