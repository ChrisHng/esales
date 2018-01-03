<?php

namespace eSales\Controller;

use eSales\Model\Product;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Tests\Controller;

class ProductController {
    public static function register(Request $request) {
        $product = new Product();
    }
}
