<?php

require_once('../connections/connection.php');

$link = new_db_connection();

$stmt = mysqli_stmt_init($link); //create a prepared statement

$query = "SELECT id_utilizadores, nome, nickname, email, data_nascimento, descricao, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, nome_tipo
          FROM utilizadores";


if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    mysqli_stmt_execute($stmt); // Execute the prepared statement

    mysqli_stmt_bind_result($stmt, $id_utilizadores, $nome, $nickname, $email, $data_nascimento, $descricao, $pontos, $data_criacao, $tipos_id_tipos, $codigo_utilizador, $nome_tipo); // Bind results


    $result = mysqli_query($link, $query);

    $data = array();
    while ($row_result = mysqli_fetch_assoc($result)) {
        $row_result["id_utilizadores"] = htmlspecialchars($row_result["id_utilizadores"]);
        $row_result["nome"] = htmlspecialchars($row_result["nome"]);
        $row_result["nickname"] = htmlspecialchars($row_result["nickname"]);
        $row_result["email"] = htmlspecialchars($row_result["email"]);
        $row_result["data_nascimento"] = htmlspecialchars($row_result["data_nascimento"]);
        $row_result["descricao"] = htmlspecialchars($row_result["descricao"]);
        $row_result["pontos"] = htmlspecialchars($row_result["pontos"]);
        $row_result["data_criacao"] = htmlspecialchars($row_result["data_criacao"]);
        $row_result["tipos_id_tipos"] = htmlspecialchars($row_result["tipos_id_tipos"]);
        $row_result["codigo_utilizador"] = htmlspecialchars($row_result["codigo_utilizador"]);
        $row_result["nome_tipo"] = htmlspecialchars($row_result["nome_tipo"]);
        $data[] = $row_result;
    }

    print json_encode($data);
}
mysqli_close($link);
