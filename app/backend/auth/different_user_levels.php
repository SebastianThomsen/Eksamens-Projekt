<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/user.php';

// Define user levels
define('ADMINISTRATOR', 1);
define('TEACHER', 2);
define('STUDENT', 3);

$userLevel = getUserLevel($user->data()->user_id); 

function getUserLevel($userId)
    {
        $DeFire = Database::getInstance();
        $stmt = $DeFire->prepare("SELECT level FROM users WHERE id = :userId");
        $stmt->execute([':userId' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['level'] : null;
    } 

    // Get the user level
if ($userLevel === ADMINISTRATOR) {
    // Code for administrators 
    echo "Welcome, Administrator!";
    } elseif ($userLevel === TEACHER) {
    // Code for teachers
    echo "Welcome, Teacher!";
    } elseif ($userLevel === STUDENT) {
    // Code for students
    echo "Welcome, Student!";
    } else {
    // Code for unauthorized users
    echo "Unauthorized access!";
    }
?>