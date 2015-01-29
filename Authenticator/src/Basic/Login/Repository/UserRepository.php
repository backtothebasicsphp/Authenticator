<?php

namespace Basic\Login\Repository;

interface UserRepository
{
    public function findByUsername($username);
}