<?php

    namespace Todolist;

    require_once __DIR__ . '/../vendor/autoload.php';

    require_once __DIR__ . '/config/config.php';

    $auth = new Api\Auth();
    $model = new Model\UserModel(Model\Connection::getInstance());

    var_dump($auth->login($model->get(1)));
