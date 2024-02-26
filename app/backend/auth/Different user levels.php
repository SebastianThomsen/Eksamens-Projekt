<?php
// Main.php

// Include necessary files
include 'Administrator.php';
include 'Teacher.php';
include 'Student.php';

// Define user levels
define('ADMINISTRATOR', 1);
define('TEACHER', 2);
define('STUDENT', 3);

// Check user level
$userLevel = getUserLevel($userId); 

if ($userLevel === ADMINISTRATOR) {
    include 'Administrator.php';
} elseif ($userLevel === TEACHER) {
    include 'Teacher.php';
} elseif ($userLevel === STUDENT) {
    include 'Student.php';
} else {
    echo "Unauthorized access!";
}

// Function to get user level
function getUserLevel($userId)
{
    global $DeFire; 
    $stmt = $DeFire->prepare("SELECT level FROM users WHERE id = :userId");
    $stmt->execute([':userId' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? $user['level'] : null;
}
?>
