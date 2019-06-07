<?php
require_once "../connections/connection.php";


if (isset($_POST["nome"]) && isset($_POST["data_inicio"]) && isset($_POST["data_fim"]) && isset($_POST["hora_inicio"])  && isset($_POST["hora_fim"]) && isset($_POST["local"]) && isset($_POST["descricao"]) && isset($_POST["custos"]) && isset($_POST["responsavel"]) ) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO eventos (nome, data_inicio, data_fim, hora_inicio, hora_fim, local, descricao, custos, responsavel) VALUES (?,?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssssis', $nome, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $descricao, $custos, $responsavel);
        $nome = $_POST['nome'];
        $data_inicio= $_POST['data_inicio'];
        $data_fim= $_POST['data_fim'];
        $hora_inicio= $_POST['hora_inicio'];
        $hora_fim= $_POST['hora_fim'];
        $local= $_POST['local'];
        $descricao= $_POST['descricao'];
        $custos=$_POST['custos'];
        $responsavel= $_POST['responsavel'];

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../eventos.php");

        } else {
            // ERROR ACTION

            //header("Location: ../criar_evento.php");
            echo "Error:" . mysqli_stmt_error($stmt);
            echo "Error:" . mysqli_error($link);

        }

    } else {
        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {

    echo "Campos do formulário por preencher";
}
?>