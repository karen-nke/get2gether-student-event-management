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

// Handle form submission to update club details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newDescription = $_POST['newDescription'];
    $newContactEmail = $_POST['newContactEmail'];
    $newInstagramLink = $_POST['newInstagramLink'];
    $newFacebookLink = $_POST['newFacebookLink'];

    // Update the database with the new details
    $updateSql = "UPDATE clubs SET
                    description = '$newDescription',
                    contact_email = '$newContactEmail',
                    instagram_link = '$newInstagramLink',
                    facebook_link = '$newFacebookLink'
                  WHERE id = $club_id";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Club details updated successfully');
        window.location.href = 'club_single.php?id=" . urlencode($club_id) . "';
        
        </script>";
        // You can redirect the user to the club_single.php page or perform any other actions here
    } else {
        echo "<script>alert('Error updating club details');</script>";
    
    }
}
?>

<style>

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

       select{
            margin-bottom: 16px;
        }

</style>

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

<style>
    /* Add your styles for the edit page here */
</style>

<body>

    <div class="page-container">
        <!-- Display club details form -->
        <form action="" method="post">
            <h2>Edit Club Details</h2>

            <label for="newDescription">New Description</label>
            <textarea id="newDescription" name="newDescription" rows="4"><?php echo $row['description']; ?></textarea>

            <label for="newContactEmail">New Contact Email</label>
            <input type="text" id="newContactEmail" name="newContactEmail" value="<?php echo $row['contact_email']; ?>">

            <label for="newInstagramLink">New Instagram Link</label>
            <input type="text" id="newInstagramLink" name="newInstagramLink" value="<?php echo $row['instagram_link']; ?>">

            <label for="newFacebookLink">New Facebook Link</label>
            <input type="text" id="newFacebookLink" name="newFacebookLink" value="<?php echo $row['facebook_link']; ?>">

            <input type="submit" value="Update Details">
        </form>
    </div>

</body>

</html>