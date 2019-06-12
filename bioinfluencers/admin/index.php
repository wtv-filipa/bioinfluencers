<?php
session_start();

if (isset($_SESSION["nickname"])){
?>

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
    <!-- Sidebar -->
    <?php include "componentes/navigation.php"; ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php include "componentes/navbar_top.php"; ?>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <?php include "componentes/heading.php"; ?>
                <!--cartões com earnings pequenos-->
                <?php include "componentes/contador_utilizadores.php"; ?>
                <!-- graficos earnings-->
                <!--mais graficos-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <?php include "componentes/footer.php"; ?>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<!-- JavaScript-->
<?php include "helpers/js.php"; ?>

</body>

</html>
    <?php
} else {
header("Location: ../public/login.php");
}
?>