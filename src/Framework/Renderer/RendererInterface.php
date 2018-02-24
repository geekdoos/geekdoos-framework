<?php
/**
 * Created by PhpStorm.
 * User: GeeKDooS
 * Date: 24/02/2018
 * Time: 16:19
 */

namespace App\Framework\Renderer;

interface RendererInterface
{
    /**
     * This method add a path to oad views from a namespace
     * @param string $namespace
     * @param null|string $path
     */
    public function addPath(string $namespace, ?string $path = null): void;

    /**
     * This method render a template
     * The path was added by the addPath method
     * $this->render('@namespace/view')
     * $this->render('view')
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    /**
     * Thi method add global variables to all views
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value): void;
}
