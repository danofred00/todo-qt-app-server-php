<?php

namespace Todolist\Api;

use \Todolist\Model\User;
use \Todolist\Model\UserModel;
use \Todolist\Model\Category;
use \Todolist\Model\Task;
use \Todolist\Model\Connection;

enum AuthResponseType : int {
    case UserAlreadyExists = 0;
    case UserLoginFailed = 1;
    case UserLoginSucced = 2;
    case UserNotExists = 3;
    case UserSignUpSucced = 4;
}

class Auth {

    private $db;
    private UserModel $userModel;

    function __construct() {
        Connection::connectDB('localhost', 'todolist_db', 'root', '');
        $this->db = Connection::getInstance();

        // getting user model
        $this->userModel = new UserModel($this->db);
    }

    function get_database_connection() {
        return $this->db;
    }

    function signup(User $user) : bool {

        if($this->userModel->insert($user))
            return AuthResponseType::UserSignUpSucced;
        else
            return AuthResponseType::UserAlreadyExists;
    }

    function login(User $user) : AuthResponseType {
        
        if(!$this->userModel->exists($user->email))
            return AuthResponseType::UserNotExists;

        $remoteUser = $this->userModel->get_with_email($user->email);
        if(strcmp(md5($user->password), $remoteUser->password) == 0)
            return AuthResponseType::UserLoginSucced;
        else 
            return AuthReponseType::UserLoginFailed;
    }

}
