<?php

use App\Middleware\JsonBodyParserMiddleware;
use App\RequestValidators\CheckoutRequestValidator;
use App\Http\CheckoutController;
use DI\Bridge\Slim\Bridge;
use Slim\Factory\AppFactory;

$container = require __DIR__ . '/../config/bootstrap.php';

AppFactory::setContainer($container);

$app = Bridge::create($container);

$app->add(new JsonBodyParserMiddleware());
$app->post('/checkout/{id:[0-9]+}', CheckoutController::class)
    ->add(new CheckoutRequestValidator());


$app->run();
