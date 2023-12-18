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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Events</title>
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

        <form method="get" action="search_results.php">
            <label for="search_term">Search Events</label>
            <input type="text" name="search_term" id="search_term" required>
            <button type="submit" class ="btn">Search</button>
        </form>

        <?php
        // Fetch upcoming events
        $upcomingEvents = fetchEvents($conn, "events.end_date >= CURDATE()");
        ?>

        <div class="section-container">
            <p class="title">Upcoming Event</p>

            <div class="event-container">
            <div class="event-container">
                <?php foreach ($upcomingEvents as $event): ?>
                    <a href="event_single.php?id=<?= $event['id']; ?>">
                        <div class="event-card">
                            <img src="<?= htmlspecialchars($event['event_image_path']); ?>" alt="Event Image">
                            <h2 class="title"><?= $event['event_title']; ?></h2>
                            <p class="date">Date & Time: <?= $event['start_date']; ?></p>
                            <p class="location">Location: <?= $event['event_venue']; ?></p>
                            <p class="location">Club: <?= $event['club_name']; ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            </div>
        </div>

        <?php
        // Fetch past events
        $pastEvents = fetchEvents($conn, "events.end_date < CURDATE()");
        ?>

        <div class="section-container">
            <p class="title">Past Event</p>

            <div class="event-container">
                <?php
                foreach ($pastEvents as $event): ?>
                    <div class="event-card">
                            <img src="<?= htmlspecialchars($event['event_image_path']); ?>" alt="Event Image">
                            <h2 class="title"><?= $event['event_title']; ?></h2>
                            <p class="date">Date & Time: <?= $event['start_date']; ?></p>
                            <p class="location">Location: <?= $event['event_venue']; ?></p>
                            <p class="location">Club: <?= $event['club_name']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>
