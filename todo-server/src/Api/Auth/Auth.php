<?php

namespace Todolist\Api\Auth;

class Auth {

    public $db;

    function __construct($host, $db_name, $db_user, $db_password) {
        
        $dsn = 'mysql:dbname='.$db_name.';host='.$host;
        $this->db = new \PDO($dsn, $db_user, $db_password);
    }

    function get_database_connection() {
        return $this->db;
    }

}