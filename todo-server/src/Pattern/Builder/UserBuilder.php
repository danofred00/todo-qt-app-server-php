<?php

namespace Todolist\Pattern\Builder;

use Todolist\Model\User;

class UserBuilder
{
    private int $id = 0;
    private string $firstname = "";
    private string $lastname = "";
    private string $email = "";
    private string $password = "";
    private $email_verified_at = null;

    public function __construct(){ }

    public function withId(int $id) : UserBuilder
    {
        $this->id = $id;
        return $this;
    }

    public function withFirstname(string $firstname) : UserBuilder
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function withLastname(string $lastname) : UserBuilder
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function withEmail(string $email) : UserBuilder
    {
        $this->email = $email;
        return $this;
    }

    public function withPassword(string $password) : UserBuilder
    {
        $this->password = $password;
        return $this;
    }

    public function withEmailVerifiedAt($date) : UserBuilder
    {
        $this->email_verified_at = $date;
        return $this;
    }

    public function build() : User
    {
        return new User(
            $this->id,
            $this->firstname,
            $this->lastname,
            $this->email,
            $this->password,
            $this->email_verified_at
        );
    }
}
