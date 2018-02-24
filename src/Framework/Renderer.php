<?php
/**
 * Created by PhpStorm.
 * User: GeeKDooS
 * Date: 24/02/2018
 * Time: 11:51
 */

namespace App\Framework;


class Renderer
{
    /**
     * The default namespace for the paths
     */
    const DEFAULT_NAMESPACE = '__GEEKDOOS';
    /**
     * @var array all the renderer paths
     */
    private $paths = [];
    /**
     * @var array All globals variables are stored in this variable
     */
    private $globals = [];

    /**
     * This method add a path to oad views from a namespace
     * @param string $namespace
     * @param null|string $path
     */
    public function addPath(string $namespace, ?string $path = null) : void
    {
        if(is_null($path)){
            $this->paths[self::DEFAULT_NAMESPACE] = $namespace;
        }else {
            $this->paths[$namespace] = $path;
        }
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
    public function render(string $view, array $params = []) : string
    {
        if($this->hasNamespace($view)){
            $path = $this->replaceNamespace($view) . '.php';
        }else{
            $path = $this->paths[self::DEFAULT_NAMESPACE]. DIRECTORY_SEPARATOR . $view . '.php';
        }
        ob_start();
        $renderer = $this;
        extract($this->globals);
        extract($params);
        require ($path);
        return ob_get_clean();
    }

    /**
     * Thi method add global variables to all views
     * @param string $key
     * @param $value
     */
    public function addGlobal(string $key, $value) : void
    {
        $this->globals[$key] = $value;
    }

    private function hasNamespace(string $view) : bool {
        return $view[0] == '@';
    }

    private function getNamespace(string $view) : string {
        return substr($view, 1, strpos($view, '/') - 1);
    }

    private function replaceNamespace(string $view) : string {
        $namespace = $this->getNamespace($view);
        return str_replace('@'.$namespace, $this->paths[$namespace], $view);
    }
}