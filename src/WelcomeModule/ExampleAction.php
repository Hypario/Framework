<?php

namespace App\WelcomeModule;

use Framework\Action;
use Framework\Renderer\RendererInterface;
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
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request)
    {
        return $this->renderer->render('@welcome/index');
    }

    /**
     * @inheritDoc
     */
    public function getParams(ServerRequestInterface $request): array
    {
        return [];
    }
}
