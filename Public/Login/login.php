<?php
// Start the session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection and other necessary files
    require_once('../Part/db_controller.php');

    // Get user input from the form
    $email = $_POST['email'];
    $password = $_POST['password']; 

    // Validate user input (you can add more validation if needed)
    if (empty($email) || empty($password)) {
        echo "Please enter both email and Password";
    } else {
        // Check if the user exists in the database
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // User is valid, set session variables and redirect to index.php
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: ../index.php");
            exit();
        } else {
            // Invalid user, display an error message
            echo "Invalid email or Password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

<div class="signup-container">
    <div class="signup-image">
        <img src="../Image/Login_Image.png" alt="Login Image">
    </div>
    <div class="signup-form">
        <h2>Login</h2>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Imail</label>
                <input type="text" placeholder="Enter Imail Address" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div style="position: relative;">
                    <input type="password" placeholder="Enter Password" id="password" name="password"  value="<?php echo $_POST['password']; ?>" required>
                    <i class="fa fa-eye-slash password-toggle" onclick="togglePassword('password')"></i>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const passwordToggle = document.querySelector(`#${inputId} ~ .password-toggle`);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.add('fa-eye');
            passwordToggle.classList.remove('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.add('fa-eye-slash');
            passwordToggle.classList.remove('fa-eye');
        }
    }
</script>

</body>
</html>
