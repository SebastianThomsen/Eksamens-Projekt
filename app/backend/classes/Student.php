<?php
require_once 'User.php';

class Student extends User {
    public function __construct() {
        $this->setRole('student');
    }

    public function update($fields = array(), $id = null) {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->user_id;
        }

        if (!$this->_db->update('users', 'user_id', $id, $fields)) {
            throw new Exception('Unable to update the user.');
        }
    }

    public function create($fields = array()) {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception("Unable to create the user.");
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