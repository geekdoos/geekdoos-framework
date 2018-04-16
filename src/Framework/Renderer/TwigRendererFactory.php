<?php
/**
 * Created by PhpStorm.
 * User: GeeKDooS
 * Date: 24/02/2018
 * Time: 19:14
 */

namespace App\Framework\Renderer;

use App\Framework\Router\RouterTwigExtension;
use Psr\Container\ContainerInterface;

class TwigRendererFactory
{

    /**
     * @param ContainerInterface $container
     * @return TwigRenderer
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container) : TwigRenderer
    {
        $viewPath = $container->get('views.path');
        $loader = new \Twig_Loader_Filesystem($viewPath);
        $twig = new \Twig_Environment($loader);
        if($container->has('twig.extensions')){
            foreach ($container->get('twig.extensions') as $extension){
                $twig->addExtension($extension);
            }
        }
        return new TwigRenderer($loader, $twig);
    }
}