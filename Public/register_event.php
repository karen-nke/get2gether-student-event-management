<?php

session_start();

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    // User is logged in, you can use the session variables
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch event details based on the id
    $sql = "SELECT * FROM events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $eventDetails = $result->fetch_assoc();
    } else {
        echo "Event not found";
        exit();
    }
} else {
    echo "No event selected";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_event'])) {
    // Handle event registration logic
    $user_id = $user_id;
    $event_id = $eventDetails['id'];

    // Check if the user is already registered for the event
    $check_sql = "SELECT * FROM event_registrations WHERE user_id = $user_id AND event_id = $event_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // User is not registered, insert into event_registrations table
        $insert_sql = "INSERT INTO event_registrations (user_id, event_id) VALUES ($user_id, $event_id)";
        $insert_result = $conn->query($insert_sql);

        if ($insert_result) {

            echo "<script>
                    alert('Event registration successful!');
                    window.location.href = 'event_single.php?id=" . urlencode($event_id) . "';
                </script>";
          
        } else {
            echo "<script>alert('Error registering for the event.');</script>";
        }
    } else {
        echo "<script>alert('You are already registered for this event.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register for Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="page-container">
        <div class="image-container">
            <img src="<?php echo htmlspecialchars($eventDetails["event_image_path"]); ?>" class="image-banner"
                alt="Event Banner">
        </div>

        <div class="single-event-container">
            <h2 class="title"><?php echo $eventDetails["event_title"]; ?></h2>

            <p class="field-name">Description</p>
            <p class="desc"><?php echo $eventDetails["event_description"]; ?></p>

            <p class="field-name">Event Date & Time</p>
            <p class="desc">Event Date: <?php echo $eventDetails["start_date"]; ?></p>
            <p class="desc">Event Time: <?php echo $eventDetails["start_time"] . ' - ' . $eventDetails["end_time"]; ?>
            </p>

            <p class="field-name">Event Venue</p>
            <p class="desc"><?php echo $eventDetails["event_venue"]; ?></p>

            <p class="field-name">Organizer</p>
            <p class="desc"><?php echo $eventDetails["club_name"]; ?></p>
            <p class="desc">Contact Email Address: <?php echo $eventDetails["contact_email"]; ?></p>
        </div>

        <form method="post" action="">
            <button type="submit" class="btn" name="register_event">Confirm Registration</button>
        </form>
    </div>
</body>

</html>