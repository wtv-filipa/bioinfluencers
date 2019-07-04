<?php

        if (isset($_GET["id"]) && isset($_POST["nome"])  && isset($_POST["email"]) && isset($_POST["data_nasc"])   && isset($_POST["descricao"]) ) {
            $id_user = $_GET["id"];
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $data_nasc = $_POST["data_nasc"];
            $descricao = $_POST["descricao"];

            // We need the function!
            require_once("../connections/connection.php");

            // Create a new DB connection
            $link = new_db_connection();

            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);

            $query = "UPDATE utilizadores
              SET nome_u = ?, email=?, data_nascimento=?, descricao_u = ?
              WHERE id_utilizadores = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $data_nasc, $descricao, $id_user);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                /* close statement */
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($link);
            }

            if (isset($_POST["edit"])){
                $nickname=$_POST["edit"];
                echo $nickname;
                header("Location: ../editar_conta.php?edit=".$nickname."");
            }
            /* close connection */
            mysqli_close($link);
        }

?>

