<?php
require_once 'connection.php';

$sql = "SELECT schedule_id, name, day, time_slot, event FROM scheduleV2"; 
$result = $conn->query($sql); 

function fetchEvents($conn) { 
    $sql = "SELECT schedule_id, name, day, time_slot, event FROM scheduleV2"; 
    $result = $conn->query($sql); 
    $events = []; 
    while($row = $result->fetch_assoc()) { 
        $events[$row['day']][$row['time_slot']] = $row['event']; 
    } 
    return $events; 
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (isset($_POST['day']) && isset($_POST['time_slot']) && isset($_POST['new_event'])) { 
        Database::getInstance()->query 
        ("INSERT INTO scheduleV2 (day, time_slot, event) VALUES ('" . $_POST['day'] . "', '" . $_POST['time_slot'] . "', '" . $_POST['new_event'] . "')");
        echo ""; 
    } 
} 

$events = fetchEvents($conn); 


$conn->close();

