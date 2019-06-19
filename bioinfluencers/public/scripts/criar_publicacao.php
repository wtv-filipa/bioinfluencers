<?php

    require_once "../connections/connection.php";


if (isset($_POST["comentar"])) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO partilhas(descricao) VALUES(?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $descricao);

        $descricao = $_POST['comentar'];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../index.php");

        } else {

            // ERROR ACTION
            header("Location: ../index.php");
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {

        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
}


header("Location: ../index.php");
?>