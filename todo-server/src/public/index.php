<?php

namespace Todolist\Public;

use Todolist\Route\Router;

require_once __DIR__ . '/../app.php';

Router::call('/', 'GET');