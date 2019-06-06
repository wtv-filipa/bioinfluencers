<?php

require_once("../connections/connection.php");

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);
$query = "SELECT id_utilizadores, nickname, password, tipos_id_tipos FROM utilizadores WHERE nickname LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 's', $nickname);
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id,$nickname, $passwordx, $tipo);

    if (mysqli_stmt_fetch($stmt)) {
        if (password_verify($password, $passwordx)) {
            session_start();
            //$_SESSION['role'] = $role;
            $_SESSION["nickname"] = $nickname;

            $_SESSION['id_utilizadores'] = $id;
            // feedback de sucesso
            header("Location: ../index.php");

        } else {
            // feedback de erro geral devido à password estar errada
            echo "pass errada";
            //header("Location: ../index.php");
        }
    } else {
        // feedback de erro feral devido ao username estar errado
        echo "nickname errado";
        //header("Location: ../index.php?msg=#2login");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

?>
