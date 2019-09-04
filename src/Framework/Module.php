<?php

namespace Framework;


use Framework\Renderer\RendererInterface;
use Framework\WelcomeModule\ExampleAction;
use Hypario\Router;

class Module
{

    /**
     * Path to the definitions for the container
     * @var string
     */
    const DEFINITIONS = null;

    /**
     * Path to the migrations for Phinx (not implemented)
     * @var string
     */
    const MIGRATIONS = null;

    /**
     * Path to the seeds for Phinx (not implemented)
     */
    const SEEDS = null;

    /**
     * This is where you define all the routes and the view directory
     *
     * example :
     * $renderer->addPath('/views'));
     * $router->get('/', function() { return "Hello World !"; });
     */
    public function __construct()
    {
    }

}