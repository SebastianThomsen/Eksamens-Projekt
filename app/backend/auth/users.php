<?php
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