<?php
require_once 'app/backend/auth/user.php';
require_once 'app/backend/classes/User.php';
require_once 'app/backend/core/Init.php';

$user = new User();

if (isset($_POST['delete'])) {
    $userId = $_POST['user_id']; // Get the user_id from the form
    $user->deleteUser($userId); // Delete the user
}

$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" type="text/css" href="usersstyles.css">
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo escape($user->username); ?></td>
                <td><?php echo escape($user->name); ?></td>
                <td><?php echo escape($user->role); ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
