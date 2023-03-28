<?php

use PHPUnit\Framework\TestCase;
use Todolist\Model\User;

final class UserTest extends TestCase 
{
    public function testClassConstructor()
    {
        $user = new User(1, 'John', 'Doe', 'johndoe@localhost', 'password', null);
        $this->assertSame(1, $user->id, "Checking if the id is same");
        $this->assertSame('John', $user->firstname, "Checking if the id is same");
        $this->assertSame('johndoe@localhost', $user->email, "Checking if the id is same");
        $this->assertEmpty($user->email_verified_at);
    }
}