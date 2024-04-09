<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/user.php';
$user = new User();
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
    <!-- Link to Bootstrap Icons -->
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
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo escape($user->name); ?></td>
                <td><?php echo escape($user->username); ?></td>
                <td><?php echo escape($user->role); ?></td>
                <td>
                    <form action="app/backend/auth/delete-account.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo escape($user->id); ?>">
                        <button type="submit" class="delete-btn" data-tooltip="Slet brugerkonto"><i class="bi bi-trash3"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
