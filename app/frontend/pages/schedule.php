<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Schedule</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-right: 100px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            white-space: nowrap; /* Tilføjet for at forhindre linjeskift */
            overflow: hidden; /* Tilføjet for at skjule overskydende tekst */
            max-width: 0; /* Tilføjet for at sikre, at teksten ikke gør cellen større */
        }
    </style>
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
        $events[$row['day']][$row['time_slot']] = $row['name'];
    }
    return $events;
}


    // Fetch the updated events from the database
    $events = fetchEvents($conn);

// Fetch the initial events from the database
$events = fetchEvents($conn);

// Fetch classes from the database
$sql = "SELECT schedule_id, name, day, time_slot, event FROM schedule";
$result = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['day']) && isset($_POST['time_slot']) && isset($_POST['new_event'])) {
        // Update event
        $stmt = $conn->prepare("UPDATE schedule SET event = ? WHERE day = ? AND time_slot = ?");
        $stmt->bind_param("sss", $_POST['new_event'], $_POST['day'], $_POST['time_slot']);
        $stmt->execute();
        echo "Event updated successfully";
    }
}


// Close the connection
$conn->close();

?>

<form action="" method="post">
    <input type="text" name="day" placeholder="Day">
    <input type="text" name="time_slot" placeholder="Time Slot">
    <input type="text" name="new_event" placeholder="New Event">
    <input type="submit" value="Update Event">
</form>
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
$time_slots = ['08:10 - 09:10', '09:10 - 10:10', 'Pause', '10:20 - 11:20', 'Pause', '11:50 - 12:50', 'Pause', '13:00 - 14:00', '14:00 - 15:00', '15:00 - 16:00',];
$days = ['Mandag', 'Tirsdag', 'Onsdag', 'Torsdag', 'Fredag'];

// Eksempel på en array af begivenheder
$events = [
    'Mandag' => ['08:10 - 09:10' => 'Matematik', '09:10 - 10:10' => 'Matematik', /* ... */],
    'Tirsdag' => ['08:10 - 09:10' => 'Dansk', '09:10 - 10:10' => 'Dansk', /* ... */],
    'Onsdag' => ['08:10 - 09:10' => 'Engelsk', '09:10 - 10:10' => 'Engelsk', /* ... */],
    'Torsdag' => ['08:10 - 09:10' => 'Historie', '09:10 - 10:10' => 'Historie', /* ... */],
    'Fredag' => ['08:10 - 09:10' => 'Kommunikation og It', '09:10 - 10:10' => 'Kommunikation og It', /* ... */],
];

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
