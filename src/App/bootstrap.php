<?php

require '../vendor/autoload.php';

use App\Responses\ResponseFactory;
use App\Responses\ResponseType;
use App\Routes\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__ . "/../..");
$dotenv->load();

$acceptTypeXml = strpos($_SERVER['HTTP_ACCEPT'], 'xml') !== false;

$response = null;

if ($acceptTypeXml) {
    $response = ResponseFactory::getResponseObject(ResponseType::XML);
} else {
    $response = ResponseFactory::getResponseObject(ResponseType::JSON);
}

$router = new Router($response);