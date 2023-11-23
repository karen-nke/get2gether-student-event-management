<?php


require_once('Part/db_controller.php');
require_once('Part/navbar.php');

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

<style>
    .page-container{
        max-width: 1300px;
        margin:auto;
        padding:25px
    }

    .image-container{
        display:flex;
        justify-content: center;
    }

    .image-banenr{
        
        margin-left:auto;
        margin-right:auto;
        width:50%
    }

    .event-container {
        display:flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .event-card {
            width: 300px;
            margin: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            float: left;
            background-color: white;
        }

    .event-card img{
   
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    
    }

    .section-container{
        display:flex;
        flex-direction:column;
    }

    .title{
        color: #1D86C5;
            font-size: 36px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            margin-bottom: 20px;
    }

    .event-card .btn{
       
        border-radius:10px;
        width: auto;
        margin:auto;
        margin-top:25px;
        background-color:#1D86C5;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 400;
        color: #fff;
        border: 2px solid #1D86C5;;
        
      

    }

    .btn{
        padding: 15px 25px 15px 25px;
        border-radius:10px;
        width: 500px;
        margin:auto;
        margin-top:25px;
        background-color:#1D86C5;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 400;
        color: #fff;
        border: 2px solid #1D86C5;;

    }

    .banner-container{
        background-color:#1D294F;
        width:100%;
        max-width:100%; 
        height: auto;
        display: flex;
        padding: 50px
    }

    .banner-container .image-container{
        width: 50%;
        text-align: center;

    }

    .banner-container .image-container .image{
        max-width: 100%;
        height: auto;
    }

    .banner-container .text-container{
        width: 50%;
        padding-top: 20px;


    }

    .banner-container .text-container .title{
        color: #F8F8FA;
        font-size: 36px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
    }

    .banner-container .text-container .desc{
        color: #F8F8FA;
        font-size: 18px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
    }

    .btn a {
            text-decoration: none; 
            color:#fff;
            
    }

    .event-card .title{
        color:#1D294F;
        font-family: 'Open Sans', sans-serif;
        font-size: 24px;
        font-weight: 400;
        padding-top:15px;
    }

    .event-card .date{
        color: #1D86C5;
        font-size: 16px;
        font-weight: 400;
        font-family: 'Open Sans', sans-serif;

    }

    .event-card .location{
        color: #7E7E7E;
        font-size: 16px;
        font-weight: 400;
        font-family: 'Open Sans', sans-serif;
    }



</style>

<body>
    <div class="page-container">
        <div class="image-container">
            <img src="Image/Logo_Banner.png" class ="image-banner" alt="Communication Badge">
        </div>

        <div class ="section-container">
            <p class ="title">Upcoming Event</p>

                <div class="event-container">

                <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    require_once('Part/db_controller.php');
                    require_once('Part/navbar.php');

                    // Retrieve 3 random events from the database
                    $sql = "SELECT * FROM events ORDER BY RAND() LIMIT 3";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<div class="event-container">';
                        // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="event-card">';
                        echo '<img src="' . $row["event_image_path"] . '" alt="Event Image">';
                        echo '<h2>' . $row["event_title"] . '</h2>';
                        echo '<p>Date & Time: ' . $row["start_date"] . '</p>';
                        echo '<p>Location: ' . $row["event_venue"] . '</p>';
                        echo '</div>';
                        }
                        echo '</div>';
                        } else {
                        echo "0 results";
                        }
                        // Close the database connection
                        
                        ?>


                </div>

                <button class ="btn"> <a href= "events.php">See More Event</a></button>

        </div>
    </div>

    <div class ="banner-container">
            <div class="image-container">
                <img src="Image/Make_Event.png" class ="image" alt="Event Image">
                
            </div>
            <div class ="text-container">
                <p class="title"> Make your own Event</p>
                <p class="desc">Description</p>
                <a href="../Public/create_events.php"><button class ="btn">Create Events</button></a>
            </div>

    </div>

        
    <div class="page-container">

        <div class ="section-container">
            <p class ="title">Trending Club</p>

                <div class="event-container">

                    <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    require_once('Part/db_controller.php');
                    require_once('Part/navbar.php');

                    $sql = "SELECT * FROM clubs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="event-card">';
                            echo '<img src="' . htmlspecialchars($row["profile_image"]) . '" alt="Club Image">';
                            echo '<h2>' . $row["club_name"] . '</h2>';
                            echo '<button class="btn"><a href="club_details.php?id=' . $row["id"] . '">View</a></button>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                    ?>
                </div>

                <button class ="btn"><a href="clubs.php">See More Club</a></button>

        </div>

    
      
    </div>

  

    
       
               

                        
</body>

</html>

