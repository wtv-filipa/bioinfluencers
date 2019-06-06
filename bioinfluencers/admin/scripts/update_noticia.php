
<?php
if (isset($_GET["id"]) && isset($_POST["titulo"]) && isset($_POST["subtitulo"]) && isset($_POST["texto"])) {
    $id_noticia= $_GET["id"];
    $titulo = $_POST["titulo"];
    $subtitulo = $_POST["subtitulo"];
    $texto = $_POST["texto"];

    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE noticias
              SET titulo = ?, subtitulo = ?, texto = ?
              WHERE id_noticias = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssi',$titulo, $subtitulo, $texto, $id_noticia);

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

    header("Location: ../noticias.php");
}

?>