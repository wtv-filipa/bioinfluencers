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


    <body>


    <header class="sticky-top">

        <?php include "componentes/navbar.php"; ?>

    </header>

    <main class="container p-0 mb-5">

        <?php include "componentes/feed.php"; ?>

    </main>


    <!-- JavaScript-->

    <?php include "helpers/js.php"; ?>

    </body>

    </html>
    <?php

} else {
    header("Location: login.php");
}
?>