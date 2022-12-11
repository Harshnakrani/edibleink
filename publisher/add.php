<?php
require_once "../connection.php";
require_once "../function.php";


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
                            <h1 class="m-0">Publisher</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">


                        <div class="col-md-6">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Publisher</h3>
                                </div>


                                <form id="frm_add_publisher" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter publisher name">
                                        </div>
                                        <div class="form-group">
                                            <label for="street">Street Address</label>
                                            <input type="text" name="street" class="form-control" id="street" placeholder="Enter street/apt name">
                                        </div>

                                        <div class="form-group">
                                            <label>Province</label>
                                            <select class="form-control select2bs4" name="province" id="sl_state" style="width: 100%;">
                                                <option value="">Please Select Option</option>
                                                <?php $res = get_province(); 

                                                foreach ($res as $single) {
                                                ?>
                                                    <option value="<?= $single["id"] ?>"><?= $single["name"] ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control select2bs4" name="city"  id="sl_city" style="width: 100%;">
                                                <option value="">Please Select Option</option>
                                                
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="street">Pin code</label>
                                            <input type="text" name="pin_code" maxlength="6" class="form-control" id="pin_code" placeholder="Enter pin code">
                                        </div>


                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>

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
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <?php echo  APP_NAME ?>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022.</strong> All rights reserved.
        </footer>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>