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
            //echo "olha vai ao evento!";
            header("Location: ../evento_indv.php?id_e=".$id_e."");
        } else {
            // ERROR ACTION
            header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");
        }

    } else {
        // ERROR ACTION
        header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");
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

            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (!mysqli_stmt_execute($stmt3)) {

                header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");

            }

            mysqli_stmt_close($stmt3);
        }else {

            header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");
        }
        mysqli_close($link3);

        header("Location: ../evento_indv.php?id_e=".$id_e."");




    }
}





if (isset($_GET['vai']) && isset($_SESSION['id_utilizadores'])) {

    $id_e= $_GET["vai"];
    $id_navegar= $_SESSION["id_utilizadores"];
    $vai= "vai";


echo "estou a funcionar até aqui :)";

    $link4 = new_db_connection();

    $stmt4 = mysqli_stmt_init($link4);

    $query4 = "INSERT INTO rsvp (eventos_interesse, utilizadores_interessados, status) VALUES (?,?,?)";


    if (mysqli_stmt_prepare($stmt4, $query4)) {
        mysqli_stmt_bind_param($stmt4, 'iis',  $id_e, $id_navegar, $vai);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt4)){
            mysqli_stmt_close($stmt4);
            mysqli_close($link4);

            // SUCCESS ACTION
            //echo "olha vai ao evento!";
            header("Location: ../evento_indv.php?id_e=".$id_e."");
        } else {
            // ERROR ACTION
            header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");
            echo "Error:" . mysqli_stmt_error($stmt4);
        }

    } else {
        // ERROR ACTION
        header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");
        mysqli_close($link4);
    }


}else {
    if (isset($_GET['naovai']) && isset($_SESSION['id_utilizadores'])) {

        $id_e= $_GET["naovai"];
        $id_navegar= $_SESSION["id_utilizadores"];



        $link5 = new_db_connection();

        $stmt5 = mysqli_stmt_init($link5);

        $query5 = "DELETE FROM rsvp WHERE eventos_interesse=? AND utilizadores_interessados=?";

        if (mysqli_stmt_prepare($stmt5, $query5)) {
            mysqli_stmt_bind_param($stmt5, 'ii', $id_e, $id_navegar);

            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (!mysqli_stmt_execute($stmt5)) {
                header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");

            }

            mysqli_stmt_close($stmt5);
        }else {

            header("Location: ../evento_indv.php?id_e=".$id_e."&msg=1");
        }
        mysqli_close($link5);

        //echo "deixou de seguir o evento";
        header("Location: ../evento_indv.php?id_e=".$id_e."");




    }
}
