<?php
require_once "../connection.php";
require_once "../function.php";


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $res = $database->delete("product", ["id" => $id]);

    if ($res) {
        set_flash("success", "Product deleted successfully");
        header("location:" . BASE_URL . "product");
        exit;
    } else {
        set_flash("error", "Something went wrong please try again");
        header("location:" . BASE_URL . "product");
        exit;
    }
} else {
    header("location:" . BASE_URL . "product");
    exit;
}
