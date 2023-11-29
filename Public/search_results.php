<?php

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search_term'])) {
    $searchTerm = $_GET['search_term'];

    // Query the database for clubs matching the search term
    $sql = "SELECT * FROM clubs WHERE club_name LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display search results
        echo '<div class="page-container">';
        echo '<h2>Search Results</h2>';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="club-result">';
            echo '<h3>' . $row['club_name'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<a href="club_single.php?id=' . $row['id'] . '">View Club</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="page-container">';
        echo '<h2>No results found for "' . $searchTerm . '"</h2>';
        echo '</div>';
    }
} else {
    // Redirect to the search form if no search term is provided
    header("Location: search_clubs.php");
    exit();
}

?>