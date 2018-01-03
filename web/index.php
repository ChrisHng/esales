<?php

// Manage class autoloading.
require_once __DIR__ . '/../vendor/autoload.php';

use eSales\Model\DatabaseConnection;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    // Connect to the database;
    DatabaseConnection::connect();

    // Get the controller and the arguments.
    $controller = $controllerResolver->getController($request);
    $argument = $argumentResolver->getArguments($request, $controller);
    $response = new Response();

    // Call the asigned controller with the afferent arguments;
    $output = call_user_func_array($controller, $argument);
    $response->setContent($output);

    // Close the connection to the database;
    DatabaseConnection::closeConnection();

} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();
