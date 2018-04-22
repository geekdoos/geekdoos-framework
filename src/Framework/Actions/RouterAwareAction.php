<?php

namespace Framework\Actions;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Add some methods linked to usage of the router
 * Trait RouterAwareAction
 * @package Framework\Actions
 */
trait RouterAwareAction
{

    /**
     * Make a redirection response
     *
     * @param string $path
     * @param array $params
     * @return ResponseInterface
     */
    public function redirect(string $path, array $params) : ResponseInterface
    {

            $uri = $this->router->generateUri($path, $params);
            return (new Response())
                ->withStatus(301)
                ->withHeader('location', $uri);
    }
}
