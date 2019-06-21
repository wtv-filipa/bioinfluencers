<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["categoria"])){

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO grupos(nome_grupos, descricao_g, categorias_id_categorias) VALUES (?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssi', $nome_grupo, $descricao, $id_cat);
        $nome_grupo = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $id_cat = $_POST['categoria'];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../grupos.php");

        } else {
            // ERROR ACTION
            header("Location: ../criar_grupo.php");
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


