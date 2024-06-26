<?php
require_once 'app/backend/core/Init.php';

if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        $validate = new Validation();

        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 15
            ),

            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 100,
                'unique' => 'users'
            ),

            'password' => array(
                'required' => true,
                'min' => 6
            ),

            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            )
        ));

        if ($validate->passed()) {
            try {
                $user = new User();
                $user->create(['username' => 'John', 'password' => 'password'], 'student');
                $user->create(array(
                    'username'  => Input::get('username'),
                    'password'  => Password::hash(Input::get('password')),
                    'name'      => Input::get('name')
                ));
                Redirect::to('index.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo '<div class="alert alert-danger"><strong></strong>' . cleaner($error) . '</div>';
            }
        }
    }
}
