<?php

require __DIR__ . '/../src/Config/Config.php';

use PHPUnit\Framework\TestCase;
use Todolist\Controller\UserController;
use Todolist\Model\Connection;

class UserModelTest extends TestCase
{

    function testClassConstructor()
    {
        Connection::connectDB(DATABASE_HOST, DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        $model = new UserController(Connection::getInstance());
        $this->assertInstanceOf('PDO', Connection::$db, "Not and pdo instance");
    }

    function testMethodExists() 
    {
        Connection::connectDB(DATABASE_HOST, DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        $model = new UserController(Connection::getInstance());

        $this->assertTrue($model->exists('test@gmail.com'), "Exists methods not working");
    }

}