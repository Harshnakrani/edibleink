<?php
include_once "connection.php";
// change base url as per the environment
DEFINE("BASE_URL", "http://localhost/edibleink/");
DEFINE("APP_NAME", "EdibleInk");


function get_province()
{
    global $database;

    $res = $database->select("state", "*");

    return $res;
}

function get_stateid_by_city($city_id = "")
{
    global $database;

    $res = $database->select("city", "state_id", ["id" => $city_id]);
    if (isset($res[0])) {
        return $res[0];
    }
    else
    {
        return "";
    }
}

function get_cities($state_id = "")
{
    global $database;

    $res = $database->select("city", "*", ["state_id" => $state_id]);

    return $res;
}

function sanitize_data($value)
{
    $value = trim($value);
    $value = htmlspecialchars($value);
    $value = strip_tags($value);
    return $value;
}


function get_next_id($table)
{
    global $database;

    $max_id = $database->max($table, 'id');

    if (empty($max_id)) {
        $max_id = 0;
    }

    $next_id = $max_id + 1;

    return $next_id;
}

function set_flash($type, $message)
{
    return  $_SESSION['flash_' . $type] = $message;
}


function get_location($city_id)
{
    global $database;

    $city = $database->select('city', [
        '[>]state' => ['state_id' => 'id']
    ], [
        'city.name(city)',
        'state.name(state)'
    ], [
        'city.id' => $city_id
    ]);

    return $city[0]["city"] . ", " . $city[0]["state"];
}


function get_publisher_name($id)
{
    global $database;
    
    $res = $database->select("publisher","name",["id" => $id]);
    
    return (isset($res[0]) ? $res[0] : "");
}

function get_authors_name($product_id)
{
    global $database;
    
    $result = $database->query("SELECT CONCAT(a.firstName,' ',a.lastName) 'author' FROM `author_has_products` ap,`author` a  where ap.product_id = ".$product_id." and a.id = ap.author_id")->fetchAll();

    $author = [];
    foreach($result as $single)
    {
        array_push($author,$single["author"]);
    }

    return implode("<br/>",$author);

}

function get_product_type($id)
{
    global $database;
    
    $res = $database->select("product_type","type",["id" => $id]);
    
    return (isset($res[0]) ? $res[0] : "");
}