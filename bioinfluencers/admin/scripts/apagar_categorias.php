<?php
if(isset($_GET["id"])){
    $id_categorias= $_GET["id"];

require_once "../connections/connection.php";

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM categorias WHERE id_categorias= ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_categorias);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (!mysqli_stmt_execute($stmt)) {

            header("Location: ../categorias.php?msg=0");

        }

        mysqli_stmt_close($stmt);
    }else {
        header("Location: ../categorias.php?msg=0");
    }
    mysqli_close($link);

    header("Location: ../categorias.php?msg=1");


}
?>