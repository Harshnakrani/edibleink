<?php
include_once "connection.php";
// change base url as per the environment
DEFINE("BASE_URL" , "http://localhost/edibleink/");
DEFINE("APP_NAME" , "EdibleInk");


function get_province()
{
    global $database;

    $res = $database->select("state","*");

    return $res;

}

function get_cities($state_id)
{
    global $database;

    $res = $database->select("city","*",["state_id" => $state_id]);

    return $res;
}