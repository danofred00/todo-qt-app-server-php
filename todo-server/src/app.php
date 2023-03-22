<?php

namespace Todolist;

use Todolist\Api\Auth;
use Todolist\Model\Connection;
use Todolist\Model\Task;
use Todolist\Model\TaskModel;
use Todolist\Model\UserModel;
use Todolist\Model\User;
use Todolist\Route\Router;
use Todolist\Utils\Utils;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

// create models
$auth = new Auth();
$tasks = new TaskModel(Connection::getInstance());


Router::get('/', function() {
    return [
        'message' => 'No view defined for this route',
    ];
});

/// Routes for tasks

Router::get('/task', function(int $id) { 
    global $tasks;
    return $tasks->get($id);
});

Router::post('/task', function($task) { 
    global $tasks;
    return $tasks->insert(Task::fromMap((array) $task));
});

Router::put('/task', function(int $id, $task) { 
    global $tasks;
    return $tasks->put($id, (array) $task);
});

Router::delete('/task', function(int $id) { 
    global $tasks;
    return $tasks->delete($id);
});

// Routes for auth system

Router::post('/login', function($user){
    global $auth;


    return $auth->login(User::fromMap((array) $user));
});

Router::post('/signup', function(){
    return 'SIGNUP';
});

