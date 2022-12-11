<?php
require_once "function.php";

if (isset($_GET["handle"]) && $_GET["handle"] == "get_city") {
    
    $cities = get_cities($_GET["id"]);
   
    echo json_encode($cities);
}