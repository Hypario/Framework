<?php

use Framework\Middlewares\CsrfMiddleware;
use Framework\Renderer\{RendererInterface, TwigRendererFactory};
use Framework\Session\{PHPSession, SessionInterface};
use Psr\Container\ContainerInterface;

use function Hypario\{
    factory, object
};

return [

    'env' => 'dev',
    'views.path' => ROOT . '/views',

    'database.host' => 'localhost',
    'database.username' => 'root',
    'database.password' => 'root',
    'database.name' => 'framework',

    RendererInterface::class => factory(TwigRendererFactory::class),

    SessionInterface::class => PHPSession::class,
    CsrfMiddleware::class => object()->constructor(SessionInterface::class),

    PDO::class => function (ContainerInterface $c) {
        return new PDO("mysql:host={$c->get('database.host')};dbname={$c->get('database.name')};charset=utf-8",
            $c->get('database.username'),
            $c->get('database.password')
        );
    }

];
