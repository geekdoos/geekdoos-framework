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

require "../vendor/autoload.php";

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
try{
    $container = $builder->build();

    $app = new App($container, $modules);

    $response = $app->run(ServerRequest::fromGlobals());

    \Http\Response\send($response);
}catch (Exception $e){
    echo $e->getMessage();
} catch (\Psr\Container\NotFoundExceptionInterface $e) {
    echo $e->getMessage();
} catch (\Psr\Container\ContainerExceptionInterface $e) {
    echo $e->getMessage();
}

