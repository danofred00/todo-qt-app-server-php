<?php

namespace Todolist\Api;

use \Todolist\Model\User;
use \Todolist\Model\Category;
use \Todolist\Model\Task;
use \Todolist\Model\Connection;

class Auth {

    private $db;

    function __construct() {
        Connection::connectDB('localhost', 'todolist_db', 'root', '');
        $this->db = Connection::getInstance();
    }

    function get_database_connection() {
        return $this->db;
    }

    function user_signup() : array {

    }

    function user_login($email, $password) : array {
        // hash algorithme is md5
        $pwd = md5($password);

        if($this->user_exits($email)){
            $auth_response = 'USER_EXIST';
        } else {
            $auth_response = 'USER_NOT_EXIST';
        }

        return [
            'response' => $auth_response
        ];
    }


    function user_exits($email) : bool 
    {

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE email='$email'");
        $stmt->execute([]);
        if($stmt->rowCount() != 0)
            return true;

        return false;
    }

}