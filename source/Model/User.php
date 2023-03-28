<?php

namespace Todolist\Model;

class User {

    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public $email_verified_at;

    public static $fillable = [
        'firstname', 'lastname',
        'email', 'password', 'email_verified_at'
    ];

    function __construct($id, $firstname, $lastname, $email, $password, $email_verified_at = null)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->email_verified_at = $email_verified_at;

    }

    public static function fromMap(array $map) {
        return new User(
            $map['id'], 
            $map['firstname'], 
            $map['lastname'], 
            $map['email'], 
            $map['password'], 
            $map['email_verified_at']
        );
    }

    function toMap() {
        return array(
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => $this->password,
            'email_verified_at' => $this->email_verified_at,
        );
    } 

}