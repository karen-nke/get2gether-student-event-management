<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once('Part/db_controller.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id']) && isset($_POST['join_club'])) {
    // User is logged in and the form is submitted
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $club_id = $_POST['club_id'];
    $club_name = fetchClubName($club_id);  
    $role = 'member';  

    // Check if the user is already a member of the club
    $check_sql = "SELECT * FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // User is not a member, insert into memberships table
        $insert_sql = "INSERT INTO memberships (user_id, username, club_id, club_name, role) VALUES ($user_id, '$username', $club_id, '$club_name', '$role')";
        $insert_result = $conn->query($insert_sql);

        if ($insert_result) {
            echo "<script>alert('Joined the club successfully!');
                    window.location.href = document.referrer;
                </script>";

        } else {

            echo "<script>alert('Error joining the club.');
                    window.location.href = document.referrer;
                </script>";

            
        }
    } else {
        echo "<script>alert('You are already a member of this club.');
                window.location.href = document.referrer;
                </script>";
      
    }
} else {
    echo "Invalid request.";
}

// Function to fetch the club name based on club_id
function fetchClubName($club_id) {
    global $conn;

    $sql = "SELECT club_name FROM clubs WHERE id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['club_name'];
    } else {
        return "";
    }
}
?>