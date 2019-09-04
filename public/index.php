<?php

use Framework\App;
use Framework\Middlewares\DispatcherMiddleware;
use Framework\Middlewares\RouterMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;
use Framework\Middlewares\NotFoundMiddleware;

define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';

$app = new App(ROOT . '/config/config.php');

require ROOT . '/config/routes.php';

$app
    ->pipe(RouterMiddleware::class)
    ->pipe(DispatcherMiddleware::class)
    ->pipe(NotFoundMiddleware::class);

if (php_sapi_name() !== 'cli') {
    $response = $app->handle(ServerRequest::fromGlobals());
    send($response);
}