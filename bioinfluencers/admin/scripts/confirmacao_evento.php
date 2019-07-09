<?php

require_once "../connections/connection.php";

if (isset($_GET['confirma']) && isset($_GET['u'])){
    echo "estou a confirmar";
    $id_evento=$_GET['confirma'];
    $id_u=$_GET['u'];


// Create a new DB connection
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizadores_has_eventos (utilizadores_id_utilizadores, eventos_id_eventos) VALUE (?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $id_u, $id_evento);

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

    //header("Location: ../participantes.php?id_e=$id_evento");
    //echo "inseriu";

    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);
    $query2 = "SELECT id_utilizadores, pontos FROM utilizadores WHERE id_utilizadores = ?";

    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'i', $id_u);
        mysqli_stmt_bind_result($stmt2, $id_u, $pontos_u);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt2)) {
            mysqli_stmt_fetch($stmt2);
            var_dump($pontos_u);
            var_dump($id_u);

            $pontos_u = $pontos_u + 500;

            $link3 = new_db_connection();
            $stmt3 = mysqli_stmt_init($link3);
            $query3 = "UPDATE utilizadores SET pontos = ? WHERE id_utilizadores = ?";
            echo $pontos_u;

            if (mysqli_stmt_prepare($stmt3, $query3)) {
                echo $pontos_u;
                mysqli_stmt_bind_param($stmt3, 'ii', $pontos_u, $id_u);
                if (mysqli_stmt_execute($stmt3)) {

                    echo $pontos_u;
                    echo "<br>";
                    //echo "OLHA FEZ!!!!";
                    header("Location: ../participantes.php?id_e=$id_evento");
                }

            } else {
                // ERROR ACTION
                //header("Location: ../codigo_evento.php?msg=0");
            }
        }
    }

} else if (isset($_GET['cancela']) && isset($_GET['u'])){
    echo "estou a cancelar";
    $id_evento=$_GET['cancela'];
    $id_u=$_GET['u'];

    // Create a new DB connection
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "DELETE FROM utilizadores_has_eventos WHERE eventos_id_eventos=? AND utilizadores_id_utilizadores =?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $id_evento, $id_u);

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

    echo "foi para cancelar";
    $link2 = new_db_connection();
    $stmt2 = mysqli_stmt_init($link2);
    $query2 = "SELECT id_utilizadores, pontos FROM utilizadores WHERE id_utilizadores = ?";

    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'i', $id_u);
        mysqli_stmt_bind_result($stmt2, $id_u, $pontos_u);

        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt2)) {
            mysqli_stmt_fetch($stmt2);
            var_dump($pontos_u);
            var_dump($id_u);

            $pontos_u = $pontos_u - 500;

            $link3 = new_db_connection();
            $stmt3 = mysqli_stmt_init($link3);
            $query3 = "UPDATE utilizadores SET pontos = ? WHERE id_utilizadores = ?";
            echo $pontos_u;

            if (mysqli_stmt_prepare($stmt3, $query3)) {
                echo $pontos_u;
                mysqli_stmt_bind_param($stmt3, 'ii', $pontos_u, $id_u);
                if (mysqli_stmt_execute($stmt3)) {

                    echo $pontos_u;
                    echo "<br>";
                    //echo "OLHA FEZ!!!!";
                     header("Location: ../participantes.php?id_e=$id_evento");
                }

            } else {
                // ERROR ACTION
                //header("Location: ../codigo_evento.php?msg=0");
            }
        }
    }


}