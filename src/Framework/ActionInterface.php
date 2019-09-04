<?php

namespace Framework;

use Psr\Http\Message\ServerRequestInterface;

interface ActionInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request);

}