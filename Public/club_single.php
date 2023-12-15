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

}

//Club Details 
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $club_id = $_GET['id'];

    // Fetch club details based on the id
    $sql = "SELECT * FROM clubs WHERE id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display club details on this page

    } else {
        echo "Club not found";
    }
} else {
    echo "No club selected";
}



//Club Member
$sql = "SELECT clubs.*, COUNT(memberships.user_id) AS member_count
        FROM clubs
        LEFT JOIN memberships ON clubs.id = memberships.club_id
        WHERE clubs.id = $club_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Get the count of members for this club
    $member_count = $row['member_count'];
} else {
    echo "Club not found";
}

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    
    function fetchUserRole($user_id, $club_id) {
        global $conn;
    
        $sql = "SELECT role FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['role'];
        } else {
            return ""; 
        }
    }
    
    $userRole = fetchUserRole($user_id, $club_id);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title><?php echo $row['club_name']; ?></title>
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



</style>

<body>

    <div class="page-container">
            <div class="image-container">
                    <img src="<?php echo htmlspecialchars($row['profile_image']); ?>" class="image-banner" alt="Club Banner">
            </div>

                <div class="single-container">

                    <h2 class="title"><?php echo $row['club_name']; ?></h2>
            

                    <h2 class="subscribe">Member Count <span class="count"><?php echo $member_count ?></span></h2>
                    <a href="#"><button class="btn">Subscribe</button></a>

                   <?php if (isset($_SESSION["username"])) { ?>

                    <form method="post" action="join_club.php">
                        <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
                        <button type="submit" class="btn" name="join_club">Join Club</button>
                    </form>

                    <?php } else{ ?>
                    <a href="Login/login.php"><button class="btn">Login to Join Club</button></a>

                    <?php } ?>
                    

                    <?php 


                    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
                    if ($userRole === 'pic'): ?>
                        <a href="edit_details.php?id=<?php echo $club_id; ?>">
                            <button class="btn">Edit Details</button>
                        </a>

                        <a href="edit_members.php?id=<?php echo $club_id; ?>">
                            <button class="btn">Edit Members</button>
                        </a>
                      

                    <?php endif; }?>


                    <p class="field-name">Club Description</p>
                    <p class="desc"><?php echo $row['description']; ?></p>

                    <p class="field-name">Contact</p>
                    <p class="desc"><?php echo $row['contact_email']; ?></p>

                    <p class="field-name">Social Media</p>
                    <a href="<?php echo $row['instagram_link']; ?>"><p class="desc">Instagram</p></a>
                    <a href="<?php echo $row['facebook_link']; ?>"><p class="desc">Facebook</p></a>
                </div>

                <div class="section-container">
                    <p class="title">Clubs Events</p>

                    <div class="event-container">

                        <?php
                    
   
                            $club_id = $row['id']; 
                            $sql = "SELECT events.*, clubs.club_name FROM events
                                    JOIN clubs ON events.club_id = clubs.id
                                    WHERE events.club_id = $club_id AND events.start_date >= CURDATE()
                                    ORDER BY events.start_date LIMIT 3";
   
                            $result = $conn->query($sql);
   
                            if ($result->num_rows > 0) {
                                echo '<div class="event-container">';
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo '<a href="event_single.php?id=' . $row["id"] . '">';
                                    echo '<div class="event-card">';
                                    echo '<img src="' . htmlspecialchars($row["event_image_path"]) . '" alt="Event Image">';
                                    echo '<h2 class="title">' . $row["event_title"] . '</h2>';
                                    echo '<p class="date">Date & Time: ' . $row["start_date"] . '</p>';
                                    echo '<p class="location">Location: ' . $row["event_venue"] . '</p>';
                                    echo '<p class="location">Club: ' . $row["club_name"] . '</p>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            } else {
                                echo "No upcoming events for this club.";
                            }
                        ?>


                    </div>

                </div>

    </div>

</body>

</html>

