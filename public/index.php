<?php
/**
 * Created by PhpStorm.
 * User: okhachiai
 * Date: 22/02/2018
 * Time: 10:57
 */

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;

require "../vendor/autoload.php";

$renderer = new \App\Framework\Renderer\TwigRenderer(dirname(__DIR__).'/templates');

//$loader = new Twig_Loader_Filesystem((__DIR__).'/templates');
//$twig = new Twig_Environment($loader, []);

$app = new App([
    \App\Blog\BlogModule::class,
], [
    'renderer' => $renderer,
]);

try {
    $response = $app->run(ServerRequest::fromGlobals());
    \Http\Response\send($response);
} catch (Exception $e) {
    $e->getMessage();
}
