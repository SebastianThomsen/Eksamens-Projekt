<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Subject Rooms</title>
    <style>
       
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .room {
            position: relative; /* Add this for positioning the delete button */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #ff6347;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
        }
        .enter-btn {
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }
        h2 {
            margin-top: 0;
        }
        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        select {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $roomName = $_POST['roomName'];
        $selectedClass = $_POST['classSelector'];

        $sql = "INSERT INTO rooms (room_name, schedule_id) VALUES ('$roomName', '$selectedClass')";

        if ($conn->query($sql) === TRUE) {
            echo "";
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
        <input type="text" id="roomName" name="roomName" placeholder="Room Name" required>
        <select id="classSelector" name="classSelector" required>
            <option value="">Select Class</option>
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
        <input type="submit" value="Add Room">
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
                echo "<div class='room' data-class='" . $row['schedule_id'] . "'>";
                echo "<h2>" . $row['room_name'] . "</h2>";
                echo "<p>Class: " . $row['schedule_id'] . "</p>";
                // Add delete button with room ID as query parameter
                echo "<button class='delete-btn' onclick=\"window.location.href='$_SERVER[PHP_SELF]?delete_room=".$row['room_id']."'\">X</button>";
                echo "<button class='enter-btn' onclick=\"window.location.href='room_details.php ?room_id=".$row['room_id']."'\">Enter</button>";
                echo "</div>";
            }
        } else {
            echo "<p>No Rooms Found</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
