<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/

require_once "connection.php";
require_once "function.php";


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>

    <?php require_once "layout/links.php"; ?>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">


        <?php require_once "layout/navigation.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <a href="<?= BASE_URL ?>product" class="text-dark">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Products</span>
                                        <span class="info-box-number"><?= $database->count("product") ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">

                            <a href="<?= BASE_URL ?>customer" class="text-dark">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-user"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Customers</span>
                                        <span class="info-box-number"><?= $database->count("customer") ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">

                            <a href="<?= BASE_URL ?>product" class="text-dark">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-file-invoice"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Invoice</span>
                                        <span class="info-box-number"><?= $database->count("invoice") ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-12">

                            <a href="<?= BASE_URL ?>author" class="text-dark">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Authors</span>
                                        <span class="info-box-number"><?= $database->count("author") ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">

                            <a href="<?= BASE_URL ?>publisher" class="text-dark">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="far fa-building"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Publisher</span>
                                        <span class="info-box-number"><?= $database->count("publisher") ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </a>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <?php include_once "layout/footer.php" ?>
    </div>

    <?php include_once "layout/scripts.php" ?>
</body>

</html>