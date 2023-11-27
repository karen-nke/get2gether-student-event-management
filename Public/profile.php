<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, you can use the session variables
    $username = $_SESSION['username'];
    $userId = $_SESSION['user_id'];

    // Fetch user details from the database based on user_id
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    } else {
        // Handle error or redirect to an error page
        echo "Error fetching user details";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>



.single-container .title{
    color: black;
    font-size: 64px;
    font-weight: 700;
    margin-top: 35px;
    margin-bottom: 25px;
}

.single-container .subscribe{
    color: black;
    font-size: 32px;
    font-weight: 700;
    margin-top:25px;
}

.single-container .count{
    padding-left:20px;
    color: #7E7E7E;
    font-size: 24px;
    font-weight: 700;
}



.single-container .field-name{
    color: black;
    font-size: 24px;
    font-weight: 700;
    margin-top: 50px;
}

.single-container .desc{

    color: #7E7E7E;
    font-size: 16px;
    font-weight: 400;

}



</style>

<body>

    <div class="page-container">
            <div class="image-container">
                    <!-- Assuming you have a club image path in your database, update the source accordingly -->
                    <img src="Image/Logo_Placeholder.png" class="image-banner" alt="Club Banner">
            </div>

                <div class="single-container">
                    <h2 class="title"><?php echo $username; ?></h2>
                    <p class="field-name"> Bio </p>
                    <p class="desc"> <?php echo $userDetails['bio'];?> </p>

                    <a href="edit_profile.php"><button class="btn">Edit Profile</button></a>

                </div>

               
    </div>

</body>

</html>

