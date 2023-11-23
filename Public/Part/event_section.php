
    <div class ="section-container">
        <p class ="title">Upcoming Event</p>

            <div class="event-container">

                <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);

                        // Retrieve 3 random events from the database
                        $sql = "SELECT events.*, clubs.club_name FROM events
                            JOIN clubs ON events.club_id = clubs.id ORDER BY RAND() LIMIT 3";
                    
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
                            echo '</a>';  
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


<style>
    .section-container{
        display:flex;
        flex-direction:column;
        margin:25px;
    }

    .section-container .title{
            color: #1D86C5;
            font-size: 36px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            margin-bottom: 20px;
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

   .btn {
    padding: 15px 25px 15px 25px;
    border-radius: 10px;
    width: 500px;
    margin: auto;
    margin-top: 25px;
    background-color: #1D86C5;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
    font-weight: 400;
    color: #fff;
    border: 2px solid #1D86C5;
}



</style>