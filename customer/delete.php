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
    $res = $database->delete("customer", ["id" => $id]);

    if ($res) {
        set_flash("success", "Customer deleted successfully");
        header("location:" . BASE_URL . "customer");
        exit;
    } else {
        set_flash("error", "Something went wrong please try again");
        header("location:" . BASE_URL . "customer");
        exit;
    }
} else {
    header("location:" . BASE_URL . "customer");
    exit;
}
