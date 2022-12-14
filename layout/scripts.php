 <!-- Harshil Trivedi (8804546)
Shiv Ahir (8809928)
Harsh Nakrani (8812036) -->
 <!-- jQuery -->

 <script src="<?= BASE_URL ?>plugins/jquery/jquery.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/jquery-validation/jquery.validate.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/jquery-validation/additional-methods.js"></script>
 <!-- Bootstrap 4 -->
 <script src="<?= BASE_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="<?= BASE_URL ?>dist/js/adminlte.min.js"></script>

 <script src="<?= BASE_URL ?>plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/select2/js/select2.full.min.js"></script>
 <script src="<?= BASE_URL ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>

 <script>
   const base_url = "<?= BASE_URL ?>";
 </script>

 <script src="<?= BASE_URL ?>dist/js/custom.js"></script>
 <script src="<?= BASE_URL ?>dist/js/frm_validation.js"></script>


 <?php

  if (isset($_SESSION['flash_success'])) {

    $flash_message = $_SESSION['flash_success'];

    echo '<script>
      Swal.fire({
        position: "top-right",
        icon: "success",
        title: "' . $flash_message . '",
        showConfirmButton: false,
        timer: 3000,
        toast: true
      });
    </script>';


    unset($_SESSION['flash_success']);
  }

  if (isset($_SESSION['flash_error'])) {

    $flash_message = $_SESSION['flash_error'];

    echo '<script>
      Swal.fire({
        position: "top-right",
        icon: "error",
        title: "' . $flash_message . '",
        showConfirmButton: false,
        timer: 3000,
        toast: true
      });
    </script>';


    unset($_SESSION['flash_error']);
  }


  ?>