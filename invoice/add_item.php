<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/
require_once "../connection.php";
require_once "../function.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

$cart  = $_SESSION["cart"];

foreach ($cart as $key => $item) {
    if ($item["product"] == $id) {
        $cart[$key]["qty"]++;
        break;
    }
}

$_SESSION["cart"] = $cart;

set_flash("success" , "Product qty added successfully.");

header("location:".BASE_URL."invoice/checkout.php");