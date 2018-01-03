<?php

namespace eSales\Model;

use PDO;
use PDOException;

class DatabaseConnection {

    /**
     * @var PDO;
     */
    public static $connection;

    // Connects to the database.
    public static function connect() {
        try {
            self::$connection = new PDO('mysql:host=mariadb;dbname=esales;port=3306;charset=utf8mb4', 'root', 'root');

        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    // Close the connection to the database;
    public static function closeConnection() {
        self::$connection = NULL;
    }
}
