<?php
require_once 'app/backend/core/Init.php';
require_once 'app/backend/auth/user.php';
require_once 'app/backend/classes/User.php';

define('ADMINISTRATOR', 1);
define('TEACHER', 2);
define('STUDENT', 3);

require_once 'app/backend/classes/Administrator.php';
require_once 'app/backend/classes/Teacher.php';
require_once 'app/backend/classes/Student.php';

$user = new User();

$admin = new Administrator();

$teacher = new Teacher();

$student = new Student();

$userData = $user->data();


function getUserLevel($userId)
    {
        $DeFire = Database::getInstance();
        $stmt = $DeFire->prepare("SELECT level FROM users WHERE id = :userId");
        $stmt->execute([':userId' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['level'] : null;
    } 
    
    if (property_exists($user, 'role')) {
        // Now you can safely access the role property
        $role = $user->role;
    } else {
        echo "Role property does not exist in the user object.";
    }
?>