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

    // Fetch user details from the database based on user_id
    $userDetails = getUserDetails($user_id, $conn);

    if (!$userDetails) {
        // Handle error or redirect to an error page
        echo "Error fetching user details";
        exit();
    }
}
$registeredEvents = getRegisteredEvents($user_id, $conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="page-container">
        <div class="image-container">
            <img src="Image/Logo_Placeholder.png" class="image-banner" alt="Club Banner">
        </div>

        <div class="single-container">
        <h2 class="title">
            <?php
            if (!empty($userDetails['first_name'])) {
                echo $userDetails['first_name'] . ' ' . $userDetails['last_name'];
            } else {
                echo $username;
            }
            ?>
        </h2>
            <p class="field-name"> Bio </p>
            <p class="desc"><?= $userDetails['bio']; ?></p>

            <a href="edit_profile.php"><button class="btn">Edit Profile</button></a>

            <!-- Display user's joined clubs -->
            <div class="joined-clubs">
                <h2 class="field-name">Joined Clubs</h2>
                <?php
                $joinedClubs = getJoinedClubs($user_id, $conn);

                if (!empty($joinedClubs)) {
                    echo '<ul>';
                    foreach ($joinedClubs as $club) {
                        echo '<li><a href="club_single.php?id=' . $club['id'] . '">' . $club['club_name'] . '</a></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No joined clubs yet.</p>';
                }
                ?>
            </div>

            <!-- Display registered events -->
            <div class="registered-events">
                <h2 class="field-name">Registered Events</h2>
                <?php
                if (!empty($registeredEvents)) {
                    foreach ($registeredEvents as $event) {
                ?>
                        <a href="event_single.php?id=<?= $event['id']; ?>">
                            <div class="event-card">
                                <img src="<?= $event['event_image_path']; ?>" alt="Event Image">
                                <h2 class="title"><?= $event['event_title']; ?></h2>
                                <p class="date">Date & Time: <?= $event['start_date']; ?></p>
                                <p class="location">Location: <?= $event['event_venue']; ?></p>
                                <p class="location">Club: <?= $event['club_name']; ?></p>
                            </div>
                        </a>
                <?php
                    }
                } else {
                    echo '<p>No registered events yet.</p>';
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>
