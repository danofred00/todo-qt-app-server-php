<?php

namespace Todolist\Public;

use Todolist\Route\Router;
use Todolist\Utils\Utils;

require_once __DIR__ . '/../app.php';

Utils::debug($_REQUEST);

//////////////////
$target = DEFAULT_TARGET_URL;
if(isset($_REQUEST['target']))
{
    $tmp_target = $_REQUEST['target'];

    if(in_array('/'.$tmp_target, Router::routesName()))
    {
        $target = '/'.$tmp_target;
        
        // decode the data
        $data = null;
        if(isset($_REQUEST['data']) && !empty($_REQUEST['data']))
            $data = json_decode($_REQUEST['data']);

        Router::call($target, $_REQUEST['method'] ?? 'GET', $data);
    } else {
        // show the error document
        // header('Content-Type: application/json');
        echo Utils::json_encode(
            Router::error404("/$tmp_target", $_REQUEST['method'] ?? 'GET')
        );
    }
}

