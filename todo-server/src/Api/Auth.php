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

    public static int $USER_SIGNUP_SUCCED = 101;
    public static int $USER_SIGNUP_FAILED = 102;
    public static int $USER_ALREADY_EXISTS = 103;
    public static int $USER_NOT_EXISTS = 104;
    public static int $USER_LOGIN_SUCCED = 105;
    public static int $USER_LOGIN_FAILED = 106;

    function __construct() {
        Connection::connectDB(DATABASE_HOST, DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
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
        if(strcmp($user->password, $remoteUser->password) == 0)
            return Auth::$USER_LOGIN_SUCCED;
        else 
            return Auth::$USER_LOGIN_FAILED;
    }

    public static function auth_code_toString(int $code) : string
    {
        switch ($code) {
            case Auth::$USER_ALREADY_EXISTS:
                return 'USER_ALREADY_EXISTS';
            case Auth::$USER_LOGIN_FAILED:
                return 'USER_LOGIN_FAILED';
            case Auth::$USER_LOGIN_SUCCED:
                return 'USER_LOGIN_SUCCED';
            case Auth::$USER_NOT_EXISTS:
                return 'USER_NOT_EXISTS';
            case Auth::$USER_SIGNUP_SUCCED:
                return 'USER_SIGNUP_SUCCED';
            default:
                return 'UNKNOW AUTH_CODE';
        }
    }

}
