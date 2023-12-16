<?php

function fetchUserRole($user_id, $club_id, $conn)
{
    $sql = "SELECT role FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['role'];
    } else {
        return "";
    }
}

function fetchMemberCount($club_id, $conn)
{
    $sql = "SELECT clubs.*, COUNT(memberships.user_id) AS member_count
            FROM clubs
            LEFT JOIN memberships ON clubs.id = memberships.club_id
            WHERE clubs.id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['member_count'];
    } else {
        return 0;
    }
}

function fetchUpcomingEvents($club_id, $conn)
{
    $sql = "SELECT events.*, clubs.club_name FROM events
            JOIN clubs ON events.club_id = clubs.id
            WHERE events.club_id = $club_id AND events.start_date >= CURDATE()
            ORDER BY events.start_date LIMIT 3";

    $result = $conn->query($sql);

    $events = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    return $events;
}

function fetchClubDetails($club_id, $conn) {
    $sql = "SELECT * FROM clubs WHERE id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function getAllClubs($conn) {
    $clubs = array();

    $sql = "SELECT * FROM clubs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clubs[] = $row;
        }
    }

    return $clubs;

}

// -------- Edit Club Details -------
function updateClubDetails($club_id, $newDescription, $newContactEmail, $newInstagramLink, $newFacebookLink, $conn)
{
    $updateSql = "UPDATE clubs SET
                    description = '$newDescription',
                    contact_email = '$newContactEmail',
                    instagram_link = '$newInstagramLink',
                    facebook_link = '$newFacebookLink'
                  WHERE id = $club_id";

    return $conn->query($updateSql) === TRUE;
}

function handleClubDetailsUpdate($club_id, $conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newDescription = $_POST['newDescription'];
        $newContactEmail = $_POST['newContactEmail'];
        $newInstagramLink = $_POST['newInstagramLink'];
        $newFacebookLink = $_POST['newFacebookLink'];

        if (updateClubDetails($club_id, $newDescription, $newContactEmail, $newInstagramLink, $newFacebookLink, $conn)) {
            echo "<script>alert('Club details updated successfully');
            window.location.href = 'club_single.php?id=" . urlencode($club_id) . "';
            </script>";
        } else {
            echo "<script>alert('Error updating club details');</script>";
        }
    }
}

function fetchEventDetails($event_id, $conn)
{
    $eventDetails = array();

    $sql = "SELECT * FROM events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $eventDetails = $result->fetch_assoc();
    }

    return $eventDetails;
}

// Edit Event Details

function updateEventDetails($event_id, $newEventTitle, $newEventVenue, $newStartTime, $newEndTime, $newStartDate, $newEndDate, $newEventDescription, $conn)
{
    $updateSql = "UPDATE events SET
                    event_title = '$newEventTitle',
                    event_venue = '$newEventVenue',
                    start_time = '$newStartTime',
                    end_time = '$newEndTime',
                    start_date = '$newStartDate',
                    end_date = '$newEndDate',
                    event_description = '$newEventDescription'
                  WHERE id = $event_id";

    return $conn->query($updateSql) === TRUE;
}

function handleEventDetailsUpdate($event_id, $conn)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newEventTitle = $_POST['newEventTitle'];
        $newEventVenue = $_POST['newEventVenue'];
        $newStartTime = $_POST['newStartTime'];
        $newEndTime = $_POST['newEndTime'];
        $newStartDate = $_POST['newStartDate'];
        $newEndDate = $_POST['newEndDate'];
        $newEventDescription = $_POST['newEventDescription'];

        if (updateEventDetails($event_id, $newEventTitle, $newEventVenue, $newStartTime, $newEndTime, $newStartDate, $newEndDate, $newEventDescription, $conn)) {
            echo "<script>alert('Event details updated successfully');
            window.location.href = 'event_single.php?id=" . urlencode($event_id) . "';
            </script>";
        } else {
            echo "<script>alert('Error updating event details');</script>";
        }
    }
}

// Single Event Page 
function fetchEventDetails_ID($event_id, $conn)
{
    $sql = "SELECT events.*, clubs.club_name, clubs.contact_email FROM events
            JOIN clubs ON events.club_id = clubs.id
            WHERE events.id = $event_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function isUserRegisteredForEvent($user_id, $event_id, $conn)
{
    $checkRegistrationSql = "SELECT * FROM event_registrations WHERE user_id = $user_id AND event_id = $event_id";
    $checkRegistrationResult = $conn->query($checkRegistrationSql);

    return $checkRegistrationResult && $checkRegistrationResult->num_rows > 0;
}

function hasPermissionToViewParticipants($user_id, $club_id)
{
    global $conn; 

    $sql = "SELECT role FROM memberships WHERE user_id = $user_id AND club_id = $club_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userRole = $row['role'];

        // Check if the user has the role of 'pic' or 'committee'
        return ($userRole === 'pic' || $userRole === 'committee');
    } else {
        return false; 
    }
}

// Events Page

function fetchEvents($conn, $endDateCondition) {
    $events = array();

    $sql = "SELECT events.*, clubs.club_name FROM events
            JOIN clubs ON events.club_id = clubs.id
            WHERE $endDateCondition";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    return $events;
}

//User Profile 
function getUserDetails($user_id, $conn) {
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

function getJoinedClubs($user_id, $conn) {
    $joinedClubsSql = "SELECT clubs.id, clubs.club_name
                    FROM memberships
                    JOIN clubs ON memberships.club_id = clubs.id
                    WHERE memberships.user_id = $user_id";

    $joinedClubsResult = $conn->query($joinedClubsSql);

    if ($joinedClubsResult && $joinedClubsResult->num_rows > 0) {
        $clubs = [];
        while ($clubRow = $joinedClubsResult->fetch_assoc()) {
            $clubs[] = [
                'id' => $clubRow['id'],
                'club_name' => htmlspecialchars($clubRow['club_name']),
            ];
        }
        return $clubs;
    } else {
        return [];
    }
}

function getRegisteredEvents($user_id, $conn) {
    $registeredEventsSql = "SELECT events.*, clubs.club_name
                        FROM event_registrations
                        JOIN events ON event_registrations.event_id = events.id
                        JOIN clubs ON events.club_id = clubs.id
                        WHERE event_registrations.user_id = $user_id";

    $registeredEventsResult = $conn->query($registeredEventsSql);

    if ($registeredEventsResult && $registeredEventsResult->num_rows > 0) {
        $events = [];
        while ($eventRow = $registeredEventsResult->fetch_assoc()) {
            $events[] = [
                'id' => $eventRow['id'],
                'event_image_path' => htmlspecialchars($eventRow['event_image_path']),
                'event_title' => $eventRow['event_title'],
                'start_date' => $eventRow['start_date'],
                'event_venue' => $eventRow['event_venue'],
                'club_name' => $eventRow['club_name'],
            ];
        }
        return $events;
    } else {
        return [];
    }
}


function getUpcomingEventsByClub($user_id, $conn) {
    $upcomingEventsByClub = [];

    // Fetch joined clubs
    $joinedClubs = getJoinedClubs($user_id, $conn);

    foreach ($joinedClubs as $club) {
        $club_id = $club['id'];
        $club_name = $club['club_name'];

        // Fetch upcoming events for the club
        $upcomingEventsSql = "SELECT events.*, clubs.club_name
            FROM events
            JOIN clubs ON events.club_id = clubs.id
            WHERE events.club_id = $club_id AND events.start_date > NOW()
            ORDER BY events.start_date DESC
            LIMIT 5"; // Limit to 5 upcoming events, adjust as needed

        $upcomingEventsResult = $conn->query($upcomingEventsSql);

        if ($upcomingEventsResult && $upcomingEventsResult->num_rows > 0) {
            $events = [];
            while ($eventRow = $upcomingEventsResult->fetch_assoc()) {
                $events[] = [
                    'id' => $eventRow['id'],
                    'event_image_path' => htmlspecialchars($eventRow['event_image_path']),
                    'event_title' => $eventRow['event_title'],
                    'start_date' => $eventRow['start_date'],
                    'event_venue' => $eventRow['event_venue'],
                    'club_name' => $eventRow['club_name'],
                ];
            }
            $upcomingEventsByClub[$club_name] = $events;
        }
    }

    return $upcomingEventsByClub;
    var_dump($upcomingEventsByClub);
}


    function getOrganizedEvents($user_id, $conn) {
        $organizedEventsSql = "SELECT events.*, clubs.club_name
                            FROM events
                            JOIN clubs ON events.club_id = clubs.id
                            WHERE events.id IN (
                                SELECT DISTINCT event_id
                                FROM event_registrations
                                WHERE user_id = $user_id
                            )";

        $organizedEventsResult = $conn->query($organizedEventsSql);

        if ($organizedEventsResult && $organizedEventsResult->num_rows > 0) {
            $events = [];
            while ($eventRow = $organizedEventsResult->fetch_assoc()) {
                $events[] = [
                    'id' => $eventRow['id'],
                    'event_image_path' => htmlspecialchars($eventRow['event_image_path']),
                    'event_title' => $eventRow['event_title'],
                    'start_date' => $eventRow['start_date'],
                    'event_venue' => $eventRow['event_venue'],
                    'club_name' => $eventRow['club_name'],
                ];
            }
            return $events;
        } else {
            return [];
        }
    }



?>