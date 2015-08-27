<?php

require_once "bootstrap.php";

$container["user_repository"] = function ($c) {
    return $c["csv_user_repository"];
};

var_dump($container["authenticator"]->authenticate("john.doe", 'pa$$w0rd'));