<?php

namespace Framework\Actions;

use App\Framework\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Rajoute des méthodes liée à l'utilisation du Router
 *
 * Trait RouterAwareAction
 * @package Framework\Actions
 */
trait RouterAwareAction
{

    /**
     * Renvoie une réponse de redirection
     *
     * @param string $name name of the route
     * @param array $params
     * @return ResponseInterface
     */
    public function redirect(string $name, array $params = []): ResponseInterface
    {
        $redirectUri = $this->router->getPath($name, $params);
        return new RedirectResponse($redirectUri);
    }
}
