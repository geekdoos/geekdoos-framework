<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 22/02/2018
 * Time: 10:57
 */

use App\Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;

require dirname(__DIR__)."/vendor/autoload.php";

$modules = [
    BlogModule::class,
];

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__).'/config/config.php');

foreach ($modules as $module){
    if(!is_null($module::DEFINITIONS)){
        $builder->addDefinitions($module::DEFINITIONS);
    }
}
$builder->addDefinitions(dirname(__DIR__).'/config.php');

try {
    $container = $builder->build();
    $app = new App($container, $modules);
    if(php_sapi_name() !== "cli"){
        $response = $app->run(ServerRequest::fromGlobals());
        \Http\Response\send($response);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
