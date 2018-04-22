<?php

namespace Test\Framework\Twig;

use App\Framework\Twig\TextExtension;
use PHPUnit\Framework\TestCase;

class TextExtensionTest extends TestCase
{

    /**
     * @var TextExtension
     */
    private $textExtension;

    public function setUp()
    {
        $this->textExtension = new TextExtension();
    }

    public function testExcerptWthShortText(){

        $text = "Salut";
        $this->assertEquals($text, $this->textExtension->excerpt($text, 10));

    }


    public function testExcerptWthLongText(){

        $text = "Salut les gens";
        $this->assertEquals("Salut les...", $this->textExtension->excerpt($text, 12));

    }

}
