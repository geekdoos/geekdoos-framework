<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 23/02/2018
 * Time: 09:44
 */

namespace Framework\Router;

/**
 * Class Route
 * @package Framework\Router
 */
class Route
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var callable|string
     */
    private $callback;
    /**
     * @var array
     */
    private $params;

    public function __construct(string $name, $callback, array $params)
    {
        $this->name = $name;
        $this->callback = $callback;
        $this->params = $params;
    }

    /**
     * @return string the of the route
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|callable the callback
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return string[] list of parameters
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
