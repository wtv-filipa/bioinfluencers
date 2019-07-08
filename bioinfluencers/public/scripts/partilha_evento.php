<?php
session_start();
require_once "../connections/connection.php";

if(isset($_GET["e"])) {

    $id_u = $_SESSION["id_utilizadores"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "INSERT INTO partilhas (utilizadores_id_utilizadores_p, eventos_id_eventos) VALUES(?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $id_u, $id_e);
        $id_e = $_GET["e"];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../index.php");

        } else {
            // ERROR ACTION
            $id_e = $_GET["e"];
            header("Location: ../evento_indv.php?id_e=".$id_e."&msg=0");
        }
    }
}