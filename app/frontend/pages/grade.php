<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/checkrole.php';
require_once 'app/backend/auth/connection.php';
require_once 'app/backend/auth/grade.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="gradestyles.css">
    <title>School Subject Rooms</title>
</head>
<body>
<div class="container">
    <?php if (checkRole('administrator') || checkRole('teacher')): ?>
        <form method="post">
            <?php require_once 'app/backend/auth/grade-submit-grade.php'; ?>
            <select name="grade">
                <option value="-3">-3</option>
                <option value="00">00</option>
                <option value="02">02</option>
                <option value="4">4</option>
                <option value="7">7</option>
                <option value="10">10</option>
                <option value="12">12</option>
            </select>
            <input type="submit" value="Tilføj karakter">
        </form>
    <?php endif; ?>

<div class="room">
        <?php require_once 'app/backend/auth/grade-container.php'; ?>
    </div>
</div>
</body>
</html>
