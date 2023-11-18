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

                    <div class="event-card">
                        <img src="Image/Event1.png" alt="Event Image">
                        <h2 class= "title">Event 1</h2>
                        <p class ="date">Date & Time: November 25, 2023</p>
                        <p class ="location">Location: Venue 1</p>
                    </div>

                    <div class="event-card">
                        <img src="Image/Event2.png" alt="Event Image">
                        <h2 class= "title">Event 1</h2>
                        <p class ="date">Date & Time: December 5, 2023</p>
                        <p class ="location">Location: Venue 2</p>
                    </div>

                    <div class="event-card">
                        <img src="Image/Event3.png" alt="Event Image">
                        <h2 class= "title">Event 1</h2>
                        <p class ="date">Date & Time: December 5, 2023</p>
                        <p class ="location">Location: Venue 2</p>
                    </div>

                    <div class="event-card">
                        <img src="Image/Event4.png" alt="Event Image">
                        <h2 class= "title">Event 1</h2>
                        <p class ="date">Date & Time: December 5, 2023</p>
                        <p class ="location">Location: Venue 2</p>
                    </div>

                    <div class="event-card">
                        <img src="Image/Event5.png" alt="Event Image">
                        <h2 class= "title">Event 1</h2>
                        <p class ="date">Date & Time: December 5, 2023</p>
                        <p class ="location">Location: Venue 2</p>
                    </div>

                    <div class="event-card">
                        <img src="Image/Event6.png" alt="Event Image">
                        <h2 class= "title">Event 1</h2>
                        <p class ="date">Date & Time: December 5, 2023</p>
                        <p class ="location">Location: Venue 2</p>
                    </div>


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
                <a href="../Public/createevents.php"><button class ="btn">Create Events</button></a>
            </div>

    </div>

        
    <div class="page-container">

        <div class ="section-container">
            <p class ="title">Trending Club</p>

                <div class="event-container">

                    <div class="event-card">
                        <img src="Image/Event1.png" alt="Event Image">
                        <h2 class ="title">Sunway Tech Club</h2>
                        <button class ="btn">View</button>
                        
                        
                    </div>

                    <div class="event-card">
                        <img src="Image/Event2.png" alt="Event Image">
                        <h2 class ="title">Sunway CISA Club</h2>
                        <button class ="btn">View</button>
                        
                    </div>

                    <div class="event-card">
                        <img src="Image/Event3.png" alt="Event Image">
                        <h2 class ="title">Sunway Business Investment Society</h2>
                        <button class ="btn">View</button>
                        
                    </div>

                </div>

                <button class ="btn"><a href="clubs.php">See More Club</a></button>

        </div>

    
      
    </div>

  

    
       
               

                        
</body>

</html>

