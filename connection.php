<?php

require 'vendor/autoload.php';
 
use Medoo\Medoo;
 
$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'edibleink',
    'username' => 'root',
    'password' => ''
]);
