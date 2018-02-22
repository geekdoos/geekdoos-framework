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
    private $modules = [];
    /**
     * App constructor.
     * @param array $modules
     */
    public function __construct(array $modules)
    {
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = new $module();
            }
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();

        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader("Location", substr($uri, 0, -1));
        }

        if ($uri == "/blog") {
            return new Response(200, [], "<h1>Welcome to the blog page</h1>");
        }

        if ($uri == "/news") {
            return new Response(200, [], "<h1>Welcome to the news page</h1>");
        }

        return new Response(404, [], "<h1>Error 404</h1>");
    }
}
