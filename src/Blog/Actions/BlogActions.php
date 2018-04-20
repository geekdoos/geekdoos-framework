<?php

namespace App\Blog\Actions;

use App\Framework\Renderer\RendererInterface;
use Framework\Actions\RouterAwareAction;
use Framework\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogActions
{

    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var \PDO
     */
    private $pdo;
    /**
     * @var Router
     */
    private $router;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, \PDO $pdo, Router $router)
    {
        $this->renderer = $renderer;
        $this->pdo = $pdo;
        $this->router = $router;
    }

    public function __invoke(Request $request)
    {
        if ($request->getAttribute('id')) {
            return $this->show($request);
        } else {
            return $this->index();
        }
    }
    
    public function index() : string
    {
        $posts = $this->pdo
            ->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 10')
            ->fetchAll();

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
        $query = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $query->execute([$id]);
        $post = $query->fetch();
        if($slug !== $post->slug){
            return $this->redirect('blog.show', [
                'slug' => $post->slug,
                'id' => $post->id,
            ]);
        }
        return $this->renderer->render('@blog/show', compact('post'));
    }
}
