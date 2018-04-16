<?php

use App\Framework\Renderer\RendererInterface;
use App\Framework\Renderer\TwigRendererFactory;
use App\Framework\Router\RouterTwigExtension;
use Framework\Router;
use function \DI\{create, factory};

return [
    'database' => [
        "adapter" => "mysql",
        "host" => "localhost",
        "name" => "geekdoos",
        "user" => "root",
        "pass" => "",
        "port" => "3306",
        "charset" => "utf8",
    ],
    'views.path' => dirname(__DIR__).'/templates',
    'twig.extensions' => [
        \DI\get(RouterTwigExtension::class),
    ],
    Router::class => create(),
    RendererInterface::class => factory(TwigRendererFactory::class),
];
