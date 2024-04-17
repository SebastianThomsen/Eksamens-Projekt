<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $roomName = $_POST['roomName'];
        $selectedClass = $_POST['classSelector'];

        $sql = "INSERT INTO rooms (room_name, schedule_id) VALUES ('$roomName', '$selectedClass')";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
   
        // Handle room deletion
        if(isset($_GET['delete_room'])) {
            $room_id = $_GET['delete_room'];
            $sql = "DELETE FROM rooms WHERE room_id='$room_id'";
            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }

        $conn->close();
        ?>
        