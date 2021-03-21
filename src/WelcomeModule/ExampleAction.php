<?php

namespace App\WelcomeModule;

use Framework\Actions\Action;
use Framework\Renderer\RendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExampleAction extends Action
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface|String
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface|String
    {
        return $this->renderer->render('@welcome/index');
    }
}
