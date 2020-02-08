<?php

use Framework\Database\DatabaseFactory;
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

    PDO::class => factory(DatabaseFactory::class),

];
