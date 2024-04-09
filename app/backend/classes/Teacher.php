<?php
require_once 'User.php';

class Teacher extends User {
    public function __construct() {
        $this->setRole('teacher');
    }

    public function changeRole($role) {
        if (validateRole($role)) {
            $this->role = $role;
        } else {
            throw new Exception("Invalid role.");
        }
    }

    public function update($fields = array(), $id = null) {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->user_id;
        }

        if (!$this->_db->update('users', 'user_id', $id, $fields)) {
            throw new Exception('Unable to update the user.');
        }
    }

    public function find($user = null) {
        if ($user) {
            $field = (is_numeric($user)) ? 'user_id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
}