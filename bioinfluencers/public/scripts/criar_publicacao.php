<?php
session_start();
require_once "../connections/connection.php";



if (isset($_POST["comentar"]) && $_SESSION["id_utilizadores"] && (!isset($_FILES["fileToUpload"]))) {
    $id = $_SESSION["id_utilizadores"];
    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO partilhas(descricao, utilizadores_id_utilizadores_p) VALUES(?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'si', $descricao, $id);

        $descricao = $_POST['comentar'];


        // VALIDAÇÃO DO RESULTADO DO EXECUTE
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_close($stmt);
            mysqli_close($link);

            // SUCCESS ACTION
            header("Location: ../index.php");

        } else {

            // ERROR ACTION
            //header("Location: ../index.php");
            echo "Error:" . mysqli_stmt_error($stmt);
        }

    } else {

        // ERROR ACTION
        echo "erro";
        echo "Error:" . mysqli_error($link);
        mysqli_close($link);
    }
} else {

$target_dir = "../../admin/uploads/publicacao/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        if (isset($_POST["comentar"]) && isset($_SESSION["id_utilizadores"]) && isset($_FILES["fileToUpload"])) {


            $filename = $_FILES["fileToUpload"]["name"];

            $id = $_SESSION["id_utilizadores"];

            $link = new_db_connection();

            $stmt = mysqli_stmt_init($link);

            $query = "INSERT INTO partilhas(descricao, utilizadores_id_utilizadores_p) VALUES(?,?)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'si', $descricao, $id);

                $descricao = $_POST['comentar'];

                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                } else {
                    $last_id = mysqli_insert_id($link);
                    echo "$last_id";
                    //echo "ID: " . "$last_id";
                }

                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);

                $query2 = "INSERT INTO conteudos (filename, partilhas_id_partilhas)
                      VALUES (?,?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'si', $filename, $last_id);
                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (mysqli_stmt_execute($stmt2)) {

                        mysqli_stmt_close($stmt2);
                        mysqli_close($link2);

                        // SUCCESS ACTION
                        header("Location: ../index.php");

                    } else {
                        // ERROR ACTION
                        //header("Location: ../criar_grupo.php");
                        echo "Error:" . mysqli_stmt_error($stmt2);
                    }

                    //mysqli_stmt_close($stmt);
                    //mysqli_close($link);

                    // SUCCESS ACTION
                    //header("Location: ../index.php");

                } else {

                    // ERROR ACTION
                    //header("Location: ../index.php");
                    echo "Error:" . mysqli_stmt_error($stmt);
                }

            } else {

                // ERROR ACTION
                echo "Error:" . mysqli_error($link);
                mysqli_close($link);
            }


        } else {
            echo "fodeu gerau";
    }}}}



//header("Location: ../index.php");

//echo "Error:" . mysqli_stmt_error($stmt);
//echo "Error:" . mysqli_error($link);
