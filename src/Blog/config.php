<?php

use App\Blog\BlogModule;
use function \DI\{get, autowire};

return [
    'blog.prefix' => '/blog',
    BlogModule::class =>  autowire()->constructorParameter('prefix', get('blog.prefix'))
];