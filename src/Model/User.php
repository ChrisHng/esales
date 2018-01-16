<?php

namespace eSales\Model;

/**
 * Class Product
 *
 * @package eSales\Model.
 */
class User {

    /**
     * The user of the user account.
     */
    protected $username;

    /**
     * The password of the user account.
     */
    protected $pwd;

    /**
     * The property of an user to be admin.
     */
    protected $isAdmin;

    /**
     * User constructor.
     *
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->pwd = $password;
    }

    /**
     * Adds the entry to the database;
     */
    public function add() {
        $stmt = DatabaseConnection::$connection->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->pwd);

        $stmt->execute();
    }

    /**
     * Gets all the products in the database.
     *
     * @return array
     */
    public static function checkLogin($username, $password) {
        $query = DatabaseConnection::$connection->prepare('SELECT * FROM users WHERE username = :username AND password = :password');

        $query->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        $result = $query->fetchAll();

        return !empty($result);
    }
}
