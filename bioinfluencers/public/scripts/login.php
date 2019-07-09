<?php

if (isset($_POST["nickname"]) && isset($_POST["password"])){

    require_once("../connections/connection.php");

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);
    $query = "SELECT id_utilizadores, nickname, password, tipos_id_tipos, active FROM utilizadores WHERE nickname LIKE ? ";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $nickname);
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id,$nickname, $passwordx, $tipo, $active);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $passwordx)) {
                if ($active == 1){
                    session_start();
                    $_SESSION["nickname"] = $nickname;
                    $_SESSION["tipo"] = $tipo;
                    $_SESSION["id_utilizadores"] = $id;
                    $link3 = new_db_connection();


                    //seguir nós mesmos por causa do feed

                    $stmt3 = mysqli_stmt_init($link3);

                    $query3 = "SELECT utilizadores_id_utilizadores
FROM utilizadores_has_utilizadores
WHERE utilizadores_id_utilizadores = ? AND seguidores = ?";

                    if (mysqli_stmt_prepare($stmt3, $query3)) {

                        mysqli_stmt_bind_param($stmt3, 'ii', $id, $id);
                        mysqli_stmt_execute($stmt3);
                        mysqli_stmt_bind_result($stmt3, $id);


                        if (!mysqli_stmt_fetch($stmt3)) {
                           //echo "ahajha0";
                            $id= $_SESSION["id_utilizadores"];
                            echo $id;

                            $id_navegar= $_SESSION["id_utilizadores"];

                            //inserir o código caso o user ainda não o tenha na bd

                            $link2 = new_db_connection();

                            $stmt2 = mysqli_stmt_init($link2);

                            $query2 = "INSERT INTO utilizadores_has_utilizadores (utilizadores_id_utilizadores, seguidores) VALUES (?,?)";

                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'ii', $id, $id);


                                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                if (mysqli_stmt_execute($stmt2)) {
                                    mysqli_stmt_close($stmt2);
                                    mysqli_close($link2);
                                    // SUCCESS ACTION

                                } else {
                                    // ERROR ACTION
                                    header("Location: ../login.php?msg=2");

                                }

                            } else {
                                // ERROR ACTION
                                header("Location: ../login.php?msg=2");
                                mysqli_close($link2);
                            }




                        }
                    }

                    //update para organizador
                    $_SESSION["id_utilizadores"] = $id;

                    $link4 = new_db_connection();
                    $stmt4 = mysqli_stmt_init($link4);
                    $query4 = "SELECT id_utilizadores, pontos, tipos_id_tipos
                              FROM utilizadores 
                              WHERE id_utilizadores = ?";

                    if (mysqli_stmt_prepare($stmt4, $query4)) {
                        mysqli_stmt_bind_param($stmt4, 'i', $id);
                        mysqli_stmt_bind_result($stmt4, $id, $pontos_u, $tipo);

                        // VALIDAÇÃO DO RESULTADO DO EXECUTE
                        if (mysqli_stmt_execute($stmt4)) {
                            mysqli_stmt_fetch($stmt4);


                            if (isset($pontos_u) && $pontos_u >= 10000 && $tipo== 2){

                                var_dump($pontos_u);
                                var_dump($id);
                                var_dump($tipo);

                                $tipo_id= 3;
                                $_SESSION["id_utilizadores"] = $id;

                                $link5 = new_db_connection();
                                $stmt5 = mysqli_stmt_init($link5);
                                $query5 = "UPDATE utilizadores SET tipos_id_tipos = ? WHERE id_utilizadores = ?";
                                echo $pontos_u;

                                if (mysqli_stmt_prepare($stmt5, $query5)) {

                                    mysqli_stmt_bind_param($stmt5, 'ii', $tipo_id, $id);
                                    if (mysqli_stmt_execute($stmt5)) {

                                        echo $id;
                                        echo "<br>";
                                        //echo "OLHA FEZ!!!!";
                                        header("Location: ../index.php");

                                    }

                                } else {
                                    // ERROR ACTION
                                    header("Location: ../login.php?msg=2");

                                }

                            }

                            /*
                          */
                        }
                    }


                    /***********************************************/

                    // feedback de sucesso
                    header("Location: ../index.php");


                } else {
                    header("Location: ../login.php?msg=1");
                }

            } else {
                // feedback de erro geral devido à password estar errada
                //echo "pass errada";
                header("Location: ../login.php?msg=0");
            }
        } else {
            // feedback de erro feral devido ao username estar errado
            //echo "nickname errado";
            header("Location: ../login.php?msg=0");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }

}

?>
