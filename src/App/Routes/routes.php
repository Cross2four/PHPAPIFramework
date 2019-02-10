<?php

$router->add('get', '/users', 'UsersController@index');
$router->add('get', '/users/{id}', 'UsersController@show');
$router->add('post', '/users/', 'UsersController@create');
$router->add('put', '/users/{id}', 'UsersController@update');
$router->add('delete', '/users/{id}', 'UsersController@delete');