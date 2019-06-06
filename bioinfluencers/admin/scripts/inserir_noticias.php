<?php
require_once "../connections/connection.php";

if (isset($_POST["titulo"]) && isset($_POST["subtitulo"]) && isset($_POST["texto"])) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO noticias (titulo, subtitulo, texto) VALUES (?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sss', $titulo, $subtitulo, $texto);
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $texto = $_POST["texto"];

        // Devemos validar também o resultado do execute!
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // Acção de sucesso
            header("Location: ../noticias.php");
        } else {
            header("Location: ../noticias.php");
            //echo"hello";
            // Acção de erro
            //echo "Error:" . mysqli_stmt_error($stmt);
            //header("Location: ../index.php?msg=0");

        }

    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    echo "Campos do formulário por preencher";
}

