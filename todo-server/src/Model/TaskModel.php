<?php

namespace Todolist\Model;

use Exception;

class TaskModel
{
    private $db;

    function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function get(int $id) : Task | array
    {
        if(! $this->exists($id))
            return [];

        $stmt = $this->db->prepare("SELECT * FROM " . DATABASE_TABLE_TASKS ." WHERE id=$id");
        $stmt->execute([]);
        return Task::fromMap($stmt->fetch());
    }

    public function insert(Task $task) : bool
    {
        try {

            if($this->exists($task->id))
                return false;

            $query = "INSERT INTO " . DATABASE_TABLE_TASKS . "(title, description, state, user_id, category_id)";
            $query .= " VALUES ('$task->title', '$task->description', $task->state, $task->user_id, $task->category_id)";
            $this->db->exec($query);

            return true;
        } catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function user(Task $task) : User | array
    {
        if(! $this->exists($task->id))
            return [];
        
        $stmt = $this->db->prepare("SELECT * FROM " . DATABASE_TABLE_USERS ." WHERE id=$task->user_id");
        $stmt->execute([]);
        return User::fromMap($stmt->fetch());
    }

    public function category(Task $task) : Category | array
    {
        if(! $this->exists($task->id))
            return [];
        
        $stmt = $this->db->prepare("SELECT * FROM " . DATABASE_TABLE_CATEGORY ." WHERE id=$task->category_id");
        $stmt->execute([]);
        return Category::fromMap($stmt->fetch());
    }

    public function put(int $id, $cols)
    {

        if(! $this->exists($id))
            return;

        $keys = TaskModel::format($cols);
        foreach ($keys as $col) {
            $query = "UPDATE " . DATABASE_TABLE_TASKS . " SET $col='$cols[$col]'";
            $this->db->exec($query);
        }
    }

    public function delete($id) : bool 
    {
        if(! $this->exists($id))
            return false;
        
        $query = "DELETE FROM " . DATABASE_TABLE_TASKS . " WHERE id=$id";
        $this->db->exec($query);
        return true;
    }

    public function exists(int $id) : bool
    {
        $stmt = $this->db->prepare("SELECT * FROM " . DATABASE_TABLE_TASKS . " WHERE id=$id");
        $stmt->execute([]);

        if($stmt->rowCount() != 0)
            return true;

        return false;
    }

    public static function format(array $row) : array{
        return array_intersect_key(Task::$fillable, array_keys($row));
    }


}