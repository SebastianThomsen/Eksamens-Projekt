<?php 
require_once 'app/backend/core/Init.php'; 
require_once 'app/backend/auth/connection.php';
require_once 'app/backend/auth/checkrole.php';
require_once 'app/backend/auth/rooms.php';
require_once 'app/backend/auth/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="roomstyles.css">
    <title>School Subject Rooms</title>
</head>
<body>
    <?php if (checkrole('administrator')): ?>
    <form id="addRoomForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" id="roomName" name="roomName" placeholder="Rum navn" required>
        <select id="classSelector" name="classSelector" required>
            <option value="">Vælg klasse</option>
<?php require_once 'app/backend/auth/connect.php';
require_once 'app/backend/auth/rooms-add-form.php'; ?>
        </select>
        <input type="submit" value="Tilføj rum">
    </form>
<?php endif; ?>
    <div class="container" id="roomContainer">
<?php require_once 'app/backend/auth/rooms-container.php'; ?>
    </div>
</body>
</html>