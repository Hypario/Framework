<?php

namespace App\WelcomeModule;

use Framework\Module;
use Framework\Renderer\RendererInterface;
use Hypario\Router;

class WelcomeModule extends Module
{

    /**
     * WelcomeModule constructor.
     * @param Router $router
     * @param RendererInterface $renderer
     */
    public function __construct(Router $router, RendererInterface $renderer)
    {
        $renderer->addPath(ROOT . '/src/WelcomeModule/views', 'welcome');
        $router->get('/', ExampleAction::class);
    }
}
