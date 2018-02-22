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

$app = new App([
    BlogModule::class,
]);

$response = $app->run(ServerRequest::fromGlobals());

\Http\Response\send($response);
