<?php
session_start();
require_once "../connections/connection.php";


if (isset($_GET['interessado']) && isset($_SESSION['id_utilizadores'])) {

    $id_e= $_GET["interessado"];
    $id_navegar= $_SESSION["id_utilizadores"];
    $interessado= "interessado";

    echo $id_e;
    echo $id_navegar;

    $link2 = new_db_connection();

    $stmt2 = mysqli_stmt_init($link2);

    $query2 = "INSERT INTO rsvp (eventos_interesse, utilizadores_interessados, status) VALUES (?,?,?)";


    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'iis',  $id_e, $id_navegar, $interessado);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt2)){
            mysqli_stmt_close($stmt2);
            mysqli_close($link2);

            // SUCCESS ACTION
            echo "olha vai ao evento!";
            header("Location: ../evento_indv.php?id_e=".$id_e."");
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


}else {
    if (isset($_GET['naointeressado']) && isset($_SESSION['id_utilizadores'])) {

        $id_e= $_GET["naointeressado"];
        $id_navegar= $_SESSION["id_utilizadores"];

        echo $id_e;
        echo $id_navegar;

        $link3 = new_db_connection();

        $stmt3 = mysqli_stmt_init($link3);

        $query3 = "DELETE FROM rsvp WHERE eventos_interesse=? AND utilizadores_interessados=?";

        if (mysqli_stmt_prepare($stmt3, $query3)) {
            mysqli_stmt_bind_param($stmt3, 'ii', $id_e, $id_navegar);

            //header("Location: ../evento_indv.php?id_e=$id_e");
            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (!mysqli_stmt_execute($stmt3)) {

                echo "ERROR:" . mysqli_error($link3);

            }

            mysqli_stmt_close($stmt3);
        }else {

            echo "Error:" . mysqli_stmt_error($stmt3);
        }
        mysqli_close($link3);

        echo "deixou de seguir";
        header("Location: ../evento_indv.php?id_e=".$id_e."");




    }
}
