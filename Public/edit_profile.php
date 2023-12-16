<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, you can use the session variables
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
}

// Fetch user details from the database based on user_id
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $userDetails = $result->fetch_assoc();
} else {
    // Handle error or redirect to an error page
    echo "Error fetching user details";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle profile image upload
    $uploadDir = 'uploads/'; // Target directory for profile images
    $profileImage = $_FILES['profileImage'];
    $user_id = $_SESSION['user_id']; // Assuming you have the user ID in the session

    if ($profileImage['error'] === UPLOAD_ERR_OK) {
        // Generate a unique file name based on user ID
        $newFileName = 'profile_' . $user_id . '.png'; // You can choose your own naming convention

        $uploadFile = $uploadDir . $newFileName;

        if (move_uploaded_file($profileImage['tmp_name'], $uploadFile)) {
            // Profile image uploaded successfully
            // Now, you can update the user's profile_image field in the database
            $updateSql = "UPDATE users SET profile_image = '$uploadFile' WHERE id = $user_id";

            if ($conn->query($updateSql) === TRUE) {
                echo "Profile image uploaded and user details updated successfully.";
            } else {
                echo "Error updating user details: " . $conn->error;
            }
        } else {
            echo "Error uploading the profile image.";
        }
    } else {
        echo "Error uploading the profile image.";
    }

    // Handle the rest of the user details update (first name, last name, etc.)
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $bio = $_POST['bio'];

    // Update user details in the database
    $updateSql = "UPDATE users SET 
                  first_name = '$firstName', 
                  last_name = '$lastName', 
                  gender = '$gender', 
                  contact_number = '$contactNumber', 
                  address = '$address', 
                  city = '$city', 
                  state = '$state',
                  bio = '$bio'
                  WHERE id = $user_id";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: profile.php");
        exit(); // Ensure that no further code is executed
    } else {
        echo "Error updating user details: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>

    .page-container{
        max-width: 1000px;
        margin: auto; 
        padding: 25px; 

    }

    .profile-header {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    }

    .profile-frame {
        margin-left: auto;
        border-radius: 50%; 
        overflow: hidden; 
        display: inline-block; 
        margin-bottom: 80px;
        position: relative;
        width: 100px; 
        height: 100px; 
    }


    .image-banner {
        width: 100%; 
        height: 100%; 
        display: block; 
        object-fit: cover; 
    }
    h2 {
        margin: 0;
        margin-top:-50px;

    }

    .btn {
    display: block; /* Full width of its parent */
    width: 100%; /* Make the button take full width of its container */
    max-width: 500px; /* Set a max-width to ensure it doesn't get too large on wider screens */
    margin: 20px auto; /* Center the button and add some space around it */
    padding: 15px 25px; /* Padding for better touch area and aesthetics */
    background-color: #1D86C5;
    color: white;
    border: none;
    border-radius: 5px; /* Slightly rounded corners */
    font-size: 16px; /* Adjust font size as needed */
    cursor: pointer;
    transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    .btn:hover {
        background-color: #1574A1; /* Slightly darker shade for hover effect */
    }

    @media only screen and (max-width: 1200px) {
        .page-container{
            margin-left:80px;
        }



    }   

    </style>



<body>

    <div class="page-container">
        <form action="edit_profile.php" method="POST" enctype="multipart/form-data"> 
        <div class="profile-header">
            <h2>Edit Profile</h2>
            <div class="profile-frame">
                <img src="<?php echo $userDetails['profile_image']; ?>" onerror="this.src='Image/Logo_Placeholder.png'" alt="profile-logo" class="image-banner">
            </div>
        </div>


            <label for="profileImage">Upload Profile Image</label>
    <input type="file" id="profileImage" name="profileImage">

            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $userDetails['first_name']; ?>">

            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $userDetails['last_name']; ?>">

            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="male" <?php echo ($userDetails['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo ($userDetails['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="not_specified" <?php echo ($userDetails['gender'] == 'not_specified') ? 'selected' : ''; ?>>Rather Not Say</option>
            </select>

            <label for="contactNumber">Contact Number</label>
            <input type="text" id="contactNumber" name="contactNumber" value="<?php echo $userDetails['contact_number']; ?>">

            <label for="address">Address</label>
            <textarea id="address" name="address"><?php echo $userDetails['address']; ?></textarea>

            <label for="city">City</label>
            <input type="text" id="city" name="city" value="<?php echo $userDetails['city']; ?>">

            <label for="state">State</label>
            <input type="text" id="state" name="state" value="<?php echo $userDetails['state']; ?>">

            <label for="bio">Bio</label>
            <textarea id="bio" name="bio"><?php echo $userDetails['bio']; ?></textarea>


            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>

</body>

</html>


