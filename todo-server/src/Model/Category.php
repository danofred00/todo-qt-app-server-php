<?php

namespace Todolist\Model;

class Category {

    public int $id;
    public string $category;

    function __construct(int $id, string $category) {
        $this->id = $id;
        $this->category = $category;
    }

    function fromMap(array $map) : Category {
        return new Category(
            $map['id'],
            $map['category']
        );
    }

    function toMap() : array {
        return [
            'id' => $this->id,
            'category' => $this->category
        ];
    }

}