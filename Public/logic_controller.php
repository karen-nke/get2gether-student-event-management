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
?>