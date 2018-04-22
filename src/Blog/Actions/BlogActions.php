<?php

namespace App\Blog\Actions;

use App\Blog\Tables\PostTable;
use App\Framework\Renderer\RendererInterface;
use Framework\Actions\RouterAwareAction;
use Framework\Router;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogActions
{
    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var Router
     */
    private $router;
    /**
     * @var PostTable
     */
    private $postTable;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, PostTable $postTable)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->postTable = $postTable;
    }

    public function __invoke(Request $request)
    {
        if ($request->getAttribute('id')) {
            return $this->show($request);
        }

        return $this->index($request);
    }
    
    public function index(Request $request) : string
    {
        $params = $request->getQueryParams();
        $posts = $this->postTable->findPaginated(12, $params['p'] ?? 1);

        return $this->renderer->render('@blog/index', compact('posts'));
    }

    /**
     * Show one article by his slug and id
     * @param Request $request
     * @return \GuzzleHttp\Psr7\MessageTrait|string|static
     */
    public function show(Request $request)
    {
        $id = $request->getAttribute('id');
        $slug = $request->getAttribute('slug');
        $post = $this->postTable->findById($id);

        if ($slug !== $post->slug) {
            return $this->redirect('blog.show', [
                'slug' => $post->slug,
                'id' => $post->id,
            ]);
        }

        return $this->renderer->render('@blog/show', compact('post'));
    }
}
