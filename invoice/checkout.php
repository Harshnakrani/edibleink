<?php
require_once "../connection.php";
require_once "../function.php";

// print_r($_SESSION["cart"]);

if (!isset($_SESSION["cart"])) {
    set_flash("error", "No item selectd for checkout");
    header("location:" . BASE_URL . "invoice/add.php");
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    extract($_POST);

    if (empty($customer)) {
        set_flash("error", "Please select customer for this invoice");
    } else {

        $insert_data = [
            "id" => get_next_id("invoice"),
            "created_at" => date("Y-m-d h:i:s"),
            "discount" => 0,
            "tax" => $tax,
            "total" => $total,
            "customer_id" => $customer
        ];

        $last_id = $insert_data["id"];
        $res = $database->insert("invoice",$insert_data);

        if($res)
        {
            $insert_invoice_item = [];

            $cart = get_cart_product();
            $auto_id = get_next_id("invoiceitem");
            foreach($cart as $single)
            {
                $data = [
                    "id" => $auto_id,
                    "quantity" => $single["qty"],
                    "invoice_id" => $last_id,
                    "product_id" => $single["id"],
                    "price" => $single["price"]
                ];

                $insert_invoice_item[] = $data;
                $auto_id++;
            }

            $res = $database->insert("invoiceitem",$insert_invoice_item);

            if($res)
            {
                unset($_SESSION["cart"]);
                set_flash("success","Invoice generated Successfully");
                header("location:".BASE_URL."invoice");
            }
            else
            {
                $database->delete("invoiceitem",["product_id" => $last_id]);
                set_flash("error","Invoice generation Failed");
                header("location:".BASE_URL."invoice");
            }
            
        }
        else
        {
            set_flash("error","Invoice generation Failed");
            header("location:",BASE_URL."invoice");
        }

    }
}


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>

    <?php require_once "../layout/links.php"; ?>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">


        <?php require_once "../layout/navigation.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Checkout</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>invoice">Invoice</a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>invoice/add.php">Create</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="invoice p-3 mb-3">

                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-globe"></i> <?= APP_NAME ?>.
                                                <small class="float-right">Date: <?= date("m-d-Y") ?></small>
                                            </h4>
                                        </div>

                                    </div>

                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            From
                                            <address>
                                                <strong><?= APP_NAME ?></strong><br>
                                                299 Doon Valley Dr,<br>
                                                Kitchener, ON N2G 4M4<br>
                                                Phone: (647) 878-3620 <br>
                                                Email: info@edibleink.com
                                            </address>
                                        </div>

                                        <div class="col-sm-4 invoice-col">
                                            To


                                            <div class="form-group">
                                                <label>Select Customer</label>
                                                <select class="form-control select2bs4" name="customer" id="sl_type" style="width: 100%;">
                                                    <option value="">Please Select Option</option>
                                                    <?php $res = get_customer_list();

                                                    foreach ($res as $single) {
                                                    ?>
                                                        <option value="<?= $single["id"] ?>"><?= $single["firstName"] . " " . $single["lastName"] ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <hr>
                                            New customer ?
                                            <a href="<?= BASE_URL ?>customer/add.php" target="_blank" class="">Add Here</a>

                                        </div>



                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Isbn</th>
                                                        <th>Quantity</th>
                                                        <th>Subtotal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $product = get_cart_product();

                                                    $sub = 0;
                                                    $tax = 0;
                                                    $total = 0;
                                                    foreach ($product as $single) {
                                                        $sub += $single["price"] * $single["qty"];
                                                    ?>

                                                        <tr>
                                                            <td><?= $single["title"] ?></td>
                                                            <td><?= $single["isbn"] ?></td>
                                                            <td><span class="badge text-md bg-purple"><?= $single["qty"] ?></span></td>
                                                            <td>$<?= $single["price"] ?></td>
                                                            <td>
                                                                <a href="<?= BASE_URL ?>invoice/add_item.php?id=<?= $single["id"] ?>" class="btn btn-success btn-sm">Add Qty</a>
                                                                <a href="<?= BASE_URL ?>invoice/delete_item.php?id=<?= $single["id"] ?>" class="btn btn-danger btn-sm">Remove Qty</a>

                                                            </td>
                                                        </tr>

                                                    <?php
                                                    }

                                                    $tax  = round($sub * 0.13, 2);
                                                    $total = $sub + $tax;
                                                    ?>

                                                    <input type="hidden" name="tax" value="<?= $tax ?>">
                                                    <input type="hidden" name="total" value="<?= $total ?>">
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="row">


                                        <div class="offset-md-6 col-6">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width:50%">Subtotal:</th>
                                                            <td>$<?= $sub ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tax (13%)</th>
                                                            <td>$<?= $tax ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Discount:</th>
                                                            <td>$0.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td>$<?= $total ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row no-print">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success float-right"><i class="fas fa-file-invoice"></i> Create Invoice
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include_once "../layout/footer.php" ?>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>