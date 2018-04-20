<?php

namespace App\Blog;

use App\Framework\Module;
use App\Framework\Renderer\RendererInterface;
use App\Blog\Actions\BlogActions;
use Framework\Router;

class BlogModule extends Module
{
    const DEFINITIONS = __DIR__.'/config.php';

    const MIGRATIONS = __DIR__.'/Database/migrations';

    const SEEDS = __DIR__.'/Database/seeds';

    /**
     * @var RendererInterface
     */
    private $renderer;

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addPath('blog', __DIR__ . '/views');
        $router->get($prefix, BlogActions::class, 'blog.index');
        $router->get($prefix.'/{slug:[a-z0-9\-]+}-{id:[0-9]+}', BlogActions::class, 'blog.show');
    }
}
