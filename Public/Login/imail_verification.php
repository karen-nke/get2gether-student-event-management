<?php require "../Part/userdata_controller.php"; 

$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imail Verification Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

<div class="signup-container">
    <div class="signup-image">
    <img class="img-fluid" src="../Image/Sunway_Image.png" alt="Signup Image">
    </div>

    <div class="signup-form">
        <h2>Imail Verification</h2>

        <div class="signup-description">
            <h4>Enter the 4-digits code sent to the Imail<br>
        </div>


    
        <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

        <div class="register-form">
        <form action="imail_verification.php" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="email">Imail</label>
                <div class="input-container">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                        <path d="M1.49414 2.67627H15.5059C16.3297 2.67627 17 3.34654 17 4.17041V12.8292C17 13.6531 16.3297 14.3233 15.5059 14.3233H1.49414C0.670271 14.3233 0 13.6531 0 12.8292V4.17041C0 3.34654 0.670271 2.67627 1.49414 2.67627ZM1.68914 3.67236L1.88856 3.83841L7.90719 8.85013C8.25071 9.13614 8.74936 9.13614 9.09281 8.85013L15.1114 3.83841L15.3109 3.67236H1.68914ZM16.0039 4.39148L11.1001 8.4749L16.0039 11.7385V4.39148ZM1.49414 13.3272H15.5059C15.7465 13.3272 15.9478 13.1556 15.9939 12.9284L10.3014 9.13992L9.73018 9.61559C9.37377 9.91236 8.93685 10.0607 8.49997 10.0607C8.06308 10.0607 7.62619 9.91236 7.26976 9.61559L6.69853 9.13992L1.00605 12.9284C1.05221 13.1557 1.25348 13.3272 1.49414 13.3272ZM0.996094 11.7385L5.89993 8.47493L0.996094 4.39148V11.7385Z" fill="black"/>
                    </svg>
                    <input type="number" placeholder="4-digits code" id="email" name="otp" required>
                </div>
            </div>
          
          
            <div class="form-group">
                <input type="submit" name="check" value="Verify">
            </div>

            <div class="form-group">
                <div class="back-group">
                    <a class="back-button" href="register.php">Back</a>
                </div>
            </div>

        
        </form>
        </div>
    </div>
</div>

</body>
</html>
