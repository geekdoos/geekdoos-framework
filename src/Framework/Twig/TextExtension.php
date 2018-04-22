<?php

namespace App\Framework\Twig;

class TextExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('excerpt', [$this, 'excerpt'])
        ];
    }

    /**
     * @param $content
     * @param int $maxLength
     * @return string
     */
    public function excerpt($content, $maxLength = 100) : string
    {

        if (mb_strlen($content) > $maxLength) {
            $excerpt = mb_substr($content, 0, $maxLength);
            $lastSpace = mb_strrpos($excerpt, ' ');
            return  mb_substr($excerpt, 0, $lastSpace).'...';
        }


        return $content;
    }
}
