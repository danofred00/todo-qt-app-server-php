<?php

    namespace Todolist;

    require_once __DIR__ . '/../vendor/autoload.php';

    require_once __DIR__ . '/config/config.php';

    $auth = new Api\Auth\Auth('localhost', DATABASE_NAME, 'root', '');

    var_dump($auth->get_database_connection());