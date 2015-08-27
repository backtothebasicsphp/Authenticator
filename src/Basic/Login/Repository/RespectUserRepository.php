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
        $this->mapper->disableEntityConstructor = true;
        $this->mapper->entityNamespace = '\\Basic\\Login\\Entity\\';
    }

    public function findByUsername($username)
    {
        $record = $this->mapper->user(["username" => $username])->fetch();

        if ($record->getUsername() !== $username) {
            return false;
        }

        return $record;
    }
}
