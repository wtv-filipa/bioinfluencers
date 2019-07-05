<?php
session_start();
// We need the function!
require_once("../connections/connection.php");

if (isset($_GET['comentario']) && isset($_SESSION['id_utilizadores']) && isset($_POST['comentario'])){
    echo "vou";

    $id_g= $_GET['comentario'];
    $id_navegar=$_SESSION['id_utilizadores'];
    $mensagem=$_POST['comentario'];


    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO grupo_comentarios (mensagem, 	utilizadores_id_utilizadores, 	grupos_id_grupos) VALUES (?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sii', $mensagem, $id_navegar, $id_g);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);
            echo "comentario inserido!";
            // SUCCESS ACTION
            header("Location: ../grupo_indv.php?id_g=".$id_g."");
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

}