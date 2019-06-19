<?php

require_once "../connections/connection.php";


if (isset($_POST["nomeEvento"]) &&
    isset($_POST["dataInicio"]) &&
    isset($_POST["dataFim"])    &&
    isset($_POST["horaInicio"]) &&
    isset($_POST["horaFim"])    &&
    isset($_POST["local"])      &&
    isset($_POST["descricao"])  &&
    isset($_POST["preco"])      &&
    isset($_POST["organizador"])){

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO eventos(nome, data_inicio, data_fim, hora_inicio, hora_fim, local, descricao, custos, responsavel) 
              VALUES(?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'sssssssis', $nome, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $descricao, $custos, $responsavel);

        $nome = $_POST["nomeEvento"];
        $data_inicio = $_POST["dataInicio"];
        $data_fim = $_POST["dataFim"];
        $hora_inicio = $_POST["horaInicio"];
        $hora_fim = $_POST["horaFim"];
        $local = $_POST["local"];
        $descricao = $_POST["descricao"];
        $custos = $_POST["preco"];
        $responsavel = $_POST["organizador"];


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../index.php");

        } else {

            // ERROR ACTION
            header("Location: ../index.php");
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {

        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
}


header("Location: ../index.php");
?>