<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\Route;

$routes = new Routing\RouteCollection();

$routes->add('home', new Route('/'));
$routes->add('bye', new Route('/bye'));
