<?php

if (isset($_GET["id"])) {
    $id_tema = $_GET["id"];

    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM temas_noticias
              WHERE id_temas = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i',$id_tema );

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../temas_noticias.php?msg=0");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../temas_noticias.php?msg=0");
    }

    /* close connection */
    mysqli_close($link);

    header("Location: ../temas_noticias.php?msg=1");

}

?>