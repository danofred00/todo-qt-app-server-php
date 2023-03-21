<?php

namespace Todolist;

use Todolist\Model\Connection;
use Todolist\Model\TaskModel;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

Connection::connectDB('localhost', DATABASE_NAME, 'root', '');
$model = new TaskModel(Connection::getInstance());

$task = $model->get(1);
var_dump($model->category($task));
