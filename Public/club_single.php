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



.single-event-container .title{
    color: black;
    font-size: 64px;
    font-weight: 700;
    margin-top: 35px;
    margin-bottom: 25px;
}

.single-event-container .subscribe{
    color: black;
    font-size: 32px;
    font-weight: 700;
    margin-top:25px;
}

.single-event-container .count{
    padding-left:20px;
    color: #7E7E7E;
    font-size: 24px;
    font-weight: 700;
}



.single-event-container .field-name{
    color: black;
    font-size: 24px;
    font-weight: 700;
    margin-top: 50px;
}

.single-event-container .desc{

    color: #7E7E7E;
    font-size: 16px;
    font-weight: 400;

}



</style>

<body>

<div class="page-container">
        <div class="image-container">
                <img src="Image/Event1.png" class ="image-banner" alt="Communication Badge">
        </div>

        
            <div class= "single-event-container">
                <h2 class="title">Coding Club</h2>
                <h2 class ="subscribe"> Subscriber Count <span class ="count">1112</span> </h2>
                <p class ="field-name">Club Description</p>
                <p class ="desc"> Explore the world of coding and programming! </p>

                <p class ="field-name">Contact</p>
                <p class ="desc">coding@example.com</p>

                <p class ="field-name">Social Media</p>
                <a href="#"><p class ="desc"> Instagram</p></a>
                <a href="#"><p class ="desc"> Faceboook</p></a>

            </div>
</div>

        
  
    
       
               

                        
</body>

</html>

