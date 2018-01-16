<?php

namespace eSales\Controller;

use eSales\Model\Product;
use eSales\Model\User;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;

class ProductController {

    /**
     * @var Twig_Environment.
     */
    static $twig;

    public static function deleteAction($title) {
        self::setTwig();
        $result = Product::deleteProduct($title);

        session_start();
        $logged_in = [];

        if (isset($_SESSION['logged_in'])) {
            $logged_in = $_SESSION['logged_in'];
        }

        $data = [
            'logged_in' => $logged_in,
            'page' => 'delete-products',
            'result' => $result,
            'deleted_title' => $title
        ];

        return self::$twig->render('layout/base.html.twig', $data);
    }

    protected static function setTwig() {
        self::$twig = include_once __DIR__ . '/../../src/bootstrap.php';
    }

}
