<?php

namespace Framework;


use Framework\WelcomeModule\ExampleAction;

class Module
{

    /**
     * Path to the definitions for the container
     * @var string
     */
    protected const DEFINITIONS = null;

    /**
     * Path to the migrations for Phinx (not implemented)
     * @var string
     */
    protected const MIGRATIONS = null;

    /**
     * Path to the seeds for Phinx (not implemented)
     */
    protected const SEEDS = null;

    /**
     * The constructor is where you define all the routes and the view directory
     *
     * example :
     * $renderer->addPath('/views'));
     * $router->get('/', function() { return "Hello World !"; });
     */

}
