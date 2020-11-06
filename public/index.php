<?php

use App\WelcomeModule\WelcomeModule;
use Framework\App;
use Framework\Middlewares\{CsrfMiddleware,
    DispatcherMiddleware,
    ExceptionHandlerMiddleware,
    MethodMiddleware,
    RouterMiddleware,
    NotFoundMiddleware};
use Franzl\Middleware\Whoops\WhoopsMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;

define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';

$app = new App(ROOT . '/config/config.php');

$app->addModule(WelcomeModule::class);

$app
    ->pipe(
        $app->getContainer()->get('env') === 'dev' ?
            WhoopsMiddleware::class :
            ExceptionHandlerMiddleware::class
    )
    ->pipe(MethodMiddleware::class)
    ->pipe(CsrfMiddleware::class)
    ->pipe(RouterMiddleware::class)
    ->pipe(DispatcherMiddleware::class)
    ->pipe(NotFoundMiddleware::class);

require ROOT . '/config/errors.php';
foreach ($app->getModules() as $module) {
    if ($module::ERRORS) require $module::ERRORS;
}

if (php_sapi_name() !== 'cli') {
    $response = $app->handle(ServerRequest::fromGlobals());
    send($response);
}
