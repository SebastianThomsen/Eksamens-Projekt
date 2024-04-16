<?php
require_once 'app/backend/core/Init.php';

if(isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    $sql = "DELETE FROM users WHERE user_id='$userId'";
    if(isset($userId)) {
        $user->deleteUser($userId);
        Redirect::to('index.php');
    } else {
        echo "No user_id provided.";
    }
}