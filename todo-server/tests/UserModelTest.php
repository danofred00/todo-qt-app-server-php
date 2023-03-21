<?php

require __DIR__ . '/../src/Config/Config.php';

use PHPUnit\Framework\TestCase;
use Todolist\Model\Connection;
use Todolist\Model\UserModel;

class UserModelTest extends TestCase
{

    function testClassConstructor()
    {
        Connection::connectDB('localhost', DATABASE_NAME, 'root', '');
        $model = new UserModel(Connection::getInstance());

        $this->assertInstanceOf('PDO', Connection::$db, "Not and pdo instance");
    }

    function testMethodExists() 
    {
        Connection::connectDB('localhost', DATABASE_NAME, 'root', '');
        $model = new UserModel(Connection::getInstance());

        $this->assertTrue($model->exists('test@gmail.com'), "Exists methods not working");
    }

}