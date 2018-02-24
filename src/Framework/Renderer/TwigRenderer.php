<?php
/**
 * Created by PhpStorm.
 * User: GeeKDooS
 * Date: 24/02/2018
 * Time: 16:31
 */

namespace App\Framework\Renderer;

class TwigRenderer implements RendererInterface
{

    private $loader;
    private $twig;

    public function __construct(string $path, array $options = [])
    {
        $this->loader = new \Twig_Loader_Filesystem($path);
        $this->twig = new \Twig_Environment($this->loader, $options);
    }

    /**
     * This method add a path to oad views from a namespace
     * @param string $namespace
     * @param null|string $path
     * @throws \Twig_Error_Loader
     */
    public function addPath(string $namespace, ?string $path = null): void
    {
        $this->loader->addPath($path, $namespace);
    }

    /**
     * This method render a template
     * The path was added by the addPath method
     * $this->render('@namespace/view')
     * $this->render('view')
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        try {
            return $this->twig->render($view . '.twig', $params);
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
    }

    /**
     * Thi method add global variables to all views
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void
    {
        $this->twig->addGlobal($key, $value);
    }
}
