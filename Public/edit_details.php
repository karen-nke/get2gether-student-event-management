<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Part/db_controller.php');
require_once('Part/navbar.php');
require_once('logic_controller.php');


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $club_id = $_GET['id'];

    $clubDetails = fetchClubDetails($club_id, $conn);

    if ($clubDetails) {
    } else {
        echo "Club not found";
    }
} else {
    echo "No club selected";
}

handleClubDetailsUpdate($club_id, $conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Club Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="page-container">
        <!-- Display club details form -->
        <form action="" method="post">
            <h2>Edit Club Details</h2>

            <label for="newDescription">New Description</label>
            <textarea id="newDescription" name="newDescription" rows="4"><?php echo $clubDetails['description']; ?></textarea>

            <label for="newContactEmail">New Contact Email</label>
            <input type="text" id="newContactEmail" name="newContactEmail" value="<?php echo $clubDetails['contact_email']; ?>">

            <label for="newInstagramLink">New Instagram Link</label>
            <input type="text" id="newInstagramLink" name="newInstagramLink" value="<?php echo $clubDetails['instagram_link']; ?>">

            <label for="newFacebookLink">New Facebook Link</label>
            <input type="text" id="newFacebookLink" name="newFacebookLink" value="<?php echo $clubDetails['facebook_link']; ?>">

            <input type="submit" value="Update Details">
        </form>

        <a href="club_single.php?id=<?php echo $club_id; ?>"><button class="btn">Back</button></a>
    </div>

   

</body>

</html>