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

    // Fetch user details from the database based on user_id
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    } else {
        // Handle error or redirect to an error page
        echo "Error fetching user details";
        exit();
    }
}

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

<style>



.single-container .title{
    color: black;
    font-size: 64px;
    font-weight: 700;
    margin-top: 35px;
    margin-bottom: 25px;
}

.single-container .subscribe{
    color: black;
    font-size: 32px;
    font-weight: 700;
    margin-top:25px;
}

.single-container .count{
    padding-left:20px;
    color: #7E7E7E;
    font-size: 24px;
    font-weight: 700;
}



.single-container .field-name{
    color: black;
    font-size: 24px;
    font-weight: 700;
    margin-top: 50px;
}

.single-container .desc{

    color: #7E7E7E;
    font-size: 16px;
    font-weight: 400;

}

a:link {
  color: #1D294F;
}

a:hover {
  color: #FF7008;
}







</style>

<body>

    <div class="page-container">
            <div class="image-container">
                    <!-- Assuming you have a club image path in your database, update the source accordingly -->
                    <img src="Image/Logo_Placeholder.png" class="image-banner" alt="Club Banner">
            </div>

                <div class="single-container">
                    <h2 class="title"><?php echo $username; ?></h2>
                    <p class="field-name"> Bio </p>
                    <p class="desc"> <?php echo $userDetails['bio'];?> </p>

                    <a href="edit_profile.php"><button class="btn">Edit Profile</button></a>

                    <!-- Display user's joined clubs -->
                    <div class="joined-clubs">
                        <h2 class="field-name">Joined Clubs</h2>
                        <?php
                            $joinedClubsSql = "SELECT clubs.id, clubs.club_name
                                            FROM memberships
                                            JOIN clubs ON memberships.club_id = clubs.id
                                            WHERE memberships.user_id = $user_id";

                            $joinedClubsResult = $conn->query($joinedClubsSql);

                            if ($joinedClubsResult && $joinedClubsResult->num_rows > 0) {
                                echo '<ul>';
                                while ($clubRow = $joinedClubsResult->fetch_assoc()) {
                                    $clubId = $clubRow['id'];
                                    $clubName = htmlspecialchars($clubRow['club_name']);
                                    echo '<li><a href="club_single.php?id=' . $clubId . '">' . $clubName . '</a></li>';
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
                            $registeredEventsSql = "SELECT events.*, clubs.club_name
                                                FROM event_registrations
                                                JOIN events ON event_registrations.event_id = events.id
                                                JOIN clubs ON events.club_id = clubs.id
                                                WHERE event_registrations.user_id = $user_id";

                            $registeredEventsResult = $conn->query($registeredEventsSql);

                            if ($registeredEventsResult && $registeredEventsResult->num_rows > 0) {
                                while ($eventRow = $registeredEventsResult->fetch_assoc()) {
                                    echo '<a href="event_single.php?id=' . $eventRow["id"] . '">';
                                        echo '<div class="event-card">';
                                        echo '<img src="' . htmlspecialchars($eventRow["event_image_path"]) . '" alt="Event Image">';
                                        echo '<h2 class="title">' . $eventRow["event_title"] . '</h2>';
                                        echo '<p class="date">Date & Time: ' . $eventRow["start_date"] . '</p>';
                                        echo '<p class="location">Location: ' . $eventRow["event_venue"] . '</p>';
                                        echo '<p class="location">Club: ' . $eventRow["club_name"] . '</p>';
                                        echo '</div>';
                                    echo '</a>';  
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

