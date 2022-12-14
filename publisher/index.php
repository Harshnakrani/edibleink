<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/
require_once "../connection.php";
require_once "../function.php";

$publisher = $database->select("publisher", "*");

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
                            <h1 class="m-0">Publisher List</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Publisher</li>
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
                                    <h3 class="card-title float-right"> <a href="<?= BASE_URL ?>publisher/add.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add</a> </h3>
                                </div>

                                <div class="card-body">

                                    <table id="dt_publisher" class="dt table table-bordered table-hover dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($publisher as $single) {
                                            ?>
                                                <tr>
                                                    <td><?= $single["id"] ?></td>
                                                    <td><?= $single["name"] ?></td>
                                                    <td><?= $single["street"] . ", " . get_location($single["city_id"]) . ", " . $single["pin_code"] ?></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" href="<?= BASE_URL ?>publisher/update.php?id=<?= $single["id"] ?>">
                                                            Edit
                                                        </a>
                                                        <!-- <a class="btn btn-danger btn-sm" href="<?= BASE_URL ?>publisher/delete.php?id=<?= $single["id"] ?>">
                                                            Delete
                                                        </a> -->
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