<?php

namespace Basic\Login\Repository;

use Basic\Login\Entity\User;

class ArrayUserRepository implements UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users = [
            [
                'id' => rand(1000, 9999),
                'username' => 'john.doe',
                'password' => '$2y$10$R8E3yIfyjBrTXwq/c8F54e..sUHIx2THoZhvEg45ddC58eA2LnE46'
            ]
        ];
    }

    public function findByUsername($username)
    {
        foreach ($this->users as $entry) {
            if ($entry["username"] === $username) {
                $user = new User();
                $user->setId($entry["id"]);
                $user->setUsername($entry["username"]);
                $user->setPassword($entry["password"]);

                return $user;
            }
        }

        return false;
    }
}
