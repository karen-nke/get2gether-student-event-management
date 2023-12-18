<head>
        <meta charset="UTF-8">
        <title>Search</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<?php

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_term'])) {
    $searchTerm = $_GET['search_term'];

    // Query the database for clubs or events matching the search term based on the referring page
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'clubs.php') !== false) {
        // User came from clubs.php, search for clubs
        $sql = "SELECT * FROM clubs WHERE club_name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display club search results
            echo '<div class="page-container">';
            echo '<div class="section-container">';
                echo '<div class="image-container">';
                echo '<img src="Image/Logo_Banner.png" class="image-banner" alt="Logo">';
                echo '</div>';

            echo '<p class="title">Search Results</p>';
            while ($row = $result->fetch_assoc()) {
                //echo '<div class="event-container">';
                echo '<div class="event-card">';
                echo '<img src="' . htmlspecialchars($row["profile_image"]) . '" alt="Event Image">';
                echo '<h2>' . $row['club_name'] . '</h2>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<a href="club_single.php?id=' . $row['id'] . '"><button class="btn">View</button></a>';
                //echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="page-container">';
            echo '<h2>No club results found for "' . $searchTerm . '"</h2>';
            echo '</div>';
        }
    } elseif (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'events.php') !== false) {
        // User came from events.php, search for events
        $sql = "SELECT events.*, clubs.club_name FROM events
                JOIN clubs ON events.club_id = clubs.id
                WHERE events.event_title LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display event search results
            echo '<div class="page-container">';
            echo '<div class="section-container">';
                echo '<div class="image-container">';
                echo '<img src="Image/Logo_Banner.png" class="image-banner" alt="Logo">';
                echo '</div>';

            echo '<p class="title">Search Results</p>';
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
            echo '</div>';
        } else {
            echo '<div class="page-container">';
            echo '<h2>No event results found for "' . $searchTerm . '"</h2>';
            echo '</div>';
        }
    } else {
        // Redirect to the search form if no referring page is detected
        header("Location: search_clubs.php");
        exit();
    }
} else {
    // Redirect to the search form if no search term is provided
    header("Location: search_clubs.php");
    exit();
}

?>