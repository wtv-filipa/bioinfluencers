<?php
require_once "../connections/connection.php";

if(isset($_POST["codigo"])) {
    $codigo = $_POST["codigo"];

    var_dump($codigo);

    $array_utilizacao_codigo = array();
    $registo_ja_existe = in_array($codigo, $array_utilizacao_codigo);

    if ($registo_ja_existe == "") {
        array_push($array_utilizacao_codigo, $codigo);

        var_dump($array_utilizacao_codigo);


        $link2 = new_db_connection();
        $stmt = mysqli_stmt_init($link2);
        $query = "SELECT id_utilizadores, pontos, codigo_utilizador FROM utilizadores WHERE codigo_utilizador = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $codigo);
            mysqli_stmt_bind_result($stmt, $id_u, $pontos_u, $codigo);

            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_fetch($stmt);
                var_dump($pontos_u);
                var_dump($id_u);

                $pontos_u = $pontos_u + 10;

                $link3 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link3);
                $query2 = "UPDATE utilizadores SET pontos = ? WHERE id_utilizadores = ?";
                echo $pontos_u;

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    echo $pontos_u;
                    mysqli_stmt_bind_param($stmt2, 'ii', $pontos_u, $id_u);
                    if (mysqli_stmt_execute($stmt2)) {

                        echo $pontos_u;
                        echo "<br>";
                        //echo "OLHA FEZ!!!!";
                        //header("Location: ../codigo_evento.php");
                    }

                } else {
                    // ERROR ACTION
                    //header("Location: ../register.php?msg=0");
                    echo "Error:" . mysqli_stmt_error($stmt2);
                }
            }
        }
    }

    } else {
        echo "DEU MERD*";
    }


