<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/user.php';
$user = new User();
$users = $user->getAllUsers();
?>

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
                    <form action="app/backend/auth/delete-account.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo escape($user->id); ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>