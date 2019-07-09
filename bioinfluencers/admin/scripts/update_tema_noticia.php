
<?php
if (isset($_GET["id"]) && isset($_POST["titulo"])) {
    $id_temas = $_GET["id"];
    $titulo = $_POST["titulo"];

    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE temas_noticias
              SET nome_tema = ?
              WHERE id_temas = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'si',$titulo, $id_temas);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../temas_noticias.php?msg=6");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../temas_noticias.php?msg=6");
    }
    /* close connection */
    mysqli_close($link);

    header("Location: ../temas_noticias.php?msg=5");
}

?>