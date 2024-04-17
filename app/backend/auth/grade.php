<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['user_id'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $sql = "UPDATE grades SET gradeNumber = ? WHERE user_id = ? AND subjects = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $grade, $name, $subject);
    $stmt->execute();
}
    ?>