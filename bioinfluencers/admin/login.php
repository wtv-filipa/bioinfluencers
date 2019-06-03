<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Página Inicial</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css.php"; ?>

</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php
    require_once "connections/connection.php";
    new_db_connection();
    ?>






    <!-- Begin Page Content -->
    <div class="container-fluid">



        <!--cartões com earnings pequenos-->
        <?php include "componentes/login.php"; ?>

        <!-- graficos earnings-->


        <!--mais graficos-->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include "componentes/footer.php"; ?>
<!-- End of Footer -->


<!-- Logout Modal-->
<?php include "componentes/logout_modal.php"; ?>

<!-- JavaScript-->

<?php include "helpers/js.php"; ?>

</body>

</html>
