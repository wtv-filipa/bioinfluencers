<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>TOP</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->

    <?php include "helpers/css.php"; ?>

</head>


<body id="fundo_top">
<header class="sticky-top">

    <?php include "componentes/navbar.php"; ?>

</header>

<main class="container mb-5 p-0">

    <?php include "componentes/top.php"; ?>

</main>


<!-- JavaScript-->

<?php include "helpers/js.php"; ?>

</body>

</html>

