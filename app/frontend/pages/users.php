<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/connection.php';
require_once 'app/backend/auth/users.php';
require_once 'app/backend/auth/checkrole.php';

$requiredRole = 'administrator';
if ($user->data()->role !== $requiredRole) {
    Redirect::to('home.php');
}

$user = new User();
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
        </tr>
    </thead>

    <?php 
       require_once 'app/backend/auth/users-tbody.php';
    ?>

</table>

</body>
</html>
