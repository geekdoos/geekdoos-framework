<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 23/02/2018
 * Time: 10:53
 */

namespace Tests\Modules;

use App\Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class BlogModuleTest extends TestCase
{
    public function testIndex()
    {
        $app = new App([
            BlogModule::class
        ]);
        $request = new ServerRequest("GET", "/blog");
        $response = $app->run($request);
        $this->assertEquals("<h1>Welcome to the blog page</h1>", (string) $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testShow()
    {
        $app = new App([
            BlogModule::class
        ]);
        $request = new ServerRequest("GET", "/blog/mon-article-test");
        $response = $app->run($request);
        $this->assertEquals("<h1>Welcome on the article : mon-article-test</h1>", $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
}
