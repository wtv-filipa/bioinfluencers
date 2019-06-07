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

            echo "ERROR:" . mysqli_error($stmt);

        }

        mysqli_stmt_close($stmt);
    } else {

        echo "Error:" . mysqli_stmt_error($stmt);
    }
    mysqli_close($link);

    header("Location: ../eventos.php");


}
