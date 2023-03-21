<?php

namespace Todolist\Public;

use Todolist\Route\Router;
use Todolist\Utils\Utils;

require_once __DIR__ . '/../app.php';

Utils::debug($_SERVER['REQUEST_URI']);

Utils::debug($_GET);

//////////////////
$target = DEFAULT_TARGET_URL;
if(isset($_GET) && !empty($_GET['target']))
{
    $tmp_target = $_GET['target'];
    if(in_array('/'.$tmp_target, Router::routesName()))
    {

    } else {
        // show the error document
        // header('Content-Type: application/json');
        echo json_encode(Router::error404($_SERVER['REQUEST_URI']), JSON_UNESCAPED_SLASHES);
    }
}

Utils::debug(Router::routesName());