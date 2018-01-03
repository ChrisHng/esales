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
    public function __construct($title = NULL, $price = NULL, $description = NULL)
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


    /**
     * Sets the title property of the entity.
     *
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Gets the title property of the entity.
     *
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Sets the price property of the entity.
     *
     * @param $price
     */
    public function setPrice($price) {
        $this->price = $price;
    }

    /**
     * Gets the price property of the entity.
     *
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Sets the description property of the entity.
     *
     * @param $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Gets the description property of the entity.
     *
     * @return mixed
     */
    public function getDescription() {
        return $this->description;
    }
}

