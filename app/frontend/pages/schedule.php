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
            <li>Dansk</li>
            <li>Matematik</li>
            <li>Fysik</li>
            <li>idræt </li>
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
            $time_slots = ['08:10', '09:10', '10:20', '11:20', '12:50', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            foreach ($time_slots as $time_slot): ?>
                <tr>
                    <td class="editable" data-day="Monday" data-time-slot="<?php echo $time_slot; ?>"><?php echo $time_slot; ?></td>
                    <?php foreach ($days as $day): ?>
                        <td>
                            <button type="button" onclick="addLesson('<?php echo $day; ?>', '<?php echo $time_slot; ?>')">Add Lesson</button>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function addLesson(day, timeSlot) {
            const selectedCell = document.querySelector(`td[data-day="${day}"][data-time-slot="${timeSlot}"]`);
            const lessonCell = createLessonCell('', timeSlot);
            selectedCell.appendChild(lessonCell);
        }

        function createLessonCell(subject, timeSlot) {
            const lessonCell = document.createElement('td');
            lessonCell.textContent = `${subject} - ${timeSlot}`;
            return lessonCell;
        }
    </script>
</body>
</html>