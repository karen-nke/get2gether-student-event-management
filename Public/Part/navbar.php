<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <img src="Image/minilogo.png" alt="Logo" class="logo-img">
            </div>
            <i class="bx bx-menu" id="btn"></i>
        </div>

        <ul>
            <li>
                <a href="index.php">
                    <i class='bx bx-home'></i>
                    <span class="nav-item">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li>

            <li>
                <a href="clubs.php">
                    <i class='bx bx-group'></i>
                    <span class="nav-item">Clubs</span>
                </a>
                <span class="tooltip">Clubs</span>
            </li>

            <li>
                <a href="events.php">
                    <i class='bx bx-calendar-alt'></i>
                    <span class="nav-item">Events</span>
                </a>
                <span class="tooltip">Events</span>
            </li>

            <?php
            if (isset($_SESSION['username'])) {
                // After Logged In
                echo "
                    <li>
                        <a href='profile.php'>
                            <i class='bx bx-user'></i>
                            <span class='nav-item'>Profile</span>
                        </a>
                        <span class='tooltip'>Profile</span>
                    </li>

                    <li>
                        <a href='subscription.php'>
                            <i class='bx bx-bell'></i>
                            <span class='nav-item'>Subscription</span>
                        </a>
                        <span class='tooltip'>Subscription</span>
                    </li>

                    <li>
                        <a href='Login/logout.php'>
                            <i class='bx bx-log-out'></i>
                            <span class='nav-item'>Logout</span>
                        </a>
                        <span class='tooltip'>Logout</span>
                    </li>
                ";
            } else {
                // Before Loggin
                echo "
                    <li>
                        <a href='Login/login.php'>
                            <i class='bx bx-log-in'></i>
                            <span class='nav-item'>Login</span>
                        </a>
                        <span class='tooltip'>Login</span>
                    </li>

                    <li>
                        <a href='Login/Register.php'>
                            <i class='bx bx-edit' ></i>
                            <span class='nav-item'>Register</span>
                        </a>
                        <span class='tooltip'>Register</span>
                    </li>
                ";
            }
            ?>
        </ul>
    </div>

    <script>
        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function(){
            sidebar.classList.toggle('active');
        };
    </script>
</body>
</html>
