<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 23/02/2018
 * Time: 15:16
 */

namespace Framework\Modules;

use Framework\Router;

class ErrorModule
{

    public function __construct(Router $router)
    {
        $router->get("/demo", function (){
            return new \StdClass();
        }, 'demo');
    }

}