<?php

use Framework\Middlewares\CsrfMiddleware;
use Framework\Renderer\{
    PHPRenderer,
    RendererInterface
};
use Framework\Session\PHPSession;
use Framework\Session\SessionInterface;

return [

    RendererInterface::class => function () {
        return new PHPRenderer(ROOT . '/views');
    },

    SessionInterface::class => PHPSession::class,
    CsrfMiddleware::class => hypario\object()->constructor(SessionInterface::class)

];
