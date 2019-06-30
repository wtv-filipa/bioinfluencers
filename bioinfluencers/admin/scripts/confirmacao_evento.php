<?php

if(isset($_GET["id_e"]))
require_once "../connections/connection.php";

// Create a new DB connection
$link = new_db_connection();

/* create a prepared statement */
$stmt = mysqli_stmt_init($link);

$query = "UPDATE utilizadores_has_eventos
          SET utilizadores_id_utilizadores = ?, eventos_id_eventos = ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $id);

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

header("Location: ../participantes.php");

