<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/
require_once "../connection.php";
require_once "../function.php";

// print_r($_SESSION["cart"]);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);

    if (isset($qty) && $qty <= 0) {
        set_flash("error", "Please enter valid qty befor adding product");
    } else if (!empty($_POST)) {
        $_SESSION["cart"][] =  $_POST;
        set_flash("success", "Product added to checkout");
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
                            <h1 class="m-0">Create Invoice</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>invoice">Invoice</a></li>
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

                        <div class="col-md-12 pb-3 ">
                            <a href="<?= BASE_URL ?>invoice/checkout.php" class="btn bg-purple float-right ">Checkout <span class="badge bg-white"><?= get_cart_count() ?></span> </a>
                        </div>

                        <?php
                        $product = $database->select("product", "*");

                        foreach ($product as $single) {
                        ?>
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" id="frm_product_<?= $single["id"] ?>">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            <?= $single["yearPublished"] ?>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="lead"><b><?= $single["title"] ?></b></h2>
                                                    <div class="badge text-md bg-info mb-2"><b>Price: </b> $<?= $single["price"] ?></div>
                                                    <div class="text-muted pb-1"><b>Author: </b> <?php echo str_replace('<br/>', ', ', get_authors_name($single["id"]));  ?> </div>
                                                    <div class="text-muted pb-1"><b>Publisher: </b> <?php echo str_replace('<br/>', ', ', get_publisher_name($single["publisher_id"]));  ?> </div>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class=""><span class="fa-li"><i class="fas fa-lg fa-book"></i></span> ISBN: <?= $single["isbn"] ?></li>
                                                        <li class=""><span class="fa-li"><i class="fas fa-lg fa-book"></i></span> Type: <?= get_product_type($single["product_type_id"]) ?> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <span class="float-left">
                                                <input type="hidden" name="product" value="<?= $single["id"] ?>">
                                                <input type="number" class="form-control form-control-sm" style="width: 100px;" name="qty" value="0">
                                            </span>
                                            <span class="float-right">

                                                <button class="btn btn-sm bg-purple">
                                                    <i class="fas fa-plus"></i> Add
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                        }
                        ?>


                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

       

        <!-- Main Footer -->
        <?php include_once "../layout/footer.php" ?>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>