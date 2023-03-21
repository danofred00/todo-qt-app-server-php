<?php

namespace Todolist\Model;


class Task {

    public $id;
    public $title;
    public $description = null;
    public $user_id;
    public $category_id;
    public $state;

    public static $STATE_DONE = 1;
    public static $STATE_SCHEDULLE = 2;

    public static $fillable = [
        'title', 'description', 'user_id',
        'category_id', 'state'
    ];

    function __construct($id, $title, $description, $state, $user_id, $category_id) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->state = $state;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }

    function toMap() {
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'state' => $this->state,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id
        );
    }

    static function fromMap(array $map) {
        return new Task(
            $map['id'],
            $map['title'],
            $map['description'],
            $map['state'],
            $map['user_id'],
            $map['category_id'],
        );
    }

}
