<?php

namespace eSales;

use eSales\Model\Product;
use Twig_Environment;

class PageController {

    /**
     * @var Twig_Environment.
     */
    static $twig;

    public static function content($page) {
        self::setTwig();

        switch ($page[0]) {
            case '':
                $output = self::$twig->render('layout/base.html.twig', ['page' => 'home']);
                break;
            case 'products':
                $output = self::$twig->render('layout/base.html.twig', ['page' => 'products', 'products' => Product::getProducts()]);
                break;

            default:
                $output = [];
        }

        return $output;
    }

    protected static function setTwig() {
        self::$twig = include_once __DIR__.'/../src/bootstrap.php';
    }
}
