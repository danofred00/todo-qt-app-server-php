<?php

namespace Todolist\Api;

use \Todolist\Model\User;
use \Todolist\Model\Category;
use \Todolist\Model\Task;

class Auth {

    public $db;

    function __construct($host, $db_name, $db_user, $db_password) {
        
        $dsn = 'mysql:dbname='.$db_name.';host='.$host;

        try {
            $this->db = new \PDO($dsn, $db_user, $db_password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
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