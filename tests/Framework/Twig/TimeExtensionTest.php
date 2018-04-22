<?php

namespace Test\Framework\Twig;

use App\Framework\Twig\TimeExtension;
use PHPUnit\Framework\TestCase;

class TimeExtensionTest extends TestCase
{
    /**
     * @var TimeExtension
     */
    private $timeExtension;

    public function setUp()
    {
        $this->timeExtension = new TimeExtension();
    }

    public function testAgoFilter(){
        $date = new \DateTime();
        $format = "d/m/Y H:i";
        $result = '<span class="timeago" datetime="'.$date->format(\DateTime::ISO8601).'">'.$date->format($format).'</span>';

        $this->assertEquals($result, $this->timeExtension->ago($date, $format));
    }

}