<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Pimple\Container;
use Basic\Login\Repository\ArrayUserRepository;
use Basic\Login\Authenticator;
use PHPFluent\ArrayStorage\Storage;
use Basic\Login\Repository\PDOUserRepository;
use Respect\Relational\Mapper;
use Basic\Login\Repository\RespectUserRepository;
use Basic\Login\Repository\CSVUserRepository;
use League\Csv\Reader;

$container = new Container();

$container["array_storage"] = function($c) {
    $storage = new Storage();
    $storage->users->insert([
        'username' => 'john.doe',
        'password' => '$2y$10$R8E3yIfyjBrTXwq/c8F54e..sUHIx2THoZhvEg45ddC58eA2LnE46'
    ]);

    return $storage;
};

$container["sqlite_storage"] = function ($c) use ($argv) {
    $argvFile = strrchr($argv[0], '/');
    $tableName = $argvFile == '/respect_authenticator.php' ? 'user' : 'users';

    $db = new \PDO('sqlite::memory:');
    $db->exec("
        CREATE TABLE {$tableName} (
            id INTEGER PRIMARY KEY,
            username TEXT,
            password TEXT
        )
    ");

    $insert = "
        INSERT INTO {$tableName} (username, password)
        VALUES ('john.doe', '$2y$10\$R8E3yIfyjBrTXwq/c8F54e..sUHIx2THoZhvEg45ddC58eA2LnE46')
    ";

    $stmt = $db->prepare($insert);
    $stmt->execute();

    return $db;
};

$container["csv_storage"] = function($c) {
    $csv = Reader::createFromPath(new \SplFileObject(__DIR__ . '/data/users.csv'));
    $csv->setDelimiter(';');

    return $csv;
};

$container["array_user_repository"] = function ($c) {
    return new ArrayUserRepository($c["array_storage"]);
};

$container["pdo_user_repository"] = function ($c) {
    return new PDOUserRepository($c["sqlite_storage"]);
};

$container["respect_user_repository"] = function ($c) {
    return new RespectUserRepository(new Mapper($c["sqlite_storage"]));
};

$container["csv_user_repository"] = function ($c) {
    return new CSVUserRepository($c["csv_storage"]);
};

$container["authenticator"] = function ($c) {
    return new Authenticator($c["user_repository"]);
};

return $container;
