<?php

namespace Tests\Framework;

use Framework\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function testGetMethod()
    {
        $request = new ServerRequest("GET", "/blog");
        $this->router->get('/blog', function () { return "hello"; }, "blog");
        $route = $this->router->match($request);
        $this->assertEquals("blog", $route->getName());
        $this->assertEquals("hello", call_user_func_array($route->getCallBack(), [$request]));
    }

    public function testGetMethodIfUrlDosNotExiste()
    {
        $request = new ServerRequest("GET", "/blog");
        $this->router->get('/blogez', function () { return "hello"; }, "blog");
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }

    public function testGetMethodWithSlugAndId()
    {
        $request = new ServerRequest("GET", "/blog/mon-slug-8");
        $this->router->get('/blog', function (){ return "post list"; }, "posts");
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function (){ return "hello"; }, "post.show");
        $route = $this->router->match($request);
        $this->assertEquals("post.show", $route->getName());
        $this->assertEquals("hello", call_user_func_array($route->getCallBack(), [$request]));
        $this->assertEquals(["slug" => "mon-slug", "id" => "8"], $route->getParams());

        //Test invalid URI
        $route = $this->router->match(new ServerRequest("GET", "blog/mon_slug-8"));
        $this->assertEquals(null, $route);
    }

    public function testGenerateUri()
    {
        $this->router->get('/blog', function (){ return "post list"; }, "posts");
        $this->router->get('/blog/{slug:[a-z0-9\-]+}-{id:\d+}', function (){ return "hello"; }, "post.show");
        $uri = $this->router->generateUri('post.show', ['slug' => 'mon-article', 'id' => 18]);
        $this->assertEquals('/blog/mon-article-18', $uri);
    }
}
