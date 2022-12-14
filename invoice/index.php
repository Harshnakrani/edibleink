<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/
require_once "../connection.php";
require_once "../function.php";

$invoice = $database->select("invoice", "*");

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
                            <h1 class="m-0">Invoice List</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Invoice</li>
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


                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title float-right"> <a href="<?= BASE_URL ?>invoice/add.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Create</a> </h3>
                                </div>

                                <div class="card-body">

                                    <table id="dt_invoice" class="dt table table-bordered table-hover dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>Invoice Id</th>
                                                <th>Customer Name</th>
                                                <th>Total</th>
                                                <th>Date Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($invoice as $single) {
                                            ?>
                                                <tr>
                                                    <td><?= $single["id"] ?></td>
                                                    <td><?=get_customer_name($single["customer_id"]) ?></td>
                                                    <td>$<?=$single["total"] ?></td>
                                                    <td><?=$single["created_at"] ?></td>
                                                    <td>
                                                        <a target="_blank" href="<?php echo BASE_URL."invoice/print_invoice.php?force=I&id=".$single["id"]?>" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> View </a>    
                                                        <a  href="<?php echo BASE_URL."invoice/print_invoice.php?force=D&id=".$single["id"]?>" class="btn btn-sm btn-info"> <i class="fa fa-download"></i> Download </a>    
                                                    </td>
                                                </tr>
                                            <?php
                                            }

                                            ?>


                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>


                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

       

        
        <?php include_once "../layout/footer.php" ?>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>