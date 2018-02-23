<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 23/02/2018
 * Time: 09:45
 */

namespace Framework;

use Framework\Router\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Class Router
 * @package Framework
 */
class Router
{
    /**
     * @var FastRouteRouter
     */
    private $router;

    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * @param string $uri
     * @param callable $callback
     * @param string $name
     */
    public function get(string $uri, callable $callback, string $name)
    {
        $this->router->addRoute(new ZendRoute($uri, $callback, ["GET"], $name));
    }

    /**
     * This method is designed to take any HTTP Method (GET, POST, PUT, DELETE, ...)
     *
     * 
     * @param string $method
     * @param string $uri
     * @param callable $callback
     * @param string $name
     */
    public function any(string $method, string $uri, callable $callback, string $name)
    {
        $this->router->addRoute(new ZendRoute($uri, $callback, [strtoupper($method)], $name));
    }

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request) : ?Route
    {
        $zendRouteResult = $this->router->match($request);
        if($zendRouteResult->isSuccess()){
            return new Route(
                $zendRouteResult->getMatchedRouteName(),
                $zendRouteResult->getMatchedMiddleware(),
                $zendRouteResult->getMatchedParams()
            );
        }
        return null;
    }

    /**
     * Get the generated URI
     * @param string $name Route name
     * @param array $params Route params
     * @return string|null the generated URI
     */
    public function generateUri(string $name, array $params) : ?string
    {
        return $this->router->generateUri($name, $params);
    }

}
