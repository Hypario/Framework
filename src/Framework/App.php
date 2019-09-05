<?php

namespace Framework;

use Framework\Middlewares\CombinedMiddleware;
use Framework\Middlewares\RoutePrefixedMiddleware;
use Hypario\Builder;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{

    private $definitions;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Array of modules
     * @var string[]
     */
    private $modules = [];

    /**
     * Array of middlewares
     * @var MiddlewareInterface[]
     */
    private $middlewares = [];

    public function __construct(string $definitions)
    {
        $this->definitions = $definitions;
    }

    public function addModule(string $module): self
    {
        $this->modules[] = $module;
        return $this;
    }

    public function pipe(string $middleware, string $routePrefix = null): self
    {
        if (is_null($routePrefix)) {
            $this->middlewares[] = $middleware;
        } else {
            $this->middlewares[] = new RoutePrefixedMiddleware($this->getContainer(), $routePrefix, $middleware);
        }
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

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // instantiate all the modules
        foreach($this->modules as $module) {
            $this->getContainer()->get($module);
        }

        $middleware = new CombinedMiddleware($this->getContainer(), $this->middlewares);
        return $middleware->process($request, $this);
    }
}
