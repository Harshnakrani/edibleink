<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/

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

function get_publisher()
{
    global $database;

    $res = $database->select("publisher", "*");

    return $res;
}

function get_authors()
{
    global $database;

    $res = $database->select("author", "*");

    return $res;
}

function get_authors_by_product($id)
{
    global $database;

    $res = $database->select("author_has_products", "author_id", ["product_id" => $id]);


    return $res;
}

function get_stateid_by_city($city_id = "")
{
    global $database;

    $res = $database->select("city", "state_id", ["id" => $city_id]);
    if (isset($res[0])) {
        return $res[0];
    } else {
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

    $res = $database->select("publisher", "name", ["id" => $id]);

    return (isset($res[0]) ? $res[0] : "");
}

function get_authors_name($product_id)
{
    global $database;

    $result = $database->query("SELECT CONCAT(a.firstName,' ',a.lastName) 'author' FROM `author_has_products` ap,`author` a  where ap.product_id = " . $product_id . " and a.id = ap.author_id")->fetchAll();

    $author = [];
    foreach ($result as $single) {
        array_push($author, $single["author"]);
    }

    return implode("<br/>", $author);
}

function get_product_type($id)
{
    global $database;

    $res = $database->select("product_type", "type", ["id" => $id]);

    return (isset($res[0]) ? $res[0] : "");
}
function get_product_type_list()
{
    global $database;

    $res = $database->select("product_type", "*");

    return $res;
}


function get_cart_count()
{
    if (isset($_SESSION["cart"])) {
        return count($_SESSION["cart"]);
    } else {
        return 0;
    }
}

function get_customer_list()
{
    global $database;

    $res = $database->select("customer", "*");

    return $res;
}


function get_cart_product()
{
    global $database;

    if (isset($_SESSION["cart"])) {


        $combinedQty = array_reduce($_SESSION["cart"], function ($result, $item) {

            if (!array_key_exists($item["product"], $result)) {
                $result[$item["product"]] = $item["qty"];
            } else {

                $result[$item["product"]] += $item["qty"];
            }

            return $result;
        }, []);



        $productData = array_column($_SESSION["cart"], "product");

        $res = $database->select("product", "*", ["id" => $productData]);

        $data_to_pass = [];
        
        $sess_cart = [];

        foreach ($res as $single) {
            
            if(array_key_exists($single["id"],$combinedQty))
            {
                $id = $single["id"];
                $single["qty"] = $combinedQty[$id];
                
                $data_to_pass[] = $single;
                $sess_cart[] = [
                    "product" => $single["id"],
                    "qty" => $combinedQty[$id]
                ];
            }
            

        }
        
        $_SESSION["cart"] = $sess_cart;

        return $data_to_pass;
    }
}


function get_customer_name($id)
{
    global $database;

    $res = $database->select("customer","*",["id" =>$id]);

    return $res[0]["firstName"]." ".$res[0]["lastName"];
}