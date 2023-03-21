<?php

namespace Todolist;

use Todolist\Api\Auth;
use Todolist\Model\Connection;
use Todolist\Model\TaskModel;
use Todolist\Route\Router;
use Todolist\Utils\Utils;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

// create models
$auth = new Auth();
$tasks = new TaskModel(Connection::getInstance());

Router::get('/', function() {
    return 'Hello World';
});

Router::get('/task', function(int $id) {
    
    global $tasks;
    return json_encode($tasks->get($id));
});

