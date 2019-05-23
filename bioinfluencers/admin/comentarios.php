<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Comentários</title>

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
            <!-- tabela que mostra os fóruns disponíveis -->

            <?php include "componentes/forum_comentarios.php" ?>
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


<!-- Logout Modal-->
<?php include "componentes/logout_modal.php"; ?>

<!-- JavaScript-->

<?php include "helpers/js.php"; ?>

</body>

</html>





