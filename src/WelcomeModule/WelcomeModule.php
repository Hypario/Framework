<?php

namespace App\WelcomeModule;

use Framework\Module;
use Hypario\Router;

class WelcomeModule extends Module
{

    /**
     * WelcomeModule constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $router->get('/', ExampleAction::class);
    }
}