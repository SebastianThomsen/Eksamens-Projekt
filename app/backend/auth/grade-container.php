<?php
require_once 'app/backend/core/Init.php';

        $sql = "SELECT grades.subjects, grades.gradeNumber, users.name FROM grades INNER JOIN users ON grades.user_id = users.user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr><th>Name</th><th>Subject</th><th>Grade</th></tr>";
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['subjects'] . "</td>";
                echo "<td>" . $row['gradeNumber'] . "</td>";
                echo "</tr>";
                echo "</table>";
            }
        } else {
            echo "0 results";
        }
        ?>