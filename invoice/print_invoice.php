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

    $data = $database->select("invoice", "*", ["id" => $id]);

    $data = $data[0];

    $customer = $database->select("customer", "*", ["id" => $data["customer_id"]]);

    $customer = $customer[0];


    $invoice_item = $database->select(
        "invoiceitem",
        [
            "[>]product" =>  ['product_id' => 'id']
        ],
        [
            'product.title(title)',
            'invoiceitem.quantity(quantity)',
            'invoiceitem.price(price)'
        ],
        ["invoice_id" => $id]
    );




    // echo "<pre>";
    // print_r($invoice_item);
    // die();

    // print_r($customer);
    // die();
}

$force = "I";
if(isset($_GET["force"]))
{
    $force = $_GET["force"];
}


use Konekt\PdfInvoice\InvoicePrinter;

$invoice = new InvoicePrinter();

/* Header settings */
$invoice->setLogo("../dist/img/logo.png");
$invoice->setColor("#007fff");
$invoice->setType(APP_NAME . " Invoice");
$invoice->setReference("INV-" . $data["id"]);
$invoice->setDate("  " . date('M dS ,Y', strtotime($data["created_at"])));
$invoice->setTime(date('h:i:s A', strtotime($data["created_at"])));
$invoice->setFrom(array(APP_NAME, "info@edibleink.com", "+1 (647) 878-3620", "299 Doon Valley Dr,", "Kitchener, ON N2G 4M4"));
$invoice->setTo(array($customer["firstName"] . " " . $customer["lastName"], $customer["email"], $customer["mobile"], $customer["street"], get_location($customer["city_id"]) . " " . $customer["pin_code"]));

$sub = 0;
foreach ($invoice_item as $single) {
    $in_sub = $single["quantity"] * $single["price"];
    $invoice->addItem($single["title"]."asdsadaskjdaskjdb sduas dugs udgasiu gdbusa dusag kdasu dgsa gdjsh vd", "", $single["quantity"], false, $single["price"], 0, $in_sub);
    $sub += $in_sub;
}


$invoice->addTotal("Subtotal", $sub);
$invoice->addTotal("Tax (13%)", $data["tax"]);
$invoice->addTotal("Discount", 0);
$invoice->addTotal("Total due", $data["total"], true);

$invoice->addBadge('Paid', '#008640');

$invoice->addTitle("Important Notice");

$invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");

$invoice->setFooternote(APP_NAME);

$invoice->render('example1.pdf', $force);
