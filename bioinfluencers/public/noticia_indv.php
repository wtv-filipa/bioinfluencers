<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <?php

    require_once "connections/connection.php";

    $id_n = $_GET["id_n"];

    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT titulo
          FROM noticias 
          WHERE id_noticias LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_n );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome);

        while (mysqli_stmt_fetch($stmt)) {

            echo "<title>$nome</title>";
        }
    }


    ?>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->

    <?php include "helpers/css.php"; ?>

</head>


<body>
<header class="sticky-top ">

    <?php include "componentes/navbar.php"; ?>

</header>

<main class="p-0 container">

    <?php include "componentes/noticia_indv.php"; ?>

</main>

<!-- JavaScript-->

<?php include "helpers/js.php"; ?>

</body>

</html>