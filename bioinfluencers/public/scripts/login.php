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

                    $stmt3 = mysqli_stmt_init($link3);

                    $query3 = "SELECT utilizadores_id_utilizadores
FROM utilizadores_has_utilizadores
WHERE utilizadores_id_utilizadores = ? AND seguidores = ?";

                    if (mysqli_stmt_prepare($stmt3, $query3)) {

                        mysqli_stmt_bind_param($stmt3, 'ii', $id, $id);
                        mysqli_stmt_execute($stmt3);
                        mysqli_stmt_bind_result($stmt3, $id);


                        if (!mysqli_stmt_fetch($stmt3)) {
                           echo "ahajha0";
                            $id= $_SESSION["id_utilizadores"];
                            echo $id;

                            $id_navegar= $_SESSION["id_utilizadores"];

                            echo "estás para seguir";

                            $link2 = new_db_connection();

                            $stmt2 = mysqli_stmt_init($link2);

                            $query2 = "INSERT INTO utilizadores_has_utilizadores (utilizadores_id_utilizadores, seguidores) VALUES (?,?)";

                            if (mysqli_stmt_prepare($stmt2, $query2)) {
                                mysqli_stmt_bind_param($stmt2, 'ii', $id, $id);


                                // VALIDAÇÃO DO RESULTADO DO EXECUTE
                                if (mysqli_stmt_execute($stmt2)) {
                                    mysqli_stmt_close($stmt2);
                                    mysqli_close($link2);
                                    echo "olha seguiu!";
                                    // SUCCESS ACTION

                                } else {
                                    // ERROR ACTION

                                    //header("Location: ../register.php?msg=0");
                                    echo "Error:" . mysqli_stmt_error($stmt2);
                                }

                            } else {


                                // ERROR ACTION
                                echo "Error:" . mysqli_error($link2);
                                mysqli_close($link2);
                            }




                        }
                    }



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
