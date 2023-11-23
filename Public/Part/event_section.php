<div class ="section-container">
            <p class ="title">Upcoming Event</p>

                <div class="event-container">

                <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    require_once('Part/db_controller.php');
                    require_once('Part/navbar.php');

                    // Retrieve 3 random events from the database
                    $sql = "SELECT * FROM events ORDER BY RAND() LIMIT 6";
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