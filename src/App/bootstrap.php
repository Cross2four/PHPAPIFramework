<?php

require '../vendor/autoload.php';

use App\Responses\ResponseFactory;
use App\Responses\ResponseType;
use App\Routes\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__ . "/../..");
$dotenv->load();

$config = config('response');

$response = null;

switch ($config->content_type) {
    case 'json':
        $response = ResponseFactory::getResponseObject(ResponseType::JSON);
        break;
    case 'xml':
        $response = ResponseFactory::getResponseObject(ResponseType::XML);
        break;
}

$router = new Router($response);