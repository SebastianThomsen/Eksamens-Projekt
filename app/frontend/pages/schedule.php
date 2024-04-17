<?php require_once 'app/backend/auth/checkrole.php';
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="schedulestyles.css">
    <title>Weekly Schedule</title> 
</head> 
<body> 
 
<?php 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "defire"; 
 
$conn = new mysqli($servername, $username, $password, $dbname); 
 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 
 
$sql = "SELECT schedule_id, name, day, time_slot, event FROM schedule"; 
$result = $conn->query($sql); 
 
// Fetch classes from the database 
function fetchEvents($conn) { 
    $sql = "SELECT schedule_id, name, day, time_slot, event FROM schedule"; 
    $result = $conn->query($sql); 
    $events = []; 
    while($row = $result->fetch_assoc()) { 
        $events[$row['day']][$row['time_slot']] = $row['event']; 
    } 
    return $events; 
} 
 
// Fetch the updated events from the database 
$events = fetchEvents($conn); 

 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (isset($_POST['day']) && isset($_POST['time_slot']) && isset($_POST['new_event'])) { 
        // Create event 
        Database::getInstance()->query 
        ("INSERT INTO schedule (day, time_slot, event) VALUES ('" . $_POST['day'] . "', '" . $_POST['time_slot'] . "', '" . $_POST['new_event'] . "')");
        echo "Event updated successfully"; 
    } 
} 
    
 
// Close the connection 
$conn->close(); 
 
?> 

<?php if (checkRole('administrator')): ?>
<form action="" method="post"> 
    <input type="text" name="day" placeholder="Day"> 
    <input type="text" name="time_slot" placeholder="Time Slot"> 
    <input type="text" name="new_event" placeholder="New Event"> 
    <input type="submit" value="Update Event"> 
</form>
<?php endif; ?>

    <!-- Tidsskema --> 
    <table id="schedule"> 
        <thead> 
            <tr> 
                <th>Time</th> 
                <th>Mandag</th> 
                <th>Tirsdag</th> 
                <th>Onsdag</th> 
                <th>Torsdag</th> 
                <th>Fredag</th> 
            </tr> 
        </thead> 
        <tbody> 
<?php 
$time_slots = ['08:10 - 09:10', '09:10 - 10:10', '10:20 - 11:20', '11:50 - 12:50', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',]; 
$days = ['Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag']; 
 
 
foreach ($time_slots as $time_slot) { 
    echo "<tr>"; 
    echo "<td>" . $time_slot . "</td>"; 
    foreach ($days as $day) { 
        // Hvis der er en begivenhed på denne dag og tidsslot, vis den 
        if (isset($events[$day][$time_slot])) { 
            echo "<td>" . $events[$day][$time_slot] . "</td>"; 
        } else { 
            echo "<td></td>"; 
        } 
    } 
    echo "</tr>"; 
} 

?>
 
</tbody> 
</html> 