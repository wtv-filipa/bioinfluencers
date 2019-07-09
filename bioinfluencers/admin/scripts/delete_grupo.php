<?php
if (isset($_GET["id_f"])) {
    $id_f = $_GET["id_f"];

    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM foruns
              WHERE id_foruns = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i',$id_f );

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../grupos.php?msg=0");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../grupos.php?msg=0");
    }

    /* close connection */
    mysqli_close($link);

    header("Location: ../grupos.php?msg=1");

}

?>