<?php

//PDO connection to MYSQL db

$host = "localhost"; // localhost or IP
$db = "coffea";
$user = "root";
$pass = "Han102002";
$charset = "utf8mb4"; // character set for the db connection

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // data source name for PDO connection
$options = [
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, // throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC, // fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES      => false, //disable emulation of prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo 'connected!';
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>