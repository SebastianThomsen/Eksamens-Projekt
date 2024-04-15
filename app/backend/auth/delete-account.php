<?php
require_once 'app/backend/core/Init.php';

if (isset($_POST['user_id'])) {
    $userIdToDelete = $_POST['user_id'];
    $currentUser = new User();

    if ($userIdToDelete != $currentUser->data()->id) {
        $currentUser->deleteUser($userIdToDelete);
    }
}

Redirect::to('index.php');
