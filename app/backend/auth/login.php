<?php
require_once 'app/backend/core/Init.php'; // This file contains the initialization of the application

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
            if ($user->data()->role == 'administrator') {
                Redirect::to('admin.php');
            } else {
                Redirect::to('home.php');
            }
        }
    } else {
        foreach ($validation->errors() as $error) {
            echo '<div class="alert alert-danger"><strong></strong>' . cleaner($error) . '</div>';
        }
    }
}