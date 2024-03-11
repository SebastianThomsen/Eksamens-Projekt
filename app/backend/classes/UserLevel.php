<?php
class UserLevel
{
    public static function isAdmininstrator()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['user_level'] == 'Admininstrator')
        {
            return true;
        }
        return false;
    }
    public static function isStudent()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['user_level'] == 'Student')
        {
            return true;
        }
        return false;
    }
    public static function isTeacher()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['user_level'] == 'Teacher')
        {
            return true;
        }
        return false;
    }
}