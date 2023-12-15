<?php

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, you can use the session variables
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Home Page</title>
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

        <p class ="title">Search Events</p>

        <form method="get" action="search_results.php">
            <label for="search_term">Search Term:</label>
            <input type="text" name="search_term" id="search_term" required>
            <button type="submit">Search</button>
        </form>

        <div class="section-container">
            <p class="title">Upcoming Event</p>

            <div class="event-container">

                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                require_once('Part/db_controller.php');
                require_once('Part/navbar.php');

                $sql = "SELECT events.*, clubs.club_name FROM events
                        JOIN clubs ON events.club_id = clubs.id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="event_single.php?id=' . $row["id"] . '">';
                            echo '<div class="event-card">';
                                echo '<img src="' . htmlspecialchars($row["event_image_path"]) . '" alt="Event Image">';
                                echo '<h2 class="title">' . $row["event_title"] . '</h2>';
                                echo '<p class="date">Date & Time: ' . $row["start_date"] . '</p>';
                                echo '<p class="location">Location: ' . $row["event_venue"] . '</p>';
                                echo '<p class="location">Club: ' . $row["club_name"] . '</p>';
                            
                            echo '</div>';
                        echo '</a>';  
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>

            </div>

        </div>
    </div>

</body>

</html>

