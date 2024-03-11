<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/user.php';
require_once 'app/backend/classes/User.php';
require_once 'app/backend/classes/Administrator.php';
require_once 'app/backend/classes/Teacher.php';
require_once 'app/backend/classes/Student.php';

$user = new User();

$admin = new Administrator();

$teacher = new Teacher();

$student = new Student();

// Defines user levels
define('ADMINISTRATOR', 1);
define('TEACHER', 2);
define('STUDENT', 3);

$userData = $user->data();
if ($user->isLoggedIn()) {
    $userData = $user->data();
    $userLevel = getUserLevel($userData->user_id);
} else {
    // Redirect to login page or show an error
    header('Location: login.php');
    exit();
}
$userLevel = getUserLevel($userData->user_id);

function getUserLevel($userId)
    {
        $DeFire = Database::getInstance();
        $stmt = $DeFire->prepare("SELECT level FROM users WHERE id = :userId");
        $stmt->execute([':userId' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['level'] : null;
    } 

    // Gets the user level
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