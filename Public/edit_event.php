<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('Part/db_controller.php');
require_once('Part/navbar.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];

    // Fetch Events details based on the id
    $sql = "SELECT * FROM events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
    } else {
        echo "Event not found";
    }
} else {
    echo "No event selected";
}

// Handle form submission to update event details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEventTitle = $_POST['newEventTitle'];
    $newEventVenue = $_POST['newEventVenue'];
    $newStartTime = $_POST['newStartTime'];
    $newEndTime = $_POST['newEndTime'];
    $newStartDate = $_POST['newStartDate'];
    $newEndDate = $_POST['newEndDate'];
    $newEventDescription = $_POST['newEventDescription'];

    // Update the database with the new details
    $updateSql = "UPDATE events SET
                    event_title = '$newEventTitle',
                    event_venue = '$newEventVenue',
                    start_time = '$newStartTime',
                    end_time = '$newEndTime',
                    start_date = '$newStartDate',
                    end_date = '$newEndDate',
                    event_description = '$newEventDescription'
                  WHERE id = $event_id";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Event details updated successfully');
        window.location.href = 'event_single.php?id=" . urlencode($event_id) . "';
        
        </script>";
       
    } else {
        echo "<script>alert('Error updating event details');</script>";
    }
}
?>

<style>

form {
            background-color: white;
            padding: 20px;
            margin-top:50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #1D86C5;
            color: white;
            cursor: pointer;
        }

       select{
            margin-bottom: 16px;
        }

</style>

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
            <input type="text" id="newEventTitle" name="newEventTitle" value="<?php echo $row['event_title']; ?>">

            <label for="newEventVenue">New Event Venue</label>
            <input type="text" id="newEventVenue" name="newEventVenue" value="<?php echo $row['event_venue']; ?>">

            <label for="newStartTime">New Start Time</label>
            <input type="time" id="newStartTime" name="newStartTime" value="<?php echo $row['start_time']; ?>">

            <label for="newEndTime">New End Time</label>
            <input type="time" id="newEndTime" name="newEndTime" value="<?php echo $row['end_time']; ?>">

            <label for="newStartDate">New Start Date</label>
            <input type="date" id="newStartDate" name="newStartDate" value="<?php echo $row['start_date']; ?>">

            <label for="newEndDate">New End Date</label>
            <input type="date" id="newEndDate" name="newEndDate" value="<?php echo $row['end_date']; ?>">

            <label for="newEventDescription">New Event Description</label>
            <textarea id="newEventDescription" name="newEventDescription" rows="4"><?php echo $row['event_description']; ?></textarea>

          

            <input type="submit" value="Update Details">
        </form>

        <a href="event_single.php?id=<?php echo $event_id; ?>"><button class="btn">Back</button></a>
    </div>

</body>

</html>
