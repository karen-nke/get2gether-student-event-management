<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');
require_once('logic_controller.php');


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $club_id = $_GET['id'];

    $clubDetails = fetchClubDetails($club_id, $conn);

    if ($clubDetails) {
    } else {
        echo "Club not found";
    }
} else {
    echo "No club selected";
}

// Check if the user is logged in
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, retrieve session variables
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    // Retrieve user role for the current club
    $userRole = fetchUserRole($user_id, $club_id, $conn);
}


// Fetch club member count
$member_count = fetchMemberCount($club_id, $conn);

//Fetch Upcoming Event 
$upcomingEvents = fetchUpcomingEvents($club_id, $conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $clubDetails['club_name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="page-container">
        <div class="image-container">
            <img src="<?php echo htmlspecialchars($clubDetails['profile_image']); ?>" class="image-banner" alt="Club Banner">
        </div>

        <div class="single-container">
            <h2 class="title"><?php echo $clubDetails['club_name']; ?></h2>

            <h2 class="subscribe">Member Count <span class="count"><?php echo $member_count ?></span></h2>

            <?php if (isset($_SESSION["username"])) { ?>
                <form method="post" action="join_club.php" style="all: initial;">
                    <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
                    <button type="submit" class="btn" name="join_club">Join Club</button>
                </form>
                <?php } else { ?>
                <a href="Login/login.php"><button class="btn">Login to Join Club</button></a>
            <?php } ?>

            <?php if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
                if ($userRole === 'pic' || $userRole === 'committee'): ?>
                    <a href="edit_details.php?id=<?php echo $club_id; ?>">
                        <button class="btn">Edit Details</button>
                    </a>
                    <a href="edit_members.php?id=<?php echo $club_id; ?>">
                        <button class="btn">Edit Members</button>
                    </a>
            <?php endif;
            } ?>

            <p class="field-name">Club Description</p>
            <p class="desc"><?php echo $clubDetails['description']; ?></p>

            <p class="field-name">Contact</p>
            <p class="desc"><?php echo $clubDetails['contact_email']; ?></p>

            <p class="field-name">Social Media</p>
            <a href="<?php echo $clubDetails['instagram_link']; ?>"><p class="desc">Instagram</p></a>
            <a href="<?php echo $clubDetails['facebook_link']; ?>"><p class="desc">Facebook</p></a>
        </div>

        <div class="section-container">
            <h2 class="title">Clubs Events</h2>
            <div class="event-container">
                <?php
                if (!empty($upcomingEvents)) {
                    foreach ($upcomingEvents as $event) {
                ?>
                        <a href="event_single.php?id=<?php echo $event['id']; ?>">
                            <div class="event-card">
                                <img src="<?php echo htmlspecialchars($event['event_image_path']); ?>" alt="Event Image">
                                <h2 class="title"><?php echo $event['event_title']; ?></h2>
                                <p class="date">Date & Time: <?php echo $event['start_date']; ?></p>
                                <p class="location">Location: <?php echo $event['event_venue']; ?></p>
                                <p class="location">Club: <?php echo $event['club_name']; ?></p>
                            </div>
                        </a>
                <?php
                    }
                } else {
                    echo "No upcoming events for this club.";
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>
