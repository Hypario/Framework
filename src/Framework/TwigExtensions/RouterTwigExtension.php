<?php

namespace Framework\TwigExtensions;

use Hypario\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RouterTwigExtension extends AbstractExtension
{

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('path', [$this, 'pathFor']),
            new TwigFunction('is_subpath', [$this, 'is_subpath'])
        ];
    }

    public function pathFor(string $name, array $params = [], array $queryParams = [])
    {
        return $this->router->getPath($name, $params, $queryParams);
    }

}
