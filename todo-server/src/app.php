<?php

namespace Todolist;

use Todolist\Api\Auth;
use Todolist\Model\Connection;
use Todolist\Route\Router;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

Router::get('/', function() {
    return 'Hello World';
});
