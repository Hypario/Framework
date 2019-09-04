<?php

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Hypario\Builder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{

    private $definitions;

    private $container;

    /**
     * Array of middlewares
     * @var MiddlewareInterface[]
     */
    private $middlewares = [];

    /**
     * @var int
     */
    private $index = 0;

    public function __construct(string $definitions)
    {
        $this->definitions = $definitions;
    }

    public function pipe(string $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function getContainer(): ContainerInterface {
        if (is_null($this->container)) {
            $builder = new Builder();
            $builder->addDefinitions($this->definitions);
            $this->container = $builder->build();
        }
        return $this->container;
    }

    private function getMiddleware(): MiddlewareInterface
    {
        $middleware = $this->container->get($this->middlewares[$this->index]);
        ++$this->index;

        return $middleware;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = $this->getMiddleware();
        return $middleware->process($request, $this);
    }
}