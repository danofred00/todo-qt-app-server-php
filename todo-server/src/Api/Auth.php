<?php

namespace Todolist\Api;

use \Todolist\Model\User;
use \Todolist\Model\UserModel;
use \Todolist\Model\Category;
use \Todolist\Model\Task;
use \Todolist\Model\Connection;

class Auth {

    private $db;
    private UserModel $userModel;

    public static $USER_SIGNUP_SUCCED = 0;
    public static $USER_ALREADY_EXISTS = 1;
    public static $USER_NOT_EXISTS = 2;
    public static $USER_LOGIN_SUCCED = 3;
    public static $USER_LOGIN_FAILED = 4;

    function __construct() {
        Connection::connectDB('localhost', 'todolist_db', 'root', '');
        $this->db = Connection::getInstance();

        // getting user model
        $this->userModel = new UserModel($this->db);
    }

    function get_database_connection() {
        return $this->db;
    }

    function signup(User $user) : int {

        if($this->userModel->insert($user))
            return Auth::$USER_SIGNUP_SUCCED;
        else
            return Auth::$USER_ALREADY_EXISTS;
    }

    function login(User $user) : int {
        
        if(!$this->userModel->exists($user->email))
            return Auth::$USER_NOT_EXISTS;

        $remoteUser = $this->userModel->get_with_email($user->email);
        if(strcmp(md5($user->password), $remoteUser->password) == 0)
            return Auth::$USER_LOGIN_SUCCED;
        else 
            return Auth::$USER_LOGIN_FAILED;
    }

}
