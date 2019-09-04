<?php

use Framework\Renderer\{
    PHPRenderer,
    RendererInterface
};

return [

    RendererInterface::class => function () {
        return new PHPRenderer(ROOT . '/views');
    }

];