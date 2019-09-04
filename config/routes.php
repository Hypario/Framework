<?php

use Framework\ExampleAction;
use Hypario\Router;

$router = $app->getContainer()->get(Router::class);
$router->get('/', ExampleAction::class);