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

$user = new User();

if(isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    $sql = "DELETE FROM users WHERE user_id='$userId'";
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "No user_id provided.";
    }
}
$users = $user->getAllUsers();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" type="text/css" href="usersstyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Navn</th>
            <th>Email</th>
            <th>Rolle</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT user_id, username, name, usertype FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['usertype'] . "</td>";
                echo "<td><form action='users.php' method='post'><input type='hidden' name='user_id' value='" . $row['user_id'] . "'><button type='submit' name='delete' class='btn btn-danger'><i class='bi bi-trash'></i></button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
