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


    $publisher = $database->select("publisher", "*", ["id" => $id]);

    if(!isset($publisher[0]))
    {
        header("location:" . BASE_URL . "publisher");
        exit;
    }

    $data = $publisher[0];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    extract($_POST);
    $err = [];

    $publisher = $database->select("publisher", "*", ["id" => $id]);
    $data = $publisher[0];

    $name = sanitize_data($name);
    $street = sanitize_data($street);
    $city = sanitize_data($city);
    $pin_code = sanitize_data($pin_code);


    if (empty($name)) {
        array_push($err, "Name is required");
    }
    if (strlen($name) < 3) {
        array_push($err, "Name must be at least 3 characters long");
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

        $update_data = [
            "name" => $name,
            "street" => $street,
            "pin_code" => $pin_code,
            "city_id" => $city
        ];

        $result = $database->update("publisher", $update_data, ["id" => $id]);

        if ($result) {

            set_flash("success", "Publisher updated successfully.");

            header("location:" . BASE_URL . "/publisher");
            exit;
        } else {

            set_flash("error", "Database Error Please Try Again");
        }
    }
} else {
    header("location:" . BASE_URL . "publisher");
    exit;
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
                            <h1 class="m-0">Publisher</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>publisher">Publisher</a></li>
                                <li class="breadcrumb-item active">Edit</li>
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
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Update Publisher</h3>
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

                                <form id="frm_publisher" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= (isset($data["id"])) ? $data["id"] : "" ?>">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label >Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter publisher name" value="<?= (isset($data["name"])) ? $data["name"] : "" ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="street">Street Address</label>
                                                    <input type="text" name="street" class="form-control" id="street" placeholder="Enter street/apt name" value="<?= (isset($data["street"])) ? $data["street"] : "" ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label>Province</label>
                                                    <select class="form-control select2bs4" name="province" id="sl_state" style="width: 100%;">
                                                        <option value="">Please Select Option</option>
                                                        <?php
                                                        $res = get_province();

                                                        $province = get_stateid_by_city($data["city_id"]);

                                                        foreach ($res as $single) {
                                                        ?>
                                                            <option <?php

                                                                    if ($province == $single["id"]) {
                                                                        echo "selected";
                                                                    }

                                                                    ?> value="<?= $single["id"] ?>"><?= $single["name"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select class="form-control select2bs4" name="city" id="sl_city" style="width: 100%;">
                                                        <option value="">Please Select Option</option>
                                                        <?php

                                                        $city = get_cities($province);

                                                        foreach ($city as $single) {
                                                        ?>
                                                            <option <?php

                                                                    if ($data["city_id"] == $single["id"]) {
                                                                        echo "selected";
                                                                    }

                                                                    ?> value="<?= $single["id"] ?>"><?= $single["name"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="street">Pin code</label>
                                                    <input type="text" name="pin_code" maxlength="6" class="form-control" id="pin_code" placeholder="Enter pin code" value="<?= (isset($data["pin_code"])) ? $data["pin_code"] : "" ?>">
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    <div class="card-footer ">
                                        <button type="submit" class="btn btn-info float-right">Save</button>
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

        <?php include_once "../layout/footer.php" ?>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>