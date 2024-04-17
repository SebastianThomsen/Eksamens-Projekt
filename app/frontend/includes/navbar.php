<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Name</title>
    <link rel="stylesheet" type="text/css" href="navstyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>
    <div class="navbar">
        <div class="navbar-top">
            <div class="navbar-icons">
                <?php if ($user->isLoggedIn()) : ?>
                    <a class="nav-link" href="calendar.php">
                        <i class="bi bi-house"></i>
                    </a>
                    <a class="nav-link" href="forum.php">
                        <i class="bi bi-folder2"></i>
                    </a>
                    <a class="nav-link" href="rooms.php">
                        <i class="bi bi-door-open"></i>
                    </a>
                    <a class="nav-link" href="calendar.php">
                        <i class="bi bi-calendar2-week"></i>
                    </a>
                    <!-- Profile icon without dropdown indicator -->
                    <div class="dropdown">
                        <i class="bi bi-person profile-icon" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for dropdown menu
        document.addEventListener("DOMContentLoaded", function() {
            var dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(event) {
                    event.stopPropagation();
                    this.querySelector('.dropdown-menu').classList.toggle('show');
                });
            });

            window.onclick = function(event) {
                if (!event.target.matches('.dropdown')) {
                    var dropdowns = document.querySelectorAll('.dropdown-menu');
                    dropdowns.forEach(function(content) {
                        if (content.classList.contains('show')) {
                            content.classList.remove('show');
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>
