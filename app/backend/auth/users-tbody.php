<tbody>
<?php
$servername = "mysql57.unoeuro.com";
$username = "defiregutterpaatur_dk";
$password = "dFBEwgAbGmnRck9tzx6H";
$dbname = "defiregutterpaatur_dk_db";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_id, username, name, role FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "<td><form action='users.php' method='post'><input type='hidden' name='user_id' value='" . $row['user_id'] . "'><button type='submit' name='delete' class='btn btn-danger'><i class='bi bi-trash'></i></button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        $conn->close();
?>
</tbody>