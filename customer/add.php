<?php
/* 
-- Harshil Trivedi (8804546)
-- Shiv Ahir (8809928)
-- Harsh Nakrani (8812036)
*/

require_once "../connection.php";
require_once "../function.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    extract($_POST);
    $err = [];

    $fname = ucfirst(sanitize_data($firstName));
    $lname = ucfirst(sanitize_data($lastName));
    $email = sanitize_data($email);
    $mobile = sanitize_data($mobile);
    $street = sanitize_data($street);
    $city = sanitize_data($city);
    $pin_code = sanitize_data($pin_code);


    if ($database->has("customer", ["email" => $email])) {
        array_push($err, "Email is already exist please try diffrent email");
    }

    if ($database->has("customer", ["mobile" => $mobile])) {
        array_push($err, "Mobile number is already exist please try diffrent mobile number");
    }

    if (empty($fname)) {
        array_push($err, "First Name is required");
    }
    if (strlen($fname) < 2) {
        array_push($err, "First Name must be at least 2 characters long");
    }
    if (empty($lname)) {
        array_push($err, "Last Name is required");
    }
    if (strlen($lname) < 2) {
        array_push($err, "Last Name must be at least 2 characters long");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($err, "Invalid email format");
    }
    if (!preg_match('/^[0-9]{10}+$/', $mobile)) {
        array_push($err, "Invalid mobile number");
    }
    if (empty($street)) {
        array_push($err, "Street address is required");
    }
    if (empty($province)) {
        array_push($err, "Province is required");
    }
    if (empty($city)) {
        array_push($err, "City is required");
    }
    if (empty($pin_code) || strlen($pin_code) != 6) {
        array_push($err, "Pin code is required and must be 6 digits long");
    }


    if (empty($err)) {

        $insert_data = [
            "id" => get_next_id("customer"),
            "firstName" => $fname,
            "lastName" => $lname,
            "email" => $email,
            "mobile" => $mobile,
            "street" => $street,
            "pin_code" => $pin_code,
            "city_id" => $city
        ];

        $result = $database->insert("customer", $insert_data);


        if ($result) {
            set_flash("success", "Customer added successfully.");

            header("location:" . BASE_URL . "/customer");
            exit;
        } else {
            set_flash("error", "Database Error Please Try Again");
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
                            <h1 class="m-0">Customer</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>customer">Customer</a></li>
                                <li class="breadcrumb-item active">Add</li>
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

                        <div class="col-md-12 col-sm-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Customer</h3>
                                </div>

                                <?php

                                if (!empty($err)) {

                                    echo "<div class='alert alert-danger m-4'> <ul>";

                                    foreach ($err as $single) {
                                ?>
                                        <li><?= $single ?></li>
                                <?php
                                    }

                                    echo "</ul></div>";
                                }


                                ?>

                                <form id="frm_customer" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="Enter customer first name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Enter customer last name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter customer email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile</label>
                                                    <input type="tel" name="mobile" class="form-control" minlength="10" maxlength="10" placeholder="Enter mobile number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                                    <select class="form-control select2bs4" name="city" id="sl_city" style="width: 100%;">
                                                        <option value="">Please Select Option</option>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="street">Pin code</label>
                                                    <input type="text" name="pin_code" maxlength="6" class="form-control" id="pin_code" placeholder="Enter pin code">
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    <div class="card-footer ">
                                        <button type="submit" class="btn btn-primary float-right">Create</button>
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
        <?php include_once "../layout/footer.php" ?>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>