<?php

namespace Basic\Login\Repository;

use Basic\Login\Entity\User;

class PDOUserRepository implements UserRepository
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $record = $stmt->fetch();

        if ($record["username"] !== $username) {
            return false;
        }

        $user = new User();
        $user->setId($record["id"]);
        $user->setUsername($record["username"]);
        $user->setPassword($record["password"]);

        return $user;
    }
}
