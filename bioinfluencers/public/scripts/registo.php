<?php
require_once "../connections/connection.php";

if (isset($_POST["nome"]) && isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["data_nasc"])) {

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores (nome, nickname, password, email, data_nascimento, descricao, codigo_utilizador) VALUES (?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssssss', $nome, $nickname,  $password_hash, $email, $data_nasc, $descricao, $codigo_uti);
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nickname = $_POST['nickname'];
        $data_nasc = $_POST["data_nasc"];
        $descricao = $_POST["descricao"];

        $codigo_uti = strtoupper(substr(md5(date("YmdHis")), 1,12));

        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../login.php?msg=1");
        } else {
            // ERROR ACTION

            header("Location: ../register.php?msg=0");
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {
        // ERROR ACTION
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {
    //echo "Error:" . mysqli_error($link);
    echo "Campos do formulário por preencher";
}