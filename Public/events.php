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
                // Include PHP code here to fetch events from the database
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                require_once('Part/db_controller.php');
                require_once('Part/navbar.php');

                $sql = "SELECT * FROM events";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="event-card">';
                        echo '<img src="' . htmlspecialchars($row["event_image_path"]) . '" alt="Event Image">';
                        echo '<h2>' . $row["event_title"] . '</h2>';
                        echo '<p>Date & Time: ' . $row["start_date"] . '</p>';
                        echo '<p>Location: ' . $row["event_venue"] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }

                // Close the database connection
                $conn->close();
                ?>


                </div>

        </div>
    </div>


    
       
               

                        
</body>

</html>

