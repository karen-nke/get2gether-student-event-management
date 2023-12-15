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
    // Get user input from the form
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

    $updateResult = $conn->query($updateSql);

    if ($updateResult) {
        // Redirect to the profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        // Handle error or redirect to an error page
        echo "Error updating user details";
        exit();
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

<body>

    <div class="page-container">
        <form action="edit_profile.php" method="post">
            <h2>Edit Profile</h2>

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