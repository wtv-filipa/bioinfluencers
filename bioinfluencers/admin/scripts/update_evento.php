<?php
if (isset($_GET["id"])  && isset($_POST["nome"]) && isset($_POST["local"])  && isset($_POST["data_inicio"])
    && isset($_POST["data_fim"]) && isset($_POST["descricao"])
    && isset($_POST["responsavel"]) && isset($_POST["custos"]) && isset($_POST["tema_noticia"]) && isset($_POST["grupo"])) {

    $id_evento = $_GET["id"];
    $nome = $_POST["nome"];
    $local= $_POST["local"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
    $descricao = $_POST["descricao"];
    $responsavel = $_POST["responsavel"];
    $custos = $_POST["custos"];
    $grupos_id_grupos = $_POST["grupo"];
    $tema_evento_idtema_evento = $_POST["tema_noticia"];


    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE eventos
              SET nome=?, data_inicio = ?, data_fim=?,  local=?, descricao=?, custos=?, grupos_id_grupos=?, responsavel=?, tema_evento_idtema_evento=?
              WHERE id_eventos = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssssiisii', $nome,   $data_inicio, $data_fim, $local, $descricao, $custos, $grupos_id_grupos, $responsavel, $tema_evento_idtema_evento, $id_evento);


        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../eventos.php?msg=10");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    } else {
        header("Location: ../eventos.php?msg=10");
    }
    /* close connection */
    mysqli_close($link);

    header("Location: ../eventos.php?msg=9");
}

?>
