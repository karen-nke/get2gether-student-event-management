<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');
require_once('logic_controller.php');


if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
} else {
    // If the user is not logged in, set $user_id to null or any default value
    $user_id = null;
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch event details based on the id
    $eventDetails = fetchEventDetails_ID($event_id, $conn);

    if (!$eventDetails) {
        echo "Event not found";
        exit; // Stop further execution if event not found
    }
} else {
    echo "No event selected";
    exit; // Stop further execution if no event selected
}

$club_id = $eventDetails['club_id'];
$userRegistered = isUserRegisteredForEvent($user_id, $event_id, $conn);

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $userRole = fetchUserRole($user_id, $club_id, $conn);
    $hasPermissionToViewParticipants = hasPermissionToViewParticipants($user_id, $club_id);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title><?php echo $eventDetails['event_title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class ="page-container">
       
    <div class="image-container">
            <img src="<?= htmlspecialchars($eventDetails["event_image_path"]) ?>" class="image-banner" alt="Event Banner">
        </div>

        <div class="single-event-container">
            <h2 class="title"><?= $eventDetails["event_title"] ?></h2>


            <p class="field-name">Description</p>
            <p class="desc"><?= $eventDetails["event_description"] ?></p>

            <p class="field-name">Event Date & Time</p>
            <p class="desc">Event Date: <?= $eventDetails["start_date"] ?></p>
            <p class="desc">Event Time: <?= $eventDetails["start_time"] ?> - <?= $eventDetails["end_time"] ?></p>

            <p class="field-name">Event Venue</p>
            <p class="desc"><?= $eventDetails["event_venue"] ?></p>

            <p class="field-name">Organizer</p>
            <p class="desc">Club Name: <?= $eventDetails["club_name"] ?></p>
            <p class="desc">Contact Email Address: <?= $eventDetails["contact_email"] ?></p>

            

            <a href="club_single.php?id=<?php echo $eventDetails['club_id']; ?>"><button class="btn">View Club Details</button></a>
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
                if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
                    if ($userRole === 'pic' || $userRole === 'committee'): ?>
                        <a href="edit_event.php?id=<?php echo $event_id; ?>">
                            <button class="btn">Edit Events</button>
                        </a>
                    <?php endif;
                }
            ?>

            <?php
                if ($user_id !== null && hasPermissionToViewParticipants($user_id, $eventDetails['club_id'])) {
                    $event_id = $eventDetails['id'];
                
                    // Fetch registered participants
                    $participantsSql = "SELECT users.username FROM event_registrations
                                        JOIN users ON event_registrations.user_id = users.id
                                        WHERE event_registrations.event_id = $event_id";
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
        </div> 

        <?php

        require_once('Part/event_section.php');
        require_once('Part/club_section.php');
        
        ?>
    </div>

    
            
                        
</body>

</html>

