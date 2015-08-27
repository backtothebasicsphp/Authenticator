<?php

namespace Basic\Login\Repository;

use Basic\Login\Entity\User;
use \Pdo;

class PDOUserRepository implements UserRepository
{
    private $db;

    public function __construct(Pdo $db)
    {
        $this->db = $db;
    }

    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->setFetchMode(Pdo::FETCH_CLASS|Pdo::FETCH_PROPS_LATE, '\\Basic\\Login\\Entity\\User', ['', '']);
        $stmt->execute();

        $record = $stmt->fetch();

        if ($record->getUsername() !== $username) {
            return false;
        }

        return $record;
    }
}
