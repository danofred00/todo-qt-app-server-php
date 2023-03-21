<?php

namespace Todolist\Public;

use Todolist\Route\Router;
use Todolist\Utils\Utils;

require_once __DIR__ . '/../app.php';

Router::call('/task', 'GET', [1]);

Utils::debug($_SERVER['REQUEST_URI']);

Utils::debug($_GET);