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
            echo "<button class='delete-btn' onclick=\"window.location.href='$_SERVER[PHP_SELF]?delete_room=".$row['room_id']."'; event.stopPropagation(); return false;\">X</button>";
            echo "<h2>" . $row['room_name'] . "</h2>";
               
               // Fetching class name from database
               $classConn = new mysqli($servername, $username, $password, $dbname);
               $classSql = "SELECT name FROM schedule WHERE schedule_id=" . $row['schedule_id'];
               $classResult = $classConn->query($classSql);
               if ($classResult->num_rows > 0) {
                   $classRow = $classResult->fetch_assoc();
                   echo "<p> " . $classRow['name'] . "</p>";
               } else {
                   echo "<p>Klasse: N/A</p>";
               }
               
               echo "</div>"; // Close div here
               echo "</a>"; // Close a tag here
           }
       } else {
           echo "<p>No Rooms Found</p>";
       }
       $conn->close();
       ?>