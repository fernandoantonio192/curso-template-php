<?php

use app\framework\database\Connection;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

$connection = Connection::getConnection();
$query = $connection->query("SELECT * FROM tb_users");
var_dump($query->fetchAll()); die();

routerExecute();