<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 23/02/2018
 * Time: 15:22
 */

namespace Test\Modules;

use Framework\App;
use Framework\Modules\ErrorModule;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Framework\Modules\StringModule;
use Psr\Http\Message\ResponseInterface;

class ResponseTest extends TestCase
{

    public function testExceptionIfResponseIsNotRecognized(){
        $app = new App([
            ErrorModule::class,
        ]);
        $request = new ServerRequest('GET', '/demo');
        $this->expectException(\Exception::class);
        $app->run($request);
    }

    public function testConvertStringToResponse(){
        $app = new App([
            StringModule::class,
        ]);
        $request = new ServerRequest('GET', '/demo');
        $response = $app->run($request);
        $this->assertInstanceOf(ResponseInterface::class,$response);
        $this->assertEquals("DEMO", (string) $response->getBody());
    }
}
