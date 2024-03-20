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
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
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
            if (selectedCell.childElementCount > 0) {
                // Fjern faget fra cellen
                selectedCell.removeChild(selectedCell.firstChild);
            } else if (selectedSubject !== '') {
                // Hvis cellen er tom og et fag er valgt, tilføj faget til cellen
                const lessonCell = createLessonCell(selectedSubject);
                selectedCell.appendChild(lessonCell);
            }
        }

        function createLessonCell(subject) {
            const lessonCell = document.createElement('td');
            lessonCell.textContent = subject;
            return lessonCell;
        }
    </script>
</body>
</html>
