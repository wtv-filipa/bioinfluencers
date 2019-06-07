<?php
if (isset($_GET["id"])  && isset($_POST["nome"]) && isset($_POST["local"])  && isset($_POST["data_inicio"])
    && isset($_POST["data_fim"]) && isset($_POST["hora_inicio"]) && isset($_POST["hora_fim"]) && isset($_POST["descricao"])
    && isset($_POST["responsavel"]) && isset($_POST["custos"])) {

    $id_evento = $_GET["id"];
    $nome = $_POST["nome"];
    $local= $_POST["local"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];
    $hora_inicio = $_POST["hora_inicio"];
    $hora_fim = $_POST["hora_fim"];
    $descricao = $_POST["descricao"];
    $responsavel = $_POST["responsavel"];
    $custos = $_POST["custos"];



    // We need the function!
    require_once("../connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE eventos
              SET nome=?, local=?, data_inicio = ?, data_fim=?, hora_inicio=?, hora_fim=?, descricao=?, responsavel=?, custos=? 
              WHERE id_eventos = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssssssii', $nome,  $local, $data_inicio, $data_fim,  $hora_inicio, $hora_fim, $descricao, $responsavel, $custos, $id_evento);


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

    header("Location: ../eventos.php");
}

?>
