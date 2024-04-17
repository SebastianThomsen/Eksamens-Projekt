<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="roomstyles.css">
    <title>School Subject Rooms</title>
</head>
<body>

    <?php
    require_once 'app/backend/core/Init.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "defire";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
    


    <form id="addRoomForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" id="roomName" name="roomName" placeholder="Rum navn" required>
        <select id="classSelector" name="classSelector" required>
            <option value="">Vælg klasse</option>
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

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
        </select>
        <input type="submit" value="Tilføj rum">
    </form>

    <div class="container" id="roomContainer">
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT room_id, room_name, schedule_id FROM rooms";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<a href='room_details.php?room_id=".$row['room_id']."' class='room' data-class='" . $row['schedule_id'] . "'>";
                echo "<div>"; // Open div here
                echo "<button class='delete-btn' onclick=\"window.location.href='$_SERVER[PHP_SELF]?delete_room=".$row['room_id']."'\">X</button>";
                echo "<h2>" . $row['room_name'] . "</h2>";
                echo "<p>Class: " . $row['schedule_id'] . "</p>";
                echo "</div>"; // Close div here
                echo "</a>"; // Close a tag here
            }
        } else {
            echo "<p>No Rooms Found</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
