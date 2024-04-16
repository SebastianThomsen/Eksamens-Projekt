<?php
require_once 'app/backend/core/Init.php';
?>

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
</head

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
    ?>
    <h2>School Subject Rooms</h2>  
    <div class="container">
        <?php

        $sql = "SELECT grade_id, subjects FROM grades";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['subjects'] . "</td>";
                echo "<td><input type='text' name='grade'></td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        echo "</table>";
        $conn->close();
        ?>
    </div>
</body>
</html>
