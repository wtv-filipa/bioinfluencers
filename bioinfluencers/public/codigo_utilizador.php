<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Meu código</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->

    <?php include "helpers/css.php"; ?>

</head>


<body id="fundo_codigo">
<header class="sticky-top">

    <?php include "componentes/navbar.php"; ?>

</header>

<main class="">

    <?php include "componentes/codigo_utilizador.php"; ?>

</main>


<!-- JavaScript-->

<?php include "helpers/js.php"; ?>

</body>

</html>
