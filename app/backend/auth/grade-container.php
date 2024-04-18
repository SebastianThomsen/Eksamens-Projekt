<?php
require_once 'app/backend/core/Init.php';
$user = new User();
$userId = $user->data()->user_id;
$role = $user->data()->role;

if ($role == 'student') {
    $sql = "SELECT grades.subjects, grades.gradeNumber, users.name FROM grades INNER JOIN users ON grades.user_id = users.user_id WHERE users.user_id = $userId";
} else {
    $sql = "SELECT grades.subjects, grades.gradeNumber, users.name FROM grades INNER JOIN users ON grades.user_id = users.user_id";
}

        $result = $conn->query($sql);

$currentStudent = null; // Variable to keep track of the current student being processed

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Check if the student has changed
        if ($currentStudent !== $row['name']) {
            // If yes, close previous student's container if exists and start a new one
            if ($currentStudent !== null) {
                echo "</div>"; // Close previous student's container
            }
            $currentStudent = $row['name'];
            echo "<div class='student-container'>";
            echo "<h3><span class='student-name'>" . $currentStudent . "</span></h3>"; // Display student's name
        }
        // Display the grade for the current student
        echo "<div class='room  grade-info'>";
        echo "<h4>" . $row['subjects'] . "</h4>";
        echo "<p><strong>Karakter:</strong> " . $row['gradeNumber'] . "</p>";
        echo "</div>";
    }
    echo "</div>"; // Close the last student's container
} else {
    echo "<p>No results found</p>";
}
?>
