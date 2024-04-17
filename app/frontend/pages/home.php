<?php require_once 'app/backend/core/init.php';
require_once 'app/backend/auth/scheduleAdd.php';
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="schedulestyles.css">
    <!-- Tilføj Bootstrap CSS-link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-AyEzDRvZd+qIAF3m8I+g9IfsLxF8aJPOaz+UVFLtd0+ibR4djc/t5qBPO0ES4v7x" crossorigin="anonymous">
    <!-- Tilføj Bootstrap Icons-link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Weekly Schedule</title> 
</head> 
<body> 

<!-- Tidsskema --> 
<table id="schedule"> 
    <thead> 
        <tr> 
            <th>Time</th> 
            <th>Mandag</th> 
            <th>Tirsdag</th> 
            <th>Onsdag</th> 
            <th>Torsdag</th> 
            <th>Fredag</th> 
        </tr> 
    </thead> 
    <tbody> 
<?php 
require_once 'app/backend/auth/schedule-tbody.php';
?>
</tbody> 
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("updateForm");
    var showFormButton = document.getElementById("showFormButton");

    showFormButton.addEventListener("click", function() {
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    });
});
</script>
</body> 
</html> 

<?php 
require_once 'app/backend/core/Init.php'; 
require_once 'app/backend/auth/connection.php';
require_once 'app/backend/auth/checkrole.php';
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
    <div class="container" id="roomContainer">
<?php require_once 'app/backend/auth/rooms-container.php'; ?>
    </div>
</body>
</html>
