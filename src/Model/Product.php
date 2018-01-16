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
     * The phone no of the owner of the product.
     */
    protected $phone_no;

    /**
     * The id as stored in the database of the product.
     */
    protected $id;

    /**
     * Product constructor.
     *
     * @param $title
     * @param $price
     * @param $description
     */
    public function __construct($title = NULL, $price = NULL, $description = NULL, $phone_no = NULL)
    {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->phone_no = $phone_no;
    }

    /**
     * Adds the entry to the database;
     */
    public function add() {
        $stmt = DatabaseConnection::$connection->prepare("INSERT INTO products (title, price, description, phone_no) VALUES (:title, :price, :description, :phone_no)");
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':phone_no', $this->phone_no);

        return $stmt->execute();
    }

    /**
     * Gets all the products in the database.
     *
     * @return array
     */
    public static function getProducts() {
        $query = DatabaseConnection::$connection->query('SELECT * FROM products');

        if (!$query) {
          return [];
        }

        return $query->fetchAll();
    }

    public static function deleteProduct($title) {
        $query = "DELETE FROM products WHERE title =  :title";
        $stmt = DatabaseConnection::$connection->prepare($query);
        $stmt->bindParam(':title', $title);
        return $stmt->execute();
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

    /**
     * Sets the phone_no property of the entity.
     *
     * @param $description
     */
    public function setPhoneNo($phone_no) {
        $this->phone_no = $phone_no;
    }

    /**
     * Gets the phone_no property of the entity.
     *
     * @return mixed
     */
    public function getPhoneNo() {
        return $this->phone_no;
    }

}
