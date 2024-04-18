<?php require_once 'app/backend/core/Init.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <style>
       
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET['room_id'])) {
        $room_id = $_GET['room_id'];
        
        // Fetch room details from the database based on room_id
        $servername = "defiregutterpaatur_dk";
        $username = "mysql57.unoeuro.com";
        $password = "dFBEwgAbGmnRck9tzx6H";
        $dbname = "defiregutterpaatur_dk_db";
        

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM rooms WHERE room_id='$room_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display room details
            echo "<div class='container'>";
            echo "<h2>" . $row['room_name'] . "</h2>";
            echo "<p>Klasse: " . $row['schedule_id'] . "</p>";
            
            // Fetch folders associated with the room
            $sql = "SELECT folder_id, folder_name FROM folders_rooms";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<h3>Folders:</h3>";
                while ($row = $result->fetch_assoc()) {
                    echo "<p>Folder ID: " . $row['folder_id'] . ", Folder Name: " . $row['folder_name'] . "</p>";
                }
            } else {
                echo "<p>No folders found for this room</p>";
            }

            echo "</div>";
        } else {
            echo "<p>Room not found</p>";
        }
        $conn->close();
    } else {
        echo "<p>Room ID not provided</p>";
    }
    ?>
</body>
</html>
