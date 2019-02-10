<?php

function config($type)
{
    $config = include("src/Config/$type.php");

    if (is_null($config)) {
        throw new InvalidArgumentException("Config file: $type.php not found");
    }

    return $config;
}