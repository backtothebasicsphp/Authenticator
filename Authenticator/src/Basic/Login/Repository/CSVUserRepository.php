<?php

namespace Basic\Login\Repository;

use Basic\Login\Entity\User;

class CSVUserRepository implements UserRepository
{
    private $csv;

    public function __construct($csv)
    {
        $this->csv = $csv;
    }

    public function findByUsername($username)
    {
        $record = $this->csv
            ->addFilter(function ($row, $index) {
                return $index > 0;
            })
            ->addFilter(function ($row) {
                return isset($row[0], $row[1], $row[2]); //we make sure the data are present
            })
            ->addFilter(function ($row) use ($username) {
                return $username === $row[1]; //the name is used less than 10 times
            })->fetchOne(0);

        if ($record === []) {
            return false;
        }

        $user = new User($record[1], $record[2], $record[0]);

        return $user;
    }
}
