<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["descricao"])) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO categorias(nome_categoria, descricao_c) VALUES (?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ss', $nome_c, $descricao);
        $nome_c = $_POST['nome'];
        $descricao = $_POST['descricao'];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {


            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../categorias.php?msg=2");

        } else {

            // ERROR ACTION
            header("Location: ../categorias.php?msg=3");

        }

    } else {

        // ERROR ACTION
        header("Location: ../categorias.php?msg=3");
        mysqli_close($link);

    }
} else {

    header("Location: ../categorias.php?msg=4");
    //echo "Campos do formulário por preencher";
};


