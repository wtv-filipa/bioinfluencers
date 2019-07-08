<?php
session_start();
require_once "../connections/connection.php";

echo " hey hey hey";

if (isset($_GET['segue']) && isset($_SESSION['id_utilizadores'])){
    $id= $_GET["segue"];
    $id_navegar= $_SESSION["id_utilizadores"];

    echo "estás para seguir";

    $link2 = new_db_connection();

    $stmt2 = mysqli_stmt_init($link2);

    $query2 = "INSERT INTO utilizadores_has_utilizadores (utilizadores_id_utilizadores, seguidores) VALUES (?,?)";

    if (mysqli_stmt_prepare($stmt2, $query2)) {
        mysqli_stmt_bind_param($stmt2, 'ii', $id, $id_navegar);


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt2)) {
            mysqli_stmt_close($stmt2);
            mysqli_close($link2);
            echo "olha seguiu!";
            // SUCCESS ACTION
            header("Location: ../profile.php?user=".$id."");
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
    if (isset($_GET['naosegue']) && isset($_SESSION['id_utilizadores'])) {

        $id= $_GET["naosegue"];
        $id_navegar= $_SESSION["id_utilizadores"];

        echo "estás a deixar de seguir";

        $link3 = new_db_connection();

        $stmt3 = mysqli_stmt_init($link3);

        $query3 = "DELETE FROM utilizadores_has_utilizadores WHERE utilizadores_id_utilizadores=? AND seguidores=?";

        if (mysqli_stmt_prepare($stmt3, $query3)) {
            mysqli_stmt_bind_param($stmt3, 'ii', $id, $id_navegar);


            // VALIDAÇÃO DO RESULTADO DO EXECUTE
            if (!mysqli_stmt_execute($stmt3)) {

                echo "ERROR:".mysqli_error($link3);

            }

            mysqli_stmt_close($stmt3);
        }else {

            echo "Error:" . mysqli_stmt_error($stmt3);
        }
        mysqli_close($link3);

        echo "deixou de seguir";
        header("Location: ../profile.php?user=".$id."");



    }
}