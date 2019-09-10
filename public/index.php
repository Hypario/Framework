<?php

use App\WelcomeModule\WelcomeModule;
use Framework\App;
use Framework\Middlewares\{CsrfMiddleware,
    DispatcherMiddleware,
    MethodMiddleware,
    RouterMiddleware,
    NotFoundMiddleware};
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;
use Middlewares\Whoops;

define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';

$app = (new App(ROOT . '/config/config.php'))
    ->addModule(WelcomeModule::class);

$app
    ->pipe(Whoops::class)
    ->pipe(MethodMiddleware::class)
    ->pipe(CsrfMiddleware::class)
    ->pipe(RouterMiddleware::class)
    ->pipe(DispatcherMiddleware::class)
    ->pipe(NotFoundMiddleware::class);

if (php_sapi_name() !== 'cli') {
    $response = $app->handle(ServerRequest::fromGlobals());
    send($response);
}
