<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"])) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO temas_noticias(nome_tema) VALUES (?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $nome_tema);
        $nome_tema = $_POST['nome'];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {


            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../temas_noticias.php");

        } else {

            // ERROR ACTION
            header("Location: ../temas_noticias.php");
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {

        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);

    }
} else {

    echo "Error:" .mysqli_error($link);
    echo "Campos do formulário por preencher";
};


