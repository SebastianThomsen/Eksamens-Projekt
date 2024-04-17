<?php
checkRole('administrator', 'teacher', 'student', 'guest');
function checkRole($requiredRole) {
    $user = new User();
    if ($user->data()->role !== $requiredRole) {
        return false;
    }
    return true;
}