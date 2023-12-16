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
$organizedEvents = getOrganizedEvents($user_id, $conn);

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
    body, html {
        width: 100%;
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .left-container {
        margin-left:80px;
        margin-top:100px;
        flex:2;
        padding: 20px;
        position: relative; /* Added position relative for absolute positioning */
    }

    .left-container img {
        width: 100%;
        height: 100%;
        display: block; /* Fix for inline alignment issue */
    }

    .edit-button {
        cursor: pointer;
        position: absolute; /* Position absolute for centering */
        left: 50%;
        transform: translateX(-50%); /* Centering using translateX */
        bottom: 20px; /* Adjust as needed */
        padding: 10px;
        padding-left: 40px;
        padding-right:40px;
        justify-content: center;
        align-items: center;
        gap: 5px;
        border-radius: 8px;
        background: #1D294F;
        color: #DDAB58;
        text-align: center;
        font-family: Open Sans;
        font-size: 24px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        margin-left:-85px;
     
    }

    .right-container {
        flex: 2;
        padding: 20px;
    }

   
.profile-frame {
    border-radius: 50%; /* Create a round shape */
    overflow: hidden; /* Clip content outside the frame */
    display: inline-block; /* Allow the frame to adjust to its content */
    margin-bottom: 80px;
}

/* Style for the profile image inside the frame */
.image-banner {
    width: 100%; /* Ensure the image takes up the full width of the frame */
    height: auto; /* Allow the image to maintain its aspect ratio */
    display: block; /* Remove any inline spacing */
}


    .user-info {
        color: var(--White, #3C0E0E);
        font-family: Open Sans;
        font-size: 44px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-top: 120px;
    }

    .club-position{
        color: #000;
        font-family: Open Sans;
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
     
    }
    .description {
        margin-top: 45px;
        color: #000;
        font-family: Open Sans;
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        
    }

    .user-description{
        color: var(--Gray-600, #7E7E7E);
        font-family: Open Sans;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        margin-bottom: 25px;
    }

    .subscribed-clubs,
    .upcoming-activity {
        margin-bottom: 10px;
        color: #000;
        font-family: Open Sans;
        font-size: 22px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .arrow{
        padding-top: 8px;
        height:20px;
        width:21px;
    }

    .create-event-section{
        margin-top: -20px;
        margin-bottom: 120px;
    }

          /* Styles for the pop-up */
          #popupSubscribe {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Styles for the overlay background */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

    @media only screen and (max-width: 1000px) {
  
        .subscribed-clubs,
        .upcoming-activity {
            display: flex;
            align-items: center; /* Align text and arrow vertically */
        }

        .arrow {
            margin-left: 10px; /* Adjust the space between text and arrow */
        }

        .edit-button{
            font-size: 18px;
            margin: 0px;

        }

    
    }
</style>



<body>

<div class="container">
            <div class="left-container">
            <div class="profile-frame">
    <img src="<?php echo $userDetails['profile_image']; ?>" onerror="this.src='Image/Logo_Placeholder.png'" alt="profile-logo" class="image-banner">
</div>

                <a href="edit_profile.php"><button class="edit-button">Edit Profile</button></a>
            </div>

            <div class="right-container">
                <div class="user-info"><?php echo $username; ?></div>
                <div class="club-position">Club Position</div>
                <div class="description">Description</div>
                <div class="user-description"><?php echo $userDetails['bio'];?> </div>
                <div class="subscribed-clubs" >
                    Subscribed Clubs &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" id="subscribedPopUp"> <!-- This is the clickable element -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="arrow" viewBox="0 0 23 24" fill="none">
                            <path d="M3 20.7762L18.6168 13.4593C20.4611 12.5951 20.4611 11.1811 18.6168 10.317L3 3" stroke="#292D32" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <div class="upcoming-activity">Upcoming Activity &nbsp;&nbsp;<svg xmlns="http://www.w3.org/2000/svg"  class="arrow" viewBox="0 0 23 24" fill="none">
                    <path d="M3 20.7762L18.6168 13.4593C20.4611 12.5951 20.4611 11.1811 18.6168 10.317L3 3" stroke="#292D32" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>

        </div>

        <div class="registered-event-section">
            <?php require_once('Part/registered_event_section.php'); ?>
        </div>

        
  

        <div class="create-event-section">
            <div class ="banner-container">
                <div class="image-container">
                    <img src="Image/Make_Event.png" class ="image" alt="Event Image">
                    
                </div>
                <div class ="text-container">
                    <p class="title"> Make your own Event</p>
                    <p class="desc">Description</p>
                    <a href="create_events.php"><button class ="btn">Create Events</button></a>
                </div>
            </div>
        </div>

        <div class="organized-event-section">
            <?php require_once('Part/organized_event_section.php'); ?>
        </div>


        <!-- Subsribed Pop UP -->
        <div id="popupSubscribe">
            <?php
                            $joinedClubsSql = "SELECT clubs.id, clubs.club_name
                                            FROM memberships
                                            JOIN clubs ON memberships.club_id = clubs.id
                                            WHERE memberships.user_id = $userId";

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

        <div id="overlay"></div>


        <script>
            // Function to show the pop-up
            function showPopup() {
                document.getElementById('popupSubscribe').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';
            }

            // Function to hide the pop-up
            function hidePopup() {
                document.getElementById('popupSubscribe').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            }

            // Attach a click event listener to the trigger element
            document.getElementById('subscribedPopUp').addEventListener('click', showPopup);

            // Attach a click event listener to the overlay to close the pop-up
            document.getElementById('overlay').addEventListener('click', hidePopup);
        </script>




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
