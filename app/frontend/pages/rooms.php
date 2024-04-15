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
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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

    <form id="addRoomForm">
        <input type="text" id="roomName" placeholder="Room Name" required>
        <select id="classSelector" required>
            <option value="">Select Class</option>
            <!-- PHP-koden her -->
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "defire";

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
        <!-- PHP-koden her -->
        <?php
        // For at vise eksisterende rum
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
                echo "</div>";
            }
        } else {
            echo "<p>No Rooms Found</p>";
        }
        $conn->close();
        ?>
    </div>

    <script>
        document.getElementById('addRoomForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const roomName = document.getElementById('roomName').value;
            const selectedClass = document.getElementById('classSelector').value;

            if (roomName && selectedClass) {
                const newRoom = document.createElement('div');
                newRoom.classList.add('room');
                newRoom.setAttribute('data-class', selectedClass); // Tilføj data-attribut for klassen
                const heading = document.createElement('h2');
                heading.textContent = roomName;
                const paragraph = document.createElement('p');
                paragraph.textContent = 'Class: ' + selectedClass;
                newRoom.appendChild(heading);
                newRoom.appendChild(paragraph);
                document.getElementById('roomContainer').appendChild(newRoom);
                document.getElementById('addRoomForm').reset();
            } else {
                alert('Please enter both room name and select a class.');
            }
        });
    </script>
</body>
</html>
