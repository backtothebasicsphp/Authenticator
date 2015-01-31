<?php

namespace Basic\Login\Repository;

use Basic\Login\Entity\User;
use Respect\Relational\Mapper;

class RespectUserRepository implements UserRepository
{
    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function findByUsername($username)
    {
        $record = $this->mapper->users(["username" => $username])->fetch();

        if ($record->username !== $username) {
            return false;
        }

        $user = new User();
        $user->setId($record->id);
        $user->setUsername($record->username);
        $user->setPassword($record->password);

        return $user;
    }
}
