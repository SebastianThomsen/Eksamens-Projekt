<?php
require_once 'app/backend/core/Init.php';

if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        $validate = new Validation();

        $validation = $validate->check($_POST, array(
            'name'  => array(
                'required'  => true,
                'min'       => 2,
                'max'       => 50
            ),
            'username'  => array(
                'required'  => true,
                'min'       => 2,
                'max'       => 20
            ),
            'current_password'  => array(
                'required'  => true,
                'min'       => 6,
                'verify'     => 'password'
            ),
            'new_password'  => array(
                'optional'  => true,
                'min'       => 6,
                'bind'      => 'confirm_new_password'
            ),

            'confirm_new_password' => array(
                'optional'  => true,
                'min'       => 6,
                'match'   => 'new_password',
                'bind' => 'new_password'
            ),
            'change_role' => array(
                'optional'  => true,
                'match'     => 'change_role'
            ),
        ));

        if ($validation->passed()) {
            try {
                $user->update(array(
                    'name'  => Input::get('name'),
                    'username'  => Input::get('username'),
                ));
        
                $role = Input::get('role');
                if ($role !== $user->data()->role) {
                    $user->changeRole($role);
                }
        
                if ($validation->optional()) {
                    $user->update(array(
                        'password'  => Password::hash(Input::get('new_password'))
                    ));
                }
                Redirect::to('profile.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        } else {
            echo '<div class="alert alert-danger"><strong></strong>' . cleaner($validation->error()) . '</div>';
        }
    }
