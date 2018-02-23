<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 22/02/2018
 * Time: 11:11
 */

namespace Tests\Framework;

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest("GET", "/demoslash/");
        $response = $app->run($request);

        $this->assertContains("/demoslash", $response->getHeader("Location"));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testError404()
    {
        $app = new App();
        $request = new ServerRequest("GET", "/azeaze");
        $response = $app->run($request);
        $this->assertEquals("<h1>Error 404</h1>", $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
