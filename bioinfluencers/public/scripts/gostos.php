<?php
session_start();
require_once "../connections/connection.php";

if (isset($_GET["g"]) && isset($_SESSION['id_utilizadores'])) {
    $id_partilhas = $_GET["g"];
    $id_utilizadores = $_SESSION['id_utilizadores'];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO gostos (utilizadores_id_utilizadores, partilhas_id_partilhas) VALUES (?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $id_utilizadores, $id_partilhas);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            echo "olha gostou!";
            // SUCCESS ACTION
            header("Location: ../index.php");
        } else {
            // ERROR ACTION

            //header("Location: ../register.php?msg=0");
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {


        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    if (isset($_GET["ng"]) && isset($_SESSION['id_utilizadores'])) {
        $id_partilhas = $_GET["ng"];
        $id_utilizadores = $_SESSION['id_utilizadores'];

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "DELETE FROM gostos WHERE utilizadores_id_utilizadores = ? AND partilhas_id_partilhas = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ii', $id_utilizadores, $id_partilhas);


            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (!mysqli_stmt_execute($stmt)) {

                echo "ERROR:".mysqli_error($link);

            }

            mysqli_stmt_close($stmt);
        }else {

            echo "Error:" . mysqli_stmt_error($stmt);
        }
        mysqli_close($link);

        header("Location: ../index.php");
        //echo "ok nao gosto";
    }
}

