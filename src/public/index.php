<?php

use App\Http\CheckoutController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$config = [
    'db_host' => 'localhost:6432',
    'db_login' => 'postgres',
    'db_password' => 'postgres',
    'db_database' => 'checkout',
];

$app->get('/checkout', function (Request $request, Response $response, $args) use($config){
    $checkoutController = new CheckoutController($config);
    $body = $checkoutController->checkout();
    switch ($body) {
        case "ok":
            $response
                ->withStatus(200);
            break;
        default:
            $response
                ->withStatus(400);
            break;
    }
    return $response;
});

$app->run();