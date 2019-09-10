<?php

namespace App\WelcomeModule;

use Framework\ActionInterface;
use Framework\Renderer\RendererInterface;
use Framework\Session\FlashService;
use Psr\Http\Message\ServerRequestInterface;

class ExampleAction implements ActionInterface
{

    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var FlashService
     */
    private $flash;

    public function __construct(FlashService $flash, RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->flash = $flash;
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
