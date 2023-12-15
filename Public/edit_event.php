<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Part/db_controller.php');
require_once('Part/navbar.php');
require_once('logic_controller.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch Event details based on the id using the function from logic_controller.php
    $eventDetails = fetchEventDetails($event_id, $conn);

    if ($eventDetails) {
        // Event details are available, you can use $eventDetails array
    } else {
        echo "Event not found";
    }
} else {
    echo "No event selected";
}

handleEventDetailsUpdate($event_id, $conn)
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Club Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="page-container">
   
        <form action="" method="post">
            <h2>Edit Event Details</h2>

            <label for="newEventTitle">New Event Title</label>
            <input type="text" id="newEventTitle" name="newEventTitle" value="<?php echo $eventDetails['event_title']; ?>">

            <label for="newEventVenue">New Event Venue</label>
            <input type="text" id="newEventVenue" name="newEventVenue" value="<?php echo $eventDetails['event_venue']; ?>">

            <label for="newStartTime">New Start Time</label>
            <input type="time" id="newStartTime" name="newStartTime" value="<?php echo $eventDetails['start_time']; ?>">

            <label for="newEndTime">New End Time</label>
            <input type="time" id="newEndTime" name="newEndTime" value="<?php echo $eventDetails['end_time']; ?>">

            <label for="newStartDate">New Start Date</label>
            <input type="date" id="newStartDate" name="newStartDate" value="<?php echo $eventDetails['start_date']; ?>">

            <label for="newEndDate">New End Date</label>
            <input type="date" id="newEndDate" name="newEndDate" value="<?php echo $eventDetails['end_date']; ?>">

            <label for="newEventDescription">New Event Description</label>
            <textarea id="newEventDescription" name="newEventDescription" rows="4"><?php echo $eventDetails['event_description']; ?></textarea>

          

            <input type="submit" value="Update Details">
        </form>

        <a href="event_single.php?id=<?php echo $event_id; ?>"><button class="btn">Back</button></a>
    </div>

</body>

</html>
