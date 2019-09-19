<?php

use Framework\Middlewares\CsrfMiddleware;
use Framework\Renderer\{RendererInterface, TwigRendererFactory};
use Framework\Session\{PHPSession, SessionInterface};
use Framework\TwigExtensions\RouterTwigExtension;
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
    'database.name' => 'root',
    'database.schema' => 'Framework',

    'twig.extensions' => [
        RouterTwigExtension::class
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    SessionInterface::class => PHPSession::class,
    CsrfMiddleware::class => object()->constructor(SessionInterface::class),

    PDO::class => function (ContainerInterface $c) {
        $pdo = new PDO("pgsql:host={$c->get('database.host')};dbname={$c->get('database.name')};options='--client_encoding=UTF8'",
            $c->get('database.username'),
            $c->get('database.password'),
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        $pdo->exec("SET search_path TO {$c->get('database.schema')}");
        return $pdo;
    },

];
