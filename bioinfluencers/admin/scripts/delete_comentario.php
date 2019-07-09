<?php

if (isset($_GET["id_f"]) && isset($_GET["id_c"])) {
    $id_f = $_GET["id_f"];
    $id_c = $_GET["id_c"];

    require_once "../connections/connection.php";

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM grupo_comentarios WHERE id_grupocomentarios = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_c);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            header("Location: ../comentarios.php?id_g=$id_f&msg=0");

        }

        mysqli_stmt_close($stmt);
    } else {

        header("Location: ../comentarios.php?id_g=$id_f&msg=0");
    }
    mysqli_close($link);

    header("Location: ../comentarios.php?id_g=$id_f&msg=1");


}