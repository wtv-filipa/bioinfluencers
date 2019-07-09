<?php


if (isset($_GET["id"])) {
    $id_evento= $_GET["id"];

    require_once "../connections/connection.php";

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM eventos WHERE id_eventos= ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_evento);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            header("Location: ../eventos.php?msg=0");

        }

        mysqli_stmt_close($stmt);
    } else {

        header("Location: ../eventos.php?msg=0");
    }
    mysqli_close($link);

    header("Location: ../eventos.php?msg=1");


}
