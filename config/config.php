<?php

use Framework\Middlewares\CsrfMiddleware;
use Framework\Renderer\{PHPRenderer, RendererInterface, TwigRendererFactory};
use Framework\Session\PHPSession;
use Framework\Session\SessionInterface;

return [

    'env' => 'dev',
    'views.path' => ROOT . '/views',

    RendererInterface::class => \Hypario\factory(TwigRendererFactory::class),

    SessionInterface::class => PHPSession::class,
    CsrfMiddleware::class => hypario\object()->constructor(SessionInterface::class)

];
