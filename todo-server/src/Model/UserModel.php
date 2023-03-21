<?php

namespace Todolist\Model;

class UserModel {

    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function exists($email) : bool 
    {
        $stmt = $this->db->prepare("SELECT * FROM `" . DATABASE_TABLE_USERS . "` WHERE email='$email'");
        $stmt->execute([]);
        if($stmt->rowCount() != 0)
            return true;

        return false;
    }

    function get($id) : array | User
    {
        $stmt = $this->db->prepare("SELECT * FROM `" . DATABASE_TABLE_USERS . "` WHERE id='$id'");
        $stmt->execute([]);
        if($stmt->rowCount())
            return User::fromMap($stmt->fetch());
        
        return [];
    }

    function get_with_email($email) : User | array
    {

        $stmt = $this->db->prepare("SELECT * FROM `" . DATABASE_TABLE_USERS . "` WHERE email='$email'");
        $stmt->execute([]);
        if($stmt->rowCount())
            return User::fromMap($stmt->fetch());
        
        return [];
    }

    function put(int $id, array $columns) {

        $keys = UserModel::format($columns);
        foreach($keys as $key) {
            $query = "UPDATE " . DATABASE_TABLE_USERS . " SET $key='$columns[$key]' WHERE id=$id";
            $this->db->exec($query);
        }
    }

    function insert(User $user) : bool
    {
        if(!$this->exists($user->email))
        {
            $query = "INSERT INTO " . DATABASE_TABLE_USERS . "(firstname, lastname, email, password)";
            $query .= " VALUES ('$user->firstname', '$user->lastname', '$user->email', '$user->password')";
            $this->db->exec($query);
            return true;
        }

        return false;
    }

    function delete(int $id) {
        $query = "DELETE FROM " . DATABASE_TABLE_USERS . " WHERE id=$id";
        $this->db->exec($query);
    }

    static function format(array $cols) : array 
    {
        return array_intersect(User::$fillable, array_keys($cols));
    }

}