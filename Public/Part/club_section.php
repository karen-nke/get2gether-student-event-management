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