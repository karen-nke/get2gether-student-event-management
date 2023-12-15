<?php require_once "../Part/userdata_controller.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
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
        <h2>Login</h2>

        <div class="signup-description">
            <h4>If you don't have an account register <br>
             You can&nbsp&nbsp&nbsp <a class="login-link" href="register.php" >Register here ! </a></h4>   
        </div>

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
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Imail</label>
                <div class="input-container">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                        <path d="M1.49414 2.67627H15.5059C16.3297 2.67627 17 3.34654 17 4.17041V12.8292C17 13.6531 16.3297 14.3233 15.5059 14.3233H1.49414C0.670271 14.3233 0 13.6531 0 12.8292V4.17041C0 3.34654 0.670271 2.67627 1.49414 2.67627ZM1.68914 3.67236L1.88856 3.83841L7.90719 8.85013C8.25071 9.13614 8.74936 9.13614 9.09281 8.85013L15.1114 3.83841L15.3109 3.67236H1.68914ZM16.0039 4.39148L11.1001 8.4749L16.0039 11.7385V4.39148ZM1.49414 13.3272H15.5059C15.7465 13.3272 15.9478 13.1556 15.9939 12.9284L10.3014 9.13992L9.73018 9.61559C9.37377 9.91236 8.93685 10.0607 8.49997 10.0607C8.06308 10.0607 7.62619 9.91236 7.26976 9.61559L6.69853 9.13992L1.00605 12.9284C1.05221 13.1557 1.25348 13.3272 1.49414 13.3272ZM0.996094 11.7385L5.89993 8.47493L0.996094 4.39148V11.7385Z" fill="black"/>
                    </svg>
                    <input type="email" placeholder="Enter your Imail Address" id="email" name="email" required>
                </div>
            </div>
          

            <div class="form-group">
                <label for="password">Password</label>
                <div style="position: relative;">
                <div class="input-container">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                        <path d="M13.0029 7.2296V4.53742C13.0101 3.31927 12.5235 2.14798 11.655 1.29383C10.8152 0.457706 9.71602 0 8.55193 0C8.53391 0 8.51228 0 8.49427 0C6.01112 0.00360399 3.99289 2.03625 3.99289 4.53742V7.2296C3.05585 7.34132 2.37109 8.12699 2.37109 9.07844V15.1259C2.37109 16.1531 3.1928 17 4.21994 17H12.7794C13.8065 17 14.6282 16.1531 14.6282 15.1259V9.07844C14.6246 8.13059 13.9399 7.34132 13.0029 7.2296ZM4.71008 4.53742H4.71368C4.71368 2.43269 6.41116 0.709985 8.49787 0.709985H8.50147C9.49257 0.706381 10.444 1.09922 11.1468 1.79839C11.8784 2.52279 12.2857 3.51028 12.2785 4.53742V7.2332H11.4856V4.53742C11.4928 3.71931 11.1684 2.93364 10.5882 2.35701C10.0404 1.8092 9.29795 1.49926 8.5231 1.49926H8.50147C6.84364 1.49926 5.50296 2.86156 5.50296 4.53381V7.2332H4.71008V4.53742ZM10.7684 4.53742V7.2332H6.22736V4.53742C6.22736 3.26161 7.24368 2.22366 8.50508 2.22366H8.5267C9.11055 2.22366 9.67277 2.45792 10.0872 2.87238C10.5269 3.31206 10.7756 3.91393 10.7684 4.53742ZM13.9399 15.1367C13.9399 15.7674 13.4281 16.2792 12.7974 16.2792H4.23435C3.60366 16.2792 3.09189 15.7674 3.09189 15.1367V9.09646C3.09189 8.46576 3.60366 7.954 4.23435 7.954H12.7974C13.4281 7.954 13.9399 8.46576 13.9399 9.09646V15.1367Z" fill="black"/>
                        <path d="M9.74528 11.8933C9.58671 11.3347 9.07855 10.9526 8.49831 10.9526C7.78111 10.9526 7.19727 11.5329 7.19727 12.2537C7.19727 12.8339 7.57929 13.3421 8.13791 13.5007V14.5098C8.13791 14.708 8.30009 14.8702 8.49831 14.8702C8.69652 14.8702 8.8587 14.708 8.8587 14.5098V13.5007C9.54707 13.3024 9.94711 12.5816 9.74528 11.8933ZM8.49831 12.8303C8.17755 12.8303 7.91806 12.5708 7.91806 12.2501C7.91806 11.9293 8.17755 11.6698 8.49831 11.6698C8.81906 11.6698 9.07855 11.9293 9.07855 12.2501C9.07855 12.5708 8.81906 12.8303 8.49831 12.8303Z" fill="black"/>
                    </svg>
                    <input type="password" id="password" name="password" placeholder="Enter your Password" required>
                    <i class="fa fa-eye-slash password-toggle" onclick="togglePassword('password')"></i>
                </div>
                </div>
            </div>

        
          
            <div class="form-group">
                <input type="submit" value="Login" name="login">
            </div>

            <div class="back-group">
               <a class="back-button" href="forgot_password.php" >Forgot password</a>
            </div>
        </form>
        </div>
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
