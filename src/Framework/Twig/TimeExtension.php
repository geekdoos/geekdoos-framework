<?php

namespace App\Framework\Twig;

class TimeExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('ago', [$this, 'ago'], ['is_safe' => ['html']])
        ];
    }

    public function ago(\DateTime $date, string $format = "d/m/Y H:i")
    {
        return '<span class="timeago" 
            datetime="'.$date->format(\DateTime::ISO8601).'">'.$date->format($format).'</span>';
    }
}
