<?php

require '../vendor/autoload.php';

use App\Routes\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__ . "/../..");
$dotenv->load();

$router = new Router();