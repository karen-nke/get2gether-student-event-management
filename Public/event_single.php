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

    .image-banner{
        
        margin-left:auto;
        margin-right:auto;
        width:50%
    }




.event-container .title{
    color: black;
    font-size: 64px;
    font-weight: 700;
    margin-top: 35px;
    margin-bottom: 25px;
}

.event-container .field-name{
    color: black;
    font-size: 24px;
    font-weight: 700;
    margin-top: 50px;
}

.event-container .desc{

    color: #7E7E7E;
    font-size: 16px;
    font-weight: 400;

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

    .btn a {
            text-decoration: none; 
            color:#fff;
            
    }




</style>

<body>
    <div class="page-container">
        <div class="image-container">
                <img src="Image/Event1.png" class ="image-banner" alt="Communication Badge">
        </div>

        
            <div class= "event-container">
                <h2 class="title">Yoga class to freshen up the day</h2>
                <p class ="field-name">Description</p>
                <p class ="desc"> ASBDIAHGDFKDHJFKJSHDFKJHSDKJFHKSD </p>

                <p class ="field-name">Event Date & Time</p>
                <p class ="desc"> Event Date: 13 December 2023 </p>
                <p class ="desc"> Event Time: 6PM - 8PM </p>

                <p class ="field-name">Event Venue</p>
                <p class ="desc"> Location</p>

                <p class ="field-name">Organizer</p>
                <p class ="desc"> Club Name: </p>
                <p class ="desc"> Contact Email Address: </p>

                <button class ="btn"><a href="#">View Club Details</a></button>
                <button class ="btn"><a href="#">Register</a></button>
                





            </div>

           
    
      
    </div>


        
  
    
       
               

                        
</body>

</html>

