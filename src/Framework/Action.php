<?php

namespace Framework;

use Framework\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Action
{

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface|string
     */
    public abstract function __invoke(ServerRequestInterface $request);

    /**
     * Filter the parameters passed
     * @param ServerRequestInterface $request
     * @return array
     */
    public abstract function getParams(ServerRequestInterface $request): array;

    /**
     * return the validator with the given rules
     * @param ServerRequestInterface $request
     * @return Validator
     */
    protected function getValidator(ServerRequestInterface $request): Validator
    {
        return new Validator($this->getParams($request));
    }

}
