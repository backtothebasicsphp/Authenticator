<?php

require_once "bootstrap.php";

$container["user_repository"] = function ($c) {
    return $c["respect_user_repository"];
};

var_dump($container["authenticator"]->authenticate("john.doe", 'pa$$w0rd'));