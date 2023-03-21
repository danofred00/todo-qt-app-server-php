<?php

namespace Todolist\Public;

use Todolist\Route\Router;
use Todolist\Utils\Utils;

require_once __DIR__ . '/../app.php';

Utils::debug($_SERVER['REQUEST_URI']);

Utils::debug($_GET);

//////////////////
$target = DEFAULT_TARGET_URL;

Utils::debug(Router::routesName());