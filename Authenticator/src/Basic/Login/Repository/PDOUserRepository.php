<?php

namespace Basic\Login\Repository;

class PDOUserRepository implements UserRepository
{
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findByUsername($username)
    {
        // TODO: Implement findByUsername() method.
    }
}
