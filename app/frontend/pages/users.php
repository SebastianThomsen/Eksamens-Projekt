<?php
require_once 'app/backend/auth/user.php';
require_once 'app/backend/classes/User.php';
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

if (isset($_POST['delete'])) {
    require_once 'app/backend/auth/delete-account.php';
    $userId = $_POST['user_id'];
    if (isset($userId)) {
        $user->deleteUser($userId);
        Redirect::to('index.php');
    } else {
        echo "No user_id provided.";
    }
}

$users = $user->getAllUsers();
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
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo escape($user->name); ?></td>
                <td><?php echo escape($user->username); ?></td>
                <td><?php echo escape($user->role); ?></td>
                <td>
                    <form action="" method="post">
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
