<?php

use eSales\Controller\PageController;
use eSales\Controller\ProductController;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Route;

$routes = new Routing\RouteCollection();

$routes->add('home', new Route('/{page}',[
        'page' => NULL,
        '_controller' => [PageController::class, 'content']
    ]
));

return $routes;
