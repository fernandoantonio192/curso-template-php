<?php

namespace app\framework\database;

use PDO;

class Connection {

  private static $connection = null;

  public static function getConnection() {

    if (empty(self::$connection)) {
      self::$connection = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",$_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ]);
    }

    return self::$connection;

  }

}