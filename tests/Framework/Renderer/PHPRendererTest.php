<?php
/**
 * Created by PhpStorm.
 * User: GeeKDooS
 * Date: 24/02/2018
 * Time: 16:38
 */

namespace Test\Framework\Renderer;

use App\Framework\Renderer\PHPRenderer;
use PHPUnit\Framework\TestCase;

class PHPRendererTest extends TestCase
{

    /**
     * @var PHPRenderer
     */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new PHPRenderer(__DIR__ . '/views');
    }

    public function testRenderTheRightPath(){
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/demo');
        $this->assertEquals('Hello world', $content);
    }

    public function testRenderTheDefaultPath(){
        $content = $this->renderer->render('demo');
        $this->assertEquals('Hello world', $content);
    }

    public function testRenderWithParams(){
        $content = $this->renderer->render('demoparams', ['name' => 'Geekdoos']);
        $this->assertEquals('Hi, Geekdoos !!', $content);
    }

    public function testGlobalParams(){
        $this->renderer->addGlobal('name', 'Geekdoos');
        $content = $this->renderer->render('demoparams');
        $this->assertEquals('Hi, Geekdoos !!', $content);
    }

}
