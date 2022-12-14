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


    $product = $database->select("product", "*", ["id" => $id]);
    
    if (!isset($product[0])) {
        header("location:" . BASE_URL . "product");
        exit;
    }
    
    $data = $product[0];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    extract($_POST);
    $product = $database->select("product", "*", ["id" => $id]);
    $data = $product[0];

    $err = [];

    $title = ucfirst(sanitize_data($title));
    $year = (int) sanitize_data($yaerpublished);
    $isbn = sanitize_data($isbn);
    $price = sanitize_data($price);
    $type = sanitize_data($type);
    $publisher = sanitize_data($publisher);


    if (empty($title)) {
        array_push($err, "Product title is required");
    }

    if (empty($year)) {
        array_push($err, "Product year published is required");
    }

    if (!checkdate(1, 1, $year)) {
        array_push($err, $year . "is not valid year");
    }

    if (empty($isbn)) {
        array_push($err, "Product ISBN is required");
    }

    if (strlen($isbn) > 13 || strlen($isbn) < 10) {
        array_push($err, "Product ISBN is not valid");
    }

    if (empty($price)) {
        array_push($err, "Product price is required");
    }
    if (empty($type)) {
        array_push($err, "Product type is required");
    }

    if (empty($publisher)) {
        array_push($err, "Product publisher is required");
    }

    if (empty($author)) {
        array_push($err, "Product author is required");
    }


    if (empty($err)) {

        $update_data = [
            "title" => $title,
            "yearPublished" => $year,
            "isbn" => $isbn,
            "product_type_id" => $type,
            "price" => $price,
            "publisher_id" => $publisher
        ];

        $result = $database->update("product", $update_data, ["id" => $id]);

        // print_r($database->error);
        if ($result) {
            
            $author_has_product = [];
            
            foreach ($author as $single) {
                array_push($author_has_product, ["author_id" => $single, "product_id" => $id]);
            }
            
            $database->delete("author_has_products", ["product_id" => $id]);
            // print_r($database->error);
            
            $result = $database->insert("author_has_products", $author_has_product);
            // print_r($database->error);

            if ($result) {
                set_flash("success", "Product updated successfully.");

                header("location:" . BASE_URL . "/product");
                exit;
            } else {
                set_flash("error", "Database Error Please Try Again");
            }
        } else {
            set_flash("error", "Database Error Please Try Again");
        }
    }
}
else {
    header("location:" . BASE_URL . "product");
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
                            <h1 class="m-0">Product</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>product">Product</a></li>
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
                                    <h3 class="card-title">Update Product</h3>
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

                                <form id="frm_product" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                    <input type="hidden" name="id" value="<?= (isset($data["id"])) ? $data["id"] : "" ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Product Title</label>
                                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter product title" value="<?= (isset($data["title"])) ? $data["title"] : "" ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Year Published</label>
                                                    <input type="text" name="yaerpublished" class="form-control" id="year" placeholder="Enter product year published" value="<?= (isset($data["yearPublished"])) ? $data["yearPublished"] : "" ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>ISBN</label>
                                                    <input type="text" name="isbn" class="form-control" id="isbn" placeholder="Enter product ISBN" value="<?= (isset($data["isbn"])) ? $data["isbn"] : "" ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="text" name="price" class="form-control" id="price" placeholder="Enter product price" value="<?= (isset($data["price"])) ? $data["price"] : "" ?>">
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Product Type</label>
                                                    <select class="form-control select2bs4" name="type" id="sl_type" style="width: 100%;">
                                                        <option value="">Please Select Option</option>
                                                        <?php $res = get_product_type_list();

                                                        foreach ($res as $single) {
                                                        ?>
                                                            <option <?php

                                                                    if ($data["product_type_id"] == $single["id"]) {
                                                                        echo "selected";
                                                                    }

                                                                    ?> value="<?= $single["id"] ?>"><?= $single["type"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Publisher</label>
                                                    <select class="form-control select2bs4" name="publisher" id="sl_publisher" style="width: 100%;">
                                                        <option value="">Please Select Option</option>
                                                        <?php $res = get_publisher();

                                                        foreach ($res as $single) {
                                                        ?>
                                                            <option <?php

                                                                    if ($data["publisher_id"] == $single["id"]) {
                                                                        echo "selected";
                                                                    }

                                                                    ?> value="<?= $single["id"] ?>"><?= $single["name"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                                <?php

                                                $authors = get_authors_by_product($data["id"]);

                                                ?>

                                                <div class="form-group">
                                                    <label>Author</label>
                                                    <select class="form-control select2bs4" name="author[]" multiple id="sl_author" style="width: 100%;">
                                                        <?php $res = get_authors();

                                                        foreach ($res as $single) {
                                                        ?>
                                                            <option <?php

                                                                    if (in_array($single["id"], $authors)) {
                                                                        echo "selected";
                                                                    }

                                                                    ?> value="<?= $single["id"] ?>"><?= $single["firstName"] . " " . $single["lastName"] ?></option>
                                                        <?php
                                                        }

                                                        ?>
                                                    </select>
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

        <!-- Main Footer -->
        <?php include_once "../layout/footer.php" ?>
    </div>


    <?php include_once "../layout/scripts.php" ?>
</body>

</html>