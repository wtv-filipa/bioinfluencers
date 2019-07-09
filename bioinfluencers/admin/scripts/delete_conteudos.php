<?php

if (isset($_GET["id"])) {
    $id_c = $_GET["id"];

    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM conteudos
              WHERE id_conteudos = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i',$id_c );

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../conteudos.php?msg=0");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../conteudos.php?msg=0");
    }

    /* close connection */
    mysqli_close($link);

    header("Location: ../conteudos.php?msg=1");

}
