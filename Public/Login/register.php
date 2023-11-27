<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../Part/db_controller.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Debugging: Form submitted.";
    $username = $_POST['username'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmPassword'];

    if ($password == $confirmpassword) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "SELECT * FROM users WHERE email='" . $email . "'";
        $sql2 = "SELECT * FROM users WHERE username='" . $username . "'";
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        echo "Debugging: SQL queries executed.";

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email Already Exists.')</script>";
        } else if (mysqli_num_rows($result2) > 0) {
            echo "<script>alert('Username Already Exists.')</script>";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);

            echo "Debugging: User inserted.";

            if ($result) {
                echo "<script>alert('Successfully Registered'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Something went wrong.')</script>";
            }
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}


?>

<script>
    function validate(form) {
        var fail = "";

        fail += validateUsername(form.username.value);
        fail += validateEmail(form.email.value);
        fail += validatePassword(form.password.value);

        if (fail == "") return true; // if the fail string is empty, validation passes
        else {
            alert(fail);
            return false;
        }
    }

    function validateUsername(field) {
        if (field == "") return "No Username was entered.\n";
        else if (field.length < 5 || field.length > 10) return "Username must be between 5 and 10 characters.\n";
        else if (/[^a-zA-Z0-9_-]/.test(field)) return "Only letters, numbers, hyphens, and underscores are allowed in the username.\n";
        return "";
    }

    function validatePassword(field) {
        if (field == "") return "No Password Entered.\n";
        else if (field.length < 8) return "Password must be at least 8 characters.\n";
        else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) return "Password must contain at least one uppercase letter, one lowercase letter, and one number.\n";
        return "";
    }

    function validateEmail(field) {
        if (field == "") return "No Email Entered.\n";
        else if (!(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field))) return "The Email Address is invalid.\n";
        return "";
    }
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="signup-container">
    <div class="signup-image">
        <img src="../Image/Login_Image.png" alt="Signup Image">
    </div>
    <div class="signup-form">
        <h2>Sign Up</h2>

        <form action="" method="post" onSubmit="return validate(this)">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id= "username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Imail Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div style="position: relative;">
                    <input type="password" id="password" name="password" required>
                    <i class="fa fa-eye-slash password-toggle" onclick="togglePassword('password')"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <div style="position: relative;">
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <i class="fa fa-eye-slash password-toggle" onclick="togglePassword('confirmPassword')"></i>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up">
            </div>

            <p>Already have an account? <a href = "login.php"> Login Here </a></p>
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