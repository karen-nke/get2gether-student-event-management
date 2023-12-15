
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
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

// Check if the user has the 'pic' role
function hasPicRole($user_id, $club_id, $conn) {
    $sql = "SELECT role FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return ($row['role'] === 'pic');
    } else {
        return false;
    }
}

// Check if club_id is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $club_id = $_GET['id'];

    // Fetch club details based on the id
    $clubSql = "SELECT * FROM clubs WHERE id = $club_id";
    $clubResult = $conn->query($clubSql);

    if ($clubResult->num_rows > 0) {
        $clubRow = $clubResult->fetch_assoc();

        // Check if the user has the 'pic' role for this club
        if (hasPicRole($user_id, $club_id, $conn)) {
            // Fetch the list of members for the club
            $membersSql = "SELECT * FROM memberships WHERE club_id = $club_id AND role <> 'pic'";
            $membersResult = $conn->query($membersSql);

            // Include the header and necessary styles
            require_once('Part/navbar.php');
            echo '<link rel="stylesheet" href="style.css">';
            echo '<div class="page-container">';

            if ($membersResult->num_rows > 0) {
                echo '<form method="post" action="save_member_changes.php?id=' . $club_id . '">';
                echo '<input type="hidden" name="club_id" value="' . $club_id . '">';
                echo '<table>';
                echo '<tr><th>Username</th><th>Current Role</th><th>Change Role</th></tr>';

                while ($member = $membersResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($member['username']) . '</td>';
                    echo '<td>' . htmlspecialchars($member['role']) . '</td>';
                    echo '<td>';
                    echo '<select name="role_change[' . $member['user_id'] . ']">';
                    echo '<option value="member">Member</option>';
                    echo '<option value="committee">Committee</option>';
                    echo '</select>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '<button type="submit" class="btn">Save Changes</button>';
                echo '</form>';
            } else {
                echo '<p>No members in this club yet.</p>';
            }

            // Include the footer
            echo '</div>';
        } else {
            echo '<p>You do not have permission to edit members for this club.</p>';
        }
    } else {
        echo "Club not found";
    }
} else {
    echo "No club selected";
}
?>