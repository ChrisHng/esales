<?php

namespace eSales\Controller;

use eSales\Model\Product;
use Twig_Environment;

class PageController {

    /**
     * @var Twig_Environment.
     */
    static $twig;

    public static function content($page) {
        self::setTwig();

        switch ($page) {
            case '':
                $output = self::$twig->render('layout/base.html.twig', ['page' => 'home']);
                break;
            case 'products':
                $products = Product::getProducts();
                $output = self::$twig->render('layout/base.html.twig', ['page' => 'products', 'products' => $products]);
                break;

            default:
                $output = [];
        }

        return $output;
    }

    protected static function setTwig() {
        self::$twig = include_once __DIR__ . '/../../src/bootstrap.php';
    }
}
