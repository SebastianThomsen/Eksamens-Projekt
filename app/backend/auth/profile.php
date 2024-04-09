<?php
require_once 'app/backend/core/Init.php';

if (! $user->isLoggedIn())
{
     Redirect::to('home.php');
}

$data = $user->data();


