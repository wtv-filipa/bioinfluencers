<?php
if (isset($_GET["id"]) && isset($_POST["nome"]) && isset($_POST["categoria"]) && isset($_POST["descricao"])) {

    $id = $_GET["id"];
    $nome = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $descricao = $_POST["descricao"];


    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE grupos
              SET nome_grupos = ?, descricao_g = ?, categorias_id_categorias = ?
              WHERE id_grupos = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssii',$nome, $descricao, $categoria, $id);


        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../grupos.php?msg=10");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../grupos.php?msg=10");
    }
    /* close connection */
    mysqli_close($link);

    header("Location: ../grupos.php?msg=9");
}
