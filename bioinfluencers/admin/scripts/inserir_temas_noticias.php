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
            header("Location: ../temas_noticias.php?msg=1");

        } else {

            // ERROR ACTION
            header("Location: ../criar_tema_noticia.php?msg=3");

        }

    } else {

        // ERROR ACTION
        header("Location: ../criar_tema_noticia.php?msg=3");
        mysqli_close($link);

    }
} else {

    header("Location: ../criar_tema_noticia.php?msg=4");
    echo "Campos do formulário por preencher";
};


