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

$renderer = new \App\Framework\Renderer();
$renderer->addPath(dirname(__DIR__).'/templates');

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
