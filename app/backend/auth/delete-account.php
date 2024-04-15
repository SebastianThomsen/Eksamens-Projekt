<?php
require_once 'app/backend/core/Init.php';

if (isset($_POST['user_id'])) {
    $userIdToDelete = $_POST['user_id'];
    $currentUser = new User();
    // Check if the current user is an administrator
    if ($currentUser->data()->role === 'administrator') {
        // If the user is an administrator, allow them to delete any account
        if($currentUser->deleteUser($userIdToDelete)) {
            echo "User with ID: $userIdToDelete deleted successfully.";
        } else {
            echo "Failed to delete user with ID: $userIdToDelete.";
        }
    } else {
        echo "Current user is not an administrator.";
    }
} else {
    echo "No user_id provided.";
}