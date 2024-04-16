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
    if(isset($_GET['room_id'])) {
        $room_id = $_GET['room_id'];
        
        // Fetch room details from the database based on room_id
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "defire";

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
            echo "<p>Class: " . $row['schedule_id'] . "</p>";
            
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
