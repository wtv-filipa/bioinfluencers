<?php
require_once "../connections/connection.php";

if (isset($_GET["id_e"]) && isset($_GET["id_u"]) && (!isset($_GET["s"]))) {

    $id_evento = $_GET["id_e"];
    $id_u = $_GET["id_u"];

// Create a new DB connection
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores_has_eventos (utilizadores_id_utilizadores, eventos_id_eventos, status_atual) VALUE (?,?, 'confirmado')";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $id_u, $id_evento);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($link);
    }
    /* close connection */

    //header("Location: ../participantes.php?id_e=$id_evento");
    echo "foi para confirmar";
} else {
    $id_evento = $_GET["id_e"];
    $id_u = $_GET["id_u"];

// Create a new DB connection
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM utilizadores_has_eventos WHERE eventos_id_eventos=? AND utilizadores_id_utilizadores =?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $id_evento, $id_u);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($link);
    }
    /* close connection */

    //header("Location: ../participantes.php?id_e=$id_evento");
    echo "foi para cancelar";
}
