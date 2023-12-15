<?php 
session_start();
require "db_controller.php";
require '../Includes/PHPMailer.php';
require '../Includes/SMTP.php';
require '../Includes/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = "";
$username = "";
$errors = array();

$mail = new PHPMailer();

// Set mailer configurations
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username = "get2gethersunway@gmail.com";
$mail->Password = "rnovlmfyksctydjz";
$mail->Subject = "Imail Verification Code";
$mail->setFrom('get2gethersunway@gmail.com');
$mail->isHTML(true);

$maill = new PHPMailer();

// Set mailer configurations
$maill->isSMTP();
$maill->Host = "smtp.gmail.com";
$maill->SMTPAuth = true;
$maill->SMTPSecure = "tls";
$maill->Port = "587";
$maill->Username = "get2gethersunway@gmail.com";
$maill->Password = "rnovlmfyksctydjz";
$maill->Subject = "Imail Verification Code";
$maill->setFrom('get2gethersunway@gmail.com');
$maill->isHTML(true);


$resetmail = new PHPMailer();

// Set mailer configurations
$resetmail->isSMTP();
$resetmail->Host = "smtp.gmail.com";
$resetmail->SMTPAuth = true;
$resetmail->SMTPSecure = "tls";
$resetmail->Port = "587";
$resetmail->Username = "get2gethersunway@gmail.com";
$resetmail->Password = "rnovlmfyksctydjz";
$resetmail->Subject = "Imail Verification Code";
$resetmail->setFrom('get2gethersunway@gmail.com');
$resetmail->isHTML(true);



//if user signup button
if(isset($_POST['Continue'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $CPassword = mysqli_real_escape_string($conn, $_POST['CPassword']);
    if($password !== $CPassword){
        $errors['password'] = "Confirm password not matched!";
    }
    if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*\W).{8,}$/', $password)) {
        $errors['password'] = "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 symbol.";
    }

    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }

    $email_check = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['username'] = "Student ID has already exists";
    }

    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_DEFAULT); 
     
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (username, email, password, code, status)
                        values('$username', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($conn, $insert_data);

    
			if($data_check){

                //Content of the email
                $mail->Body = "<h1>Your verification code is $code</h1>";
                //Add recipient
                $mail->addAddress($email);


	if ( $mail->send() ) {
		$info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: imail_verification.php');
                exit();
	}else{
	 $errors['otp-error'] = "Failed while sending code!";
     header('location: imail_verification.php');
                exit();
			}
        }else {
     $errors['db-error'] = "Failed while inserting data into database!(The user has alreday exists:Student ID)";
	}
//Closing smtp connection
	$mail->smtpClose();
			}
	
}
		

//if user click verification code submit button
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE code = $otp_code";
    $code_res = mysqli_query($conn, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($conn, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: login.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
        
    }
}


//if user click login button
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $check_email);

   if(mysqli_num_rows($res) > 0){
       $fetch = mysqli_fetch_assoc($res);
       $fetch_pass = $fetch['password'];

       if($password == $fetch_pass){
           $status = $fetch['status'];

            if($status == 'verified'){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['name'] = $name;
                $_SESSION['user_id'] = $fetch['id'];
                $_SESSION['username'] = $fetch['username'];
              

                header('location: ../index.php');
                
           }else{
               $info = "It's look like you haven't still verify your email - $email";
               $_SESSION['info'] = $info;
               $code = rand(999999, 111111);
               $insert_codee = "UPDATE users SET code = $code WHERE email = '$email'";
               $run_queryy =  mysqli_query($conn, $insert_codee);
               header('location: imail_verification.php');
               if($run_queryy){
  
                $maill->Body = "<h1>Your verification code is $code</h1>";
                //Add recipient
                $maill->addAddress($email);
                //Finally send email
                if ( $maill->send() ) {
                $info = "It's look like you haven't still verify your email<br>We've sent a verification code to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: imail_verification.php');
                        exit();
                }else{
                $errors['otp-error'] = "Failed while sending code!";
                header('location: imail_verification.php');
                        exit();
                }

               }			
                //Closing smtp connection
                $maill->smtpClose();
                        } 
                    }else{
                        $errors['email'] = "Incorrect email or password!";
                    }
                }else{
                    $errors['email'] = "It's look like you're not yet a member! Click Register Here! to sign up";
                }
            }


            //if user click continue button in forgot password form
            if(isset($_POST['check-email'])){
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $check_email = "SELECT * FROM users WHERE email='$email'";
                $run_sql = mysqli_query($conn, $check_email);
                if(mysqli_num_rows($run_sql) > 0){
                    $code = rand(999999, 111111);
                    $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
                    $run_query =  mysqli_query($conn, $insert_code);
                    if($run_query){
            $resetmail->Body = "<h1>Your password reset code is $code</h1>";
            //Add recipient
            $resetmail->addAddress($email);
            //Finally send email
            if ( $resetmail->send() ) {
                $info = "We've sent a password reset otp to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: reset_imail_verification.php');
                        exit();
                        $resetmail->smtpClose();
            }else{
                            $errors['otp-error'] = "Failed while sending code!";
                        }
                    }else{
                        $errors['db-error'] = "Something went wrong!";
                    }
                }else{
                    $errors['email'] = "This email address does not exist!";
                }
              
            }

                        //if user click verification code submit button
            if(isset($_POST['check-reset'])){
                $_SESSION['info'] = "";
                $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
                $check_code = "SELECT * FROM users WHERE code = $otp_code";
                $code_res = mysqli_query($conn, $check_code);
                if(mysqli_num_rows($code_res) > 0){
                    $fetch_data = mysqli_fetch_assoc($code_res);
                    $fetch_code = $fetch_data['code'];
                    $email = $fetch_data['email'];
                    $code = 0;
                    $status = 'verified';
                    $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
                    $update_res = mysqli_query($conn, $update_otp);
                    if($update_res){
                        $_SESSION['name'] = $name;
                        $_SESSION['email'] = $email;
                        header('location: new_password.php');
                        exit();
                    }else{
                        $errors['otp-error'] = "Failed while updating code!";
                    }
                }else{
                    $errors['otp-error'] = "You've entered incorrect code!";
                    
                }
            }


                    //if user click change password button
                    if (isset($_POST['change-password'])) {
                        $_SESSION['info'] = "";
                        $password = mysqli_real_escape_string($conn, $_POST['password']);
                        $CPassword = mysqli_real_escape_string($conn, $_POST['CPassword']);
                    
                        if ($password !== $CPassword) {
                            $errors['password'] = "Confirm password not matched!";
                        } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*\W).{8,}$/', $password)) {
                            // Check for password complexity
                            $errors['password'] = "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 symbol.";
                        } else {
                            $code = 0;
                            $email = $_SESSION['email']; // Getting this email using session
                            $encpass = password_hash($password, PASSWORD_DEFAULT); 
                    
                            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
                            $run_query = mysqli_query($conn, $update_pass);
                            if ($run_query) {
                                $info = "Your password changed. Now you can login with your new password.";
                                $_SESSION['info'] = $info;
                                header('Location: new_password.php');
                            } else {
                                $errors['db-error'] = "Failed to change your password!";
                            }
                        }
                    }
                    
 

?>