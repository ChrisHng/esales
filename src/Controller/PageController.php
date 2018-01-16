<?php

namespace eSales\Controller;

use eSales\Model\Product;
use eSales\Model\User;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;

class PageController {

    /**
     * @var Twig_Environment.
     */
    static $twig;

    public static function content($page, Request $request) {
        self::setTwig();

        session_start();
        $logged_in = [];

        if (isset($_SESSION['logged_in'])) {
            $logged_in = $_SESSION['logged_in'];
        }

        switch ($page) {
            case '':
                $data = [
                    'logged_in' => $logged_in,
                    'page' => 'home'
                ];
                return self::$twig->render('layout/base.html.twig', $data);

            case 'products':
                $products = Product::getProducts();
                $data = [
                    'logged_in' => $logged_in,
                    'page' => 'products',
                    'products' => $products
                ];

                return self::$twig->render('layout/base.html.twig', $data);

            case 'login':
                $logged_in = self::connect_user($request);
                $data = [
                    'logged_in' => $logged_in,
                    'page' => 'login'
                ];
                return self::$twig->render('layout/base.html.twig', $data);

            case 'register':
                $result = self::register_user($request);
                $data = [
                    'page' => 'register',
                    'result' => $result,
                ];
                return self::$twig->render('layout/base.html.twig', $data);

            case 'logout':
                $data = [
                    'logged_in' => false,
                    'page' => 'logout'
                ];

                self::logOut();
                return self::$twig->render('layout/base.html.twig', $data);
            
            case 'add-product':
                $result = self::addProduct($request);
                $data = [
                    'logged_in' => $logged_in,
                    'page' => 'add-product',
                    'result' => $result
                ];
                return self::$twig->render('layout/base.html.twig', $data);
            case 'delete-products':
                $products = Product::getProducts();
                $data = [
                    'logged_in' => $logged_in,
                    'page' => 'delete-products',
                    'products' => $products
                ];
                return self::$twig->render('layout/base.html.twig', $data);
        }

        return [];
    }

    protected static function connect_user(Request $request) {
        $username = $request->get('username');
        $password = $request->get('password');

        if(isset($username) && isset($password)) {

            if (User::checkLogin($username, $password)) {
                $_SESSION['logged_in'] = $username;
                return true;
            }
        }

        return false;
    }

    protected static function register_user(Request $request) {
        $username = $request->get('username');
        $password = $request->get('password');
        $passwordRepeat = $request->get('password_repeat');

        $result = [];

        if(isset($username) && isset($password) && isset($passwordRepeat)) {
            if($password != $passwordRepeat) {
                $result['type'] = 'error';
                $result['text'] = "The passwords do not match";
            }
            else {
                $user = new User($username, $password);
                $user->add();

                self::connect_user($request);

                $result['type'] = 'success';
                $result['text'] = "You have been successfully registered!";
            }
        }

        return $result;
    }
    
    public static function addProduct(Request $request) {
        $title = $request->get('title');
        $description = $request->get('description');
        $price = $request->get('price');
        $phone = $request->get('phone');

        if ($title && $description && $price && $phone) {
            $product = new Product($title, $price, $description, $phone);
            return $product->add();
        }

        return false;
    }

    public static function logOut() {
        unset($_SESSION['logged_in']);
        session_destroy();
    }

    protected static function setTwig() {
        self::$twig = include_once __DIR__ . '/../../src/bootstrap.php';
    }

}
