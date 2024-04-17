<?php require_once 'app/backend/core/init.php';
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="schedulestyles.css">
    <!-- Tilføj Bootstrap CSS-link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-AyEzDRvZd+qIAF3m8I+g9IfsLxF8aJPOaz+UVFLtd0+ibR4djc/t5qBPO0ES4v7x" crossorigin="anonymous">
    <!-- Tilføj Bootstrap Icons-link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
        echo ""; 
    } 
} 
    

// Close the connection 
$conn->close(); 

?> 

<!-- Tilføj ikon og style knappen -->
<button id="showFormButton" class="btn btn-primary mt-3" title="Vis opdateringsformular">
    <i class="bi bi-book"></i>
</button>

<?php if (checkRole('administrator')): ?>
<form id="updateForm" action="" method="post" style="display: none;"> 
    <select name="day" placeholder="Day"> 
        <option value="Mandag">Mandag</option> 
        <option value="Tirsdag">Tirsdag</option> 
        <option value="Onsdag">Onsdag</option> 
        <option value="Torsdag">Torsdag</option> 
        <option value="Fredag">Fredag</option>
    </select>
    <select name="time_slot" placeholder="Time Slot"> 
        <option value="08:10 - 09:10">08:10 - 09:10</option> 
        <option value="09:10 - 10:10">09:10 - 10:10</option> 
        <option value="10:20 - 11:20">10:20 - 11:20</option> 
        <option value="11:50 - 12:50">11:50 - 12:50</option> 
        <option value="13:00 - 14:00">13:00 - 14:00</option> 
        <option value="14:00 - 15:00">14:00 - 15:00</option> 
        <option value="15:00 - 16:00">15:00 - 16:00</option>
    </select>
    <select name="new_event" placeholder="New Event"> 
        <option value="Math">Matematik</option>
        <option value="English">Engelsk</option>
        <option value="Science">Fysik</option>
        <option value="History">Idehistorie</option>
        <option value="Gym">Idræt</option>
    </select>
    <input type="submit" value="Update Event" class="btn btn-primary mt-3"> 
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
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("updateForm");
    var showFormButton = document.getElementById("showFormButton");

    showFormButton.addEventListener("click", function() {
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    });
});
</script>
</body> 
</html> 

<?php 
require_once 'app/backend/core/Init.php'; 
require_once 'app/backend/auth/connection.php';
require_once 'app/backend/auth/checkrole.php';
require_once 'app/backend/auth/rooms.php';
require_once 'app/backend/auth/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="roomstyles.css">
    <title>School Subject Rooms</title>
</head>
<body>
    <div class="container" id="roomContainer">
<?php require_once 'app/backend/auth/showRooms.php'; ?>
    </div>
</body>
</html>
