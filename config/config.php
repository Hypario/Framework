<?php

use App\Framework\Cookies\Cookie;
use App\Framework\Cookies\CookieInterface;
use Framework\Database\DatabaseFactory;
use Framework\Middlewares\CsrfMiddleware;
use Framework\Renderer\{RendererInterface, TwigRendererFactory};
use Framework\Session\{PHPSession, SessionInterface};
use Framework\TwigExtensions\{FlashExtension, ModuleExtension, RouterTwigExtension, FormExtension};

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
        RouterTwigExtension::class,
        FlashExtension::class,
        FormExtension::class,
        ModuleExtension::class
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    SessionInterface::class => PHPSession::class,
    CookieInterface::class => Cookie::class,
    CsrfMiddleware::class => object()->constructor(SessionInterface::class),

    PDO::class => factory(DatabaseFactory::class),

];
