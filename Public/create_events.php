<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

    form {
            background-color: white;
            padding: 20px;
            margin-top:50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #1D86C5;
            color: white;
            cursor: pointer;
        }

</style>

<body>
    <div class="page-container">

    <div class="image-container">
            <img src="Image/Logo_Vertical.png" class ="image-banner" alt="Communication Badge">
    </div>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h2>Create Event</h2>

        <label for="eventTitle">Event Title</label>
        <input type="text" id="eventTitle" name="eventTitle" required>

        <label for="eventVenue">Event Venue</label>
        <input type="text" id="eventVenue" name="eventVenue" required>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="startTime">Start Time</label>
                <input type="time" id="startTime" name="startTime" required>
            </div>
            <div style="flex: 1;">
                <label for="endTime">End Time</label>
                <input type="time" id="endTime" name="endTime" required>
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <div style="flex: 1;">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" name="startDate" required>
            </div>
            <div style="flex: 1;">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" name="endDate" required>
            </div>
        </div>

        <h2>Event Description</h2>

        <label for="eventImage">Upload Event Image</label>
        <input type="file" id="eventImage" name="eventImage">

        <label for="eventDescription">Event Description</label>
        <textarea id="eventDescription" name="eventDescription" rows="4" required></textarea>

        <input type="submit" value="Submit">
    </form>

        
      
    </div>

  

    
       
               

                        
</body>

</html>
