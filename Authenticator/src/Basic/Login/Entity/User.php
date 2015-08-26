<?php

namespace Basic\Login\Entity;

class User
{
    private $id;
    private $username;
    private $password;

    public function __construct($username, $password, $id = null)
    {
        $this->id       = $id;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}
