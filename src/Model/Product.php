<?php

namespace eSales\Model;

/**
 * Class Product
 *
 * @package eSales\Model.
 */
class Product {

    /**
     * The title of the product.
     */
    protected $title;

    /**
     * The price of the product.
     */
    protected $price;

    /**
     * The description of the product.
     */
    protected $description;

    /**
     * Product constructor.
     *
     * @param $title
     * @param $price
     * @param $description
     */
    public function __construct($title, $price, $description)
    {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
    }

    /**
     * Adds the entry to the database;
     */
    public function add() {
        $stmt = DatabaseConnection::$connection->prepare("INSERT INTO products (title, price, description) VALUES (:title, :price, :description)");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);

        $stmt->execute();
    }

    /**
     * Gets all the products in the database.
     *
     * @return array
     */
    public static function getProducts() {
        $query = DatabaseConnection::$connection->query('SELECT * FROM products');

        return $query->fetchAll();
    }
}

