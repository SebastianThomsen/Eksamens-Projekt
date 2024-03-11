<?php
require_once 'app/backend/core/Init.php'; // This file contains the initialization of the application
require_once 'app/backend/auth/different_user_levels.php'; // This file contains the different user levels
define('ADMINISTRATOR', 'administator');


if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        $validate   = new Validation();

        $validation = $validate->check($_POST, array(
            'username'  => array(
                'required'  => true,
            ),

            'password'  => array(
                'required'  => true
            )
        ));
    }
        if ($validation->passed()) {
            $remember   = (Input::get('remember') === 'on') ? true : false;
            $login      = $user->login(Input::get('username'), Input::get('password'), $remember);
            if ($login) {
                $userLevel = getUserLevel($user->data()->user_id);
                if ($userLevel === ADMINISTRATOR) {
                    Session::flash('login-success', 'You have successfully logged in!');
                    Redirect::to('admin.php');
                } else {
                Session::flash('login-success', 'You have successfully logged in!');
                Redirect::to('forum.php');
            } 
        } else {
            foreach ($validation->errors() as $error) {
                echo '<div class="alert alert-danger"><strong></strong>' . cleaner($error) . '</div>';
            }
        }
    }
}
?>