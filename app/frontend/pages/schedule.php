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

$sql = "SELECT schedule_id, name FROM schedule";
$result = $conn->query($sql);

?>

    <!-- Dropdown-menu til valg af klasse -->
    <div>
        <label for="scheduleSelection">Select Schedule:</label>
        <select id="scheduleSelection" onchange="changeSchedule()">
            <?php
            $sql = "SELECT schedule_id, name FROM schedule";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['schedule_id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- Liste over fag -->
    <div id="subjectList">
        <h2>Fag</h2>
        <ul>
            <li onclick="selectSubject('Dansk')">Dansk</li>
            <li onclick="selectSubject('Matematik')">Matematik</li>
            <li onclick="selectSubject('Fysik')">Fysik</li>
            <li onclick="selectSubject('Idræt')">Idræt</li>
            <li onclick="selectSubject('Kommunikation og it')">Kommunikation og it</li>
            <li onclick="selectSubject('Teknikfag')">Teknikfag</li>
            <li onclick="selectSubject('Idéhistorie')">Idéhistorie</li>
        </ul>
    </div>

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
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            foreach ($time_slots as $time_slot): ?>
                <tr>
                    <td class="editable" data-day="Monday" data-time-slot="<?php echo $time_slot; ?>"><?php echo $time_slot; ?></td>
                    <?php foreach ($days as $day): ?>
                        <td onclick="addLesson('<?php echo $day; ?>', '<?php echo $time_slot; ?>')">
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        let selectedSubject = '';

        function selectSubject(subject) {
            selectedSubject = subject;
        }

        function addLesson(day, timeSlot) {
            const selectedCell = event.target;
            // Hvis cellen allerede indeholder et fag
            if (selectedCell.textContent.trim() !== '') {
                // Fjern faget fra cellen
                selectedCell.textContent = '';
            } else if (selectedSubject !== '') {
                // Hvis cellen er tom og et fag er valgt, tilføj faget til cellen
                selectedCell.textContent = selectedSubject;
            }
        }
    </script>  
</body>
</html>
