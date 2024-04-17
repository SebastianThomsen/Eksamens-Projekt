<?php require_once 'app/backend/core/Init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="roomstyles.css">
    <title>School Subject Rooms</title>
</head>
<body>
    <form id="addRoomForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" id="roomName" name="roomName" placeholder="Rum navn" required>
        <select id="classSelector" name="classSelector" required>
            <option value="">Vælg klasse</option>
<?php require_once 'app/backend/auth/addRooms.php'; ?>
        </select>
        <input type="submit" value="Tilføj rum">
    </form>

    <div class="container" id="roomContainer">
<?php require_once 'app/backend/auth/showRooms.php'; ?>
    </div>
</body>
</html>
