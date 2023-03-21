<?php

namespace Todolist\Model;

class Connection 
{

    public static $db;

    static function connectDB($host, $db_name, $db_user, $db_password) {
        
        $dsn = 'mysql:dbname='.$db_name.';host='.$host;

        try {
            Connection::$db = new \PDO($dsn, $db_user, $db_password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    static function getInstance() : \PDO
    {
        return Connection::$db;
    }

}