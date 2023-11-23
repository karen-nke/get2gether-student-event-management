<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $club_id = $_GET['id'];

    // Fetch club details based on the id
    $sql = "SELECT * FROM clubs WHERE id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display club details on this page

    } else {
        echo "Club not found";
    }
} else {
    echo "No club selected";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title><?php echo $row['club_name']; ?></title>
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
                    <img src="<?php echo htmlspecialchars($row['profile_image']); ?>" class="image-banner" alt="Club Banner">
            </div>

                <div class="single-container">
                    <h2 class="title"><?php echo $row['club_name']; ?></h2>
                    <h2 class="subscribe">Subscriber Count <span class="count"><?php echo $row['subscriber_count']; ?></span></h2>
                    <button class="btn"><a href="#">Subscribe</a></button>
                    <button class="btn"><a href="edit_details.php?id=<?php echo $club_id; ?>">Edit Details</a></button>

                    <p class="field-name">Club Description</p>
                    <p class="desc"><?php echo $row['description']; ?></p>

                    <p class="field-name">Contact</p>
                    <p class="desc"><?php echo $row['contact_email']; ?></p>

                    <p class="field-name">Social Media</p>
                    <a href="<?php echo $row['instagram_link']; ?>"><p class="desc">Instagram</p></a>
                    <a href="<?php echo $row['facebook_link']; ?>"><p class="desc">Facebook</p></a>
                </div>
    </div>

</body>

</html>

