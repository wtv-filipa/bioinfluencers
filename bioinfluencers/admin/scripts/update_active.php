<?php

if (isset($_GET["id"]) && isset($_GET["a"])) {
    $id = $_GET["id"];
    $active = $_GET["a"];

    require_once("../connections/connection.php");

// Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    if ($active == 1) {
        $query = "UPDATE utilizadores
              SET active = 0
              WHERE id_utilizadores = ?";


    } else {
        $query = "UPDATE utilizadores
              SET active = 1
              WHERE id_utilizadores = ?";

    }

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {

            header("Location: ../administradores.php?msg=1");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {

        header("Location: ../administradores.php?msg=1");
    }
    /* close connection */

    header("Location: ../administradores.php?msg=0");
} else {

    header("Location: ../administradores.php?msg=1");
}