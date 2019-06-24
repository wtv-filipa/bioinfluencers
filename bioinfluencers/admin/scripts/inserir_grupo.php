<?php
require_once "../connections/connection.php";


$target_dir = "../uploads/grupos/";
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

        if (isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_POST["categoria"]) && isset($_FILES["fileToUpload"])) {

            $ficheiro = $_FILES["fileToUpload"]["name"];
            //$tipo = $_POST["tipo"];
            // We need the function!
            require_once("../connections/connection.php");

// Create a new DB connection
            $link = new_db_connection();

            /* create a prepared statemet */
            $stmt = mysqli_stmt_init($link);

            $query = "INSERT INTO conteudos (filename)
                      VALUES (?)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 's', $ficheiro);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                } else {
                    $last_id = mysqli_insert_id($link);
                    //echo "ID: " . "$last_id";
                }
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                $query2 = "INSERT INTO grupos(nome_grupos, descricao_g, categorias_id_categorias, conteudos_id_conteudos) VALUES (?,?,?,?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'ssii', $nome_grupo, $descricao, $id_cat, $last_id);
                    $nome_grupo = $_POST['nome'];
                    $descricao = $_POST['descricao'];
                    $id_cat = $_POST['categoria'];

                    // VALIDAÇÃO DO RESULTADO DO EXECUTE
                    if (mysqli_stmt_execute($stmt2)) {

                        mysqli_stmt_close($stmt2);
                        mysqli_close($link2);

                        // SUCCESS ACTION
                        header("Location: ../grupos.php");

                    } else {
                        // ERROR ACTION
                        //header("Location: ../criar_grupo.php");
                        echo "Error:" . mysqli_stmt_error($stmt2);
                    }

                } else {
                    // ERROR ACTION
                    echo "Error:" . mysqli_error($link);
                    mysqli_close($link);

                }
            }
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}





