<?php

    namespace Todolist;

    require_once __DIR__ . '/../vendor/autoload.php';

    require_once __DIR__ . '/config/config.php';

    $auth = new Api\Auth();
    $model = new Model\UserModel(Model\Connection::getInstance());

    $user = $model->get(1);
    $user->password = '123';
    var_dump($auth->login($user));
