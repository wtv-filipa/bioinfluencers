<?php
session_start();
// We need the function!
require_once("../connections/connection.php");

if (isset($_GET['comentario']) && isset($_SESSION['id_utilizadores']) && isset($_POST['comentario'])){
    echo "vou";

    $id_g= $_GET['comentario'];
    $id_navegar=$_SESSION['id_utilizadores'];
    $mensagem=$_POST['comentario'];
    $titulo= $_POST['titulo'];


    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO grupo_comentarios (titulo_comentarios,mensagem, 	utilizadores_id_utilizadores, 	grupos_id_grupos) VALUES (?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssii', $titulo,$mensagem, $id_navegar, $id_g);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            echo "comentario inserido!";
            // SUCCESS ACTION
            header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=1");
        } else {
            // ERROR ACTION
            header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
        }

    } else {
        // ERROR ACTION
        header("Location: ../grupo_indv.php?id_g=".$id_g."&msg=0");
        mysqli_close($link);
    }

}