<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/

require_once "function.php";

if (isset($_GET["handle"]) && $_GET["handle"] == "get_city") {
    
    $cities = get_cities($_GET["id"]);
   
    echo json_encode($cities);
}