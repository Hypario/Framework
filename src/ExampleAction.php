<?php

namespace Framework;

use Psr\Http\Message\ServerRequestInterface;

class ExampleAction implements ActionInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request)
    {
        return "it's a new project ! \o/";
    }
}