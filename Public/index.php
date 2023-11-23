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




</style>

<body>
    <div class="page-container">
        <div class="image-container">
            <img src="Image/Logo_Banner.png" class ="image-banner" alt="Communication Badge">
        </div>

        <?php require_once('Part/event_section.php'); ?>

        
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
        <?php require_once('Part/club_section.php'); ?>
    </div>

  

    
       
               

                        
</body>

</html>

