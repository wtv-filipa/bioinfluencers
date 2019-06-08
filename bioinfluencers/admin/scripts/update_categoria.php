<?php
if (isset($_GET["id"]) && isset($_POST["nome_categoria"]) && isset($_POST["descricao"])) {

    $id_categoria= $_GET["id"];
    $nome_categoria = $_POST["nome_categoria"];
    $descricao = $_POST["descricao"];

    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE categorias 
              SET nome_categoria = ?, descricao = ?
              WHERE id_categorias = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssi',$nome_categoria, $descricao, $id_categoria);

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
    mysqli_close($link);


    header("Location: ../categorias.php");
}

?>