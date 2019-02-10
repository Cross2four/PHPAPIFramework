<?php

require(__DIR__ . '/../src/App/bootstrap.php');
require(__DIR__ . '/../src/App/Routes/routes.php');

$router->dispatch();
