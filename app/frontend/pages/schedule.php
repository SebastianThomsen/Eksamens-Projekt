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

<!-- Tilføj ikon og style knappen -->
<button id="showFormButton" class="btn btn-primary mt-3" title="Vis opdateringsformular">
    <i class="bi bi-book"></i>
</button>

<?php if (checkRole('administrator')): ?>
<form id="updateForm" action="" method="post" style="display: none;"> 
    <select name="day" placeholder="Day"> 
        <option value="Mandag">Mandag</option> 
        <option value="Tirsdag">Tirsdag</option> 
        <option value="Onsdag">Onsdag</option> 
        <option value="Torsdag">Torsdag</option> 
        <option value="Fredag">Fredag</option>
    </select>
    <select name="time_slot" placeholder="Time Slot"> 
        <option value="08:10 - 09:10">08:10 - 09:10</option> 
        <option value="09:10 - 10:10">09:10 - 10:10</option> 
        <option value="10:20 - 11:20">10:20 - 11:20</option> 
        <option value="11:50 - 12:50">11:50 - 12:50</option> 
        <option value="13:00 - 14:00">13:00 - 14:00</option> 
        <option value="14:00 - 15:00">14:00 - 15:00</option> 
        <option value="15:00 - 16:00">15:00 - 16:00</option>
    </select>
    <select name="new_event" placeholder="New Event"> 
        <option value="Math">Matematik</option>
        <option value="English">Engelsk</option>
        <option value="Science">Fysik</option>
        <option value="History">Idehistorie</option>
        <option value="Gym">Idræt</option>
    </select>
    <input type="submit" value="Update Event" class="btn btn-primary mt-3"> 
</form> 
<?php endif; ?>

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