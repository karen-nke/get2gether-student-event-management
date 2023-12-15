<?php
// Include necessary files and start the session
require_once('Part/db_controller.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Get the user details from the session
$user_id = $_SESSION['user_id'];


// Check if club_id is provided in the POST data
if (isset($_POST['club_id']) && !empty($_POST['club_id'])) {
    $club_id = $_POST['club_id'];

    // Check if the user has the 'pic' role for this club
    $sql = "SELECT role FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['role'] === 'pic') {
            // Fetch the list of members for the club
            $membersSql = "SELECT * FROM memberships WHERE club_id = $club_id";
            $membersResult = $conn->query($membersSql);

            if ($membersResult->num_rows > 0) {
                // Loop through each member and update their role
                while ($member = $membersResult->fetch_assoc()) {
                    $user_id = $member['user_id'];
                
                    // Skip the update for the 'pic' role
                    if ($member['role'] !== 'pic') {
                        $newRole = $_POST['role_change'][$user_id];
                
                        // Update the role in the database
                        $updateSql = "UPDATE memberships SET role = '$newRole' WHERE user_id = $user_id AND club_id = $club_id";
                        $conn->query($updateSql);
                    }
                }

                echo "<script>
                    alert('Updated!');
                    window.location.href = 'club_single.php?id=" . urlencode($club_id) . "';
                    </script>";
                
                exit();
            } else {
                echo "<script>alert('No members in this club yet.'); window.location.href = document.referrer;</script>";
            }
        } else {
            echo "<script>alert('You do not have permission to edit members for this club.'); window.location.href = document.referrer;</script>";
        }
    } else {
        echo "Club not found";
    }
} else {
    echo "No club selected";
}



?>