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
</head

<body>
<?php if (checkRole('administrator') || checkRole('teacher')): ?>
    <h2>Grade System</h2>
 <form method="post">
<?php
require_once 'app/backend/auth/grade-submit-grade.php';
?>

    <select name="grade">
        <option value="-3">-3</option>
        <option value="00">00</option>
        <option value="02">02</option>
        <option value="4">4</option>
        <option value="7">7</option>
        <option value="10">10</option>
        <option value="12">12</option>
    </select>
    <input type="submit" value="Submit Grade">
</form>
<?php endif; ?>

    <h2>School Subject Rooms</h2>  
    <div class="container">
        <?php require_once 'app/backend/auth/grade-container.php';
        ?>
    </div>
    </form>
</body>
</html>
