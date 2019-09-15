<?php

namespace App\WelcomeModule;

use Framework\ActionInterface;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExampleAction implements ActionInterface
{

    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var \PDO
     */
    private $PDO;

    public function __construct(RendererInterface $renderer, \PDO $PDO)
    {
        $this->renderer = $renderer;
        $this->PDO = $PDO;
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request)
    {
        return $this->renderer->render('@welcome/index');
    }
}
