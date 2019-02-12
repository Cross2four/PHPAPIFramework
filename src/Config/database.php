<?php

return (Object) [
    'db_module' =>  getenv('APP_DB_MODULE'),
    'driver'    =>  getenv('APP_DB_DRIVER'),
    'address'   =>  getenv('APP_DB_ADDRESS'),
    'username'  =>  getenv('APP_DB_USER'),
    'password'  =>  getenv('APP_DB_PASS'),
    'database'  =>  getenv('APP_DB_DATABASE')
];