<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="navbar">
    <div class="menu-item">
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="event.php">Events</a>
            <div class="dropdown">
                <button class="dropbtn">Module
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="soft_skills.php?skill=leadership">Leadership</a>
                    <a href="soft_skills.php?skill=communication">Communication</a>
                    <a href="soft_skills.php?skill=teamwork">Teamwork</a>
                </div>
            </div>
            <a href="leaderboard.php">Leaderboard</a>
        </div>

<?php
        if (isset($_SESSION['username'])) {
            echo "
                <button class=\"login-button\"><a href=\"account.php\">Account</a></button>
                <button class=\"register-button\"><a href=\"Login/logout.php\">Logout</a></button>
            ";
        } else {
            echo "
                <button class=\"login-button\"><a href=\"Login/login.php\">Login</a></button>
                <button class=\"register-button\"><a href=\"Login/register.php\">Register</a></button>
            ";
        }
?>
    </div>
    <a href="index.php"><img src="Image/Logo.png" /></a>
</div>

<style>
    /* Add your existing styles here */
</style>

    


<style>

    /* Navigation Bar */

    .navbar{
        width: 100%; 
        height: 120px; 
        background-color:#FFF;
        padding: 20px;
    }

    .menu-item {

        align-items: center;
        gap: 24px;
        display: inline-flex;
        float: right;


    }


    .menu{
        justify-content: flex-end; 
        align-items: center; 
        gap: 33px; 
        display: flex

    }

    .menu a{
        text-align: center; color: #001F3D; font-size: 18px; font-family: Poppins; font-weight: 400; line-height: 18px; word-wrap: break-word; text-decoration: none;

    }

    .navbar .img{
        width: 93px; 
        height: 93px;
        float: left;
        position:absolute;

    }

    .login-button{
        padding-left: 24px; 
        padding-right: 24px; 
        padding-top: 18px; 
        padding-bottom: 18px; 
        background: white; 
        border-radius: 30px; 
        border: 1px #E87A00 solid; 
        justify-content: flex-end; 
        align-items: center; 
        gap: 8px; 
        display: flex

    }

    .login-button a{
        text-align: center; 
        color: #001F3D; 
        font-size: 16px; 
        font-family: 'Poppins', sans-serif; 
        font-weight: 400; 
        line-height: 18px; 
        word-wrap: break-word;
        text-decoration: none;

    }

    .register-button{
        padding-left: 24px; padding-right: 24px; padding-top: 18px; padding-bottom: 18px; background: #001F3D; border-radius: 30px; justify-content: flex-end; align-items: center; gap: 8px; display: flex;
    }

    .register-button a{
        text-align: center; 
        color: white; 
        font-size: 16px; 
        font-family: 'Poppins', sans-serif; 
        font-weight: 500; 
        line-height: 18px; 
        word-wrap: break-word;
        text-decoration: none;

    }

      /* The dropdown container */
  .dropdown{
    float: left;
    overflow: hidden;
  
  }
  
  /* Dropdown button */
  .dropdown .dropbtn {
      font-size: 16px; 
      font-family: 'Poppins', sans-serif; 
      border: none;
      outline: none;
      color: #001F3D;
      padding: 14px 16px;
      background-color: inherit;
      font-family: inherit; /* Important for vertical align on mobile phones */
      margin: 0; /* Important for vertical align on mobile phones */
    }
  
  
    
    /* Dropdown content (hidden by default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    /* Links inside the dropdown */
    .dropdown-content a {
      float: none;
      color: #001F3D;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }
    
    /* Add a grey background color to dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #fff;
    }
    
    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
      display: block;
    }

    .navbar a:hover, .dropdown:hover .dropbtn {
      color: #E87A00;
          
   }
  
  

  
</style>
