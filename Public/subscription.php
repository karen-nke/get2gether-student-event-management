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

$joinedClubs = getJoinedClubs($user_id, $conn);
$upcomingEventsByClub = getUpcomingEventsByClub($user_id, $conn);
//var_dump($upcomingEventsByClub);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Subscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="page-container">
        <div class="image-container">
            <img src="Image/Logo_Banner.png" class="image-banner" alt="Communication Badge">
        </div>
        <div class="section-container">
         

        <p class="title">Upcoming Events</p>
        <!-- Display upcoming events by club -->
        <?php
        if (!empty($upcomingEventsByClub)) { ?>
            <div class="section-container">
                <?php foreach ($upcomingEventsByClub as $clubName => $clubEvents) { ?>
                    <h3 class="club-name"><?= $clubName ?></h3>
                    <div class="event-container">
                        <?php foreach ($clubEvents as $event) { ?>
                            <a href="event_single.php?id=<?= $event['id']; ?>">
                                <div class="event-card">
                                    <img src="<?= $event['event_image_path']; ?>" alt="Event Image">
                                    <h2 class="title"><?= $event['event_title']; ?></h2>
                                    <p class="date">Date & Time: <?= $event['start_date']; ?></p>
                                    <p class="location">Location: <?= $event['event_venue']; ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } else {
            echo '<p>No upcoming events for joined clubs.</p>';
        } ?>
            
                            
    </div>

</body>

</html>
