<?php

require_once"vendor/autoload.php";

use Pimple\Container;
use Basic\Login\Repository\ArrayUserRepository;
use Basic\Login\Authenticator;

$container = new Container();

$container["user_repository"] = function ($c) {
    return new ArrayUserRepository();
};

$container["authenticator"] = function ($c) {
    return new Authenticator($c["user_repository"]);
};

var_dump($container["authenticator"]->authenticate("john.doe", 'pa$$w0rd'));