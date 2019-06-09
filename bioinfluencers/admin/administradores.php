<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Administradores</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->
    <?php include "helpers/css.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(':submit').on('click', function () {
                var button = $(this).val();
                $.ajax({ // ajax call starts
                    url: 'ajax/modal_uti.php', // JQuery loads serverside.php
                    data: 'button=' + $(this).val(), // Send value of the clicked button
                    dataType: 'json', // Choosing a JSON datatype
                    type: 'GET', // Default is GET
                })
                    .done(function (data) {
                        $('#texto').html('');

                        if (button == 'texto') {
                            for (var i in data) {
                                $('#texto').append('<h3>' + data[i]["nome"] + '</h3>');
                                $('#texto').append('<p>' + data[i]["nickname"] + '</p>');
                                $('#texto').append('<hr>');
                            }
                        }
                    })
                    .fail(function () { // Se existir um erro no pedido
                        $('#texto').html('Data error'); // Escreve mensagem de erro na listagem de vinhos
                    })
                ;
                return false; // keeps the page from not refreshing
            });
        });
    </script>

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
            <?php include "componentes/admin.php"; ?>
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
