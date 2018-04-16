<?php

namespace App\Blog\Actions;

use App\Framework\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class BlogActions{

    /**
     * @var RendererInterface
     */
    private $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(Request $request)
    {
        $slug = $request->getAttribute('slug');
        if ($slug){
            return $this->show($slug);
        }else{
            return $this->index();
        }

    }
    
    public function index() : string
    {
        return $this->renderer->render('@blog/index');
    }

    public function show(string $slug) : string
    {
        return $this->renderer->render('@blog/show', ['slug' => $slug]);
    }
}