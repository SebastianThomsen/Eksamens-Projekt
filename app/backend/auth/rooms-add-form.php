<?php

$sql = "SELECT schedule_id, name FROM schedule";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['schedule_id'] . "'>" . $row['name'] . "</option>";
    }
} else {
    echo "<option value=''>No Classes Found</option>";
}
$conn->close();
?>