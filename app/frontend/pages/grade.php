<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/checkrole.php';

if(!checkRole('teacher')) {
    Redirect::to('calendar.php');
}
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

body>
    <h2>Grade System</h2>

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
 <form method="post">
    <select name="user_id">
    <?php
    $sql = "SELECT user_id FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['user_id'] . "'>" . $row['user_id'] . "</option>";
        }
    } else {
        echo "No users found.";
    }
    ?>
    </select>
    <select name="subject"> 
    <?php
        $sql = "SELECT subjects FROM grades";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['subjects'] . "'>" . $row['subjects'] . "</option>";
            }
        } else { 
            echo "0 results";
        }
    ?>  
    </select>
    <select name="grade">
        <option value="-3">-3</option>
        <option value="00">00</option>
        <option value="02">02</option>
        <option value="4">4</option>
        <option value="7">7</option>
        <option value="10">10</option>
        <option value="12">12</option>
    </select>
    <input type="submit" value="Submit Grade">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['user_id'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $sql = "UPDATE grades SET gradeNumber = ? WHERE user_id = ? AND subjects = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $grade, $name, $subject);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Grade updated successfully for user: " . $name;
    } else {
        echo "No data found or update failed";
    }
}
    ?>

    <h2>School Subject Rooms</h2>  
    <div class="container">
        <?php
        $sql = "SELECT grades.subjects, grades.gradeNumber, users.name FROM grades INNER JOIN users ON grades.user_id = users.user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr><th>Name</th><th>Subject</th><th>Grade</th></tr>";
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['subjects'] . "</td>";
                echo "<td>" . $row['gradeNumber'] . "</td>";
                echo "</tr>";
                echo "</table>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
    </form>
</body>
</html>
