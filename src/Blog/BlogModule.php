<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 23/02/2018
 * Time: 10:40
 */

namespace App\Blog;

use App\Framework\Renderer;
use Framework\Router;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogModule
{

    /**
     * @var Renderer
     */
    private $renderer;

    public function __construct(Router $router, Renderer $renderer)
    {
        $this->renderer = $renderer;
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $router->get('/blog', [$this, 'index'], 'blog.index');
        $router->get('/blog/{slug:[a-z0-9\-]+}', [$this, 'show'], 'blog.show');
    }

    public function index(Request $request) : string
    {
        return $this->renderer->render('@blog/index');
    }

    public function show(Request $request) : string
    {
        return $this->renderer->render('@blog/show', ['slug' => $request->getAttribute('slug')]);
    }
}
