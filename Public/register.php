<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Debugging: PHP code reached.";

include 'Part/db_controller.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = trim($_POST['email']);
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmPassword']);

    echo "Debugging: Form submitted.";

    if ($password == $confirmpassword) {
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
                echo "<script>alert('Successfully Registered'); window.location.href = 'index.php';</script>";
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
    function validate(form){
        fail = validateUsername(form.username.value)
        fail += validateEmail(form.email.value)
        fail += validatePassword(form.password.value)


        if(fail=="") return true //if empty string, return true = pass validation
        else {alert(fail); return false}

       
    }

    function validateUsername(field){
        if(field == "") return "No Username was entered.\n"
        else if (field.length <5 || field.length >10) return "Username must be at least 5 characters and maximum 10 character.\n"
        else if (/[^a-zA-Z0-9_-]/.test(field)) return "Only Alphabet & Numbers are allowed in the username.\n"
        return ""

    }

    function validatePassword(field){
        if(field=="") return "No Password Entered.\\n"
        else if (field.length < 8) return "Password must be at least 8 characters.\n"
        else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field)) return "Password must require at least one uppercase, one lowercase and one number\n." 
        return ""
    }

    function validateEmail(field){
        if (field=="") return "No Email Entered.\n"
        else if (!((field.indexOf(".")>0) && (field.indexOf("@")>0)) || /[^a-zA-Z0-9.@_-]/.test(field)) return "The Email Address is invalid.\n"
        return""
    }

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .signup-container {
            display: flex;
            max-width: 1440px;
            height: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 8px;
            background: white;
        }

        .signup-image {
            flex: 1;
            overflow: hidden;
        }

        .signup-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .signup-form {
            flex: 1;
            padding: 20px;
        }

        .signup-form h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
        }

        .form-group input {
            width: calc(100% - 20px);
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block;
            vertical-align: top;
            padding-right: 30px; 
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .form-group input[type="submit"] {
            background-color: #1D86C5;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <div class="signup-image">
        <img src="Image/Login_Image.png" alt="Signup Image">
    </div>
    <div class="signup-form">
        <h2>Sign Up</h2>

        <form action="register.php" method="post" onSubmit="return validate(this)">
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