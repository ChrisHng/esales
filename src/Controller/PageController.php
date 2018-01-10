<?php

namespace eSales\Controller;

use eSales\Model\Product;
use eSales\Model\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;

class PageController {

    /**
     * @var Twig_Environment.
     */
    static $twig;

    public static function content($page, Request $request) {
        self::setTwig();

        switch ($page) {
            case '':
                $output = self::$twig->render('layout/base.html.twig', ['page' => 'home']);
                break;
            case 'products':
                $products = Product::getProducts();
                $output = self::$twig->render('layout/base.html.twig', ['page' => 'products', 'products' => $products]);
                break;
            case 'login':
                self::connect_user($request);
                return self::$twig->render('layout/base.html.twig', ['page' => 'login']);

            default:
                $output = [];
        }

        return $output;
    }

    protected static function connect_user(Request $request) {
        $username = $request->get('username');
        $password = $request->get('password');

        if (User::checkLogin($username, $password)) {
            $session = new Session();
            $session->start();
            $session->set('user', $username);
        }
    }

    protected static function setTwig() {
        self::$twig = include_once __DIR__ . '/../../src/bootstrap.php';
    }
}
