<?php
checkRole('administrator', 'teacher', 'student');
function checkRole($requiredRole) {
    $user = new User();
    if ($user->data()->role !== $requiredRole) {
        return false;
    }
    return true;
}