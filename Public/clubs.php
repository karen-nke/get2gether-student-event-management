<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');
require_once('logic_controller.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, you can use the session variables
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

}

$clubs = getAllClubs($conn);

?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Clubs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body>     
    <div class="page-container">
        <div class="image-container">
            <img src="Image/Logo_Banner.png" class="image-banner" alt="Logo">
        </div>

        <form method="get" action="search_results.php">
            <label for="search_term">Search Club:</label>
            <input type="text" name="search_term" id="search_term" required>
            <button type="submit" class="btn">Search</button>
        </form>

        <div class ="section-container">
            <p class ="title">All Clubs & Societies</p>

            <div class="event-container">
                <?php
                if (!empty($clubs)) {
                    foreach ($clubs as $club) {
                ?>
                        <div class="event-card">
                            <img src="<?php echo $club['profile_image']; ?>" alt="Club Image">
                            <h2><?php echo $club['club_name']; ?></h2>
                            <a href="club_single.php?id=<?php echo $club['id']; ?>"><button class="btn">View</button></a>
                        </div>
                <?php
                    }
                } else {
                    echo "No clubs found.";
                }
                ?>
            </div>


        </div>

    
      
    </div>

  

    
       
               

                        
</body>

</html>

