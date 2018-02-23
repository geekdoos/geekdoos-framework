<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 22/02/2018
 * Time: 11:06
 */

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    /**
     * @var array List of modules
     */
    private $modules = [];

    /**
     * @var Router
     */
    private $router;
    /**
     * App constructor.
     * @param array $modules
     */
    public function __construct(array $modules = [])
    {
        $this->router = new Router();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = new $module($this->router);
            }
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \Exception
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();

        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader("Location", substr($uri, 0, -1));
        }
        $route = $this->router->match($request);
        if (is_null($route)) {
            return new Response(404, [], "<h1>Error 404</h1>");
        }
        $params = $route->getParams();
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);
        $response = call_user_func_array($route->getCallback(), [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("This response in not a string nor a instance of Response Interface");
        }
    }
}
