<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/

session_start();
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('US/Eastern');

require 'vendor/autoload.php';
 
use Medoo\Medoo;
 
$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'edibleink',
    'username' => 'root',
    'password' => ''
]);
