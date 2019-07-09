<?php
require_once "../connections/connection.php";

$target_dir = "../uploads/eventos/";
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
        header("Location: ../criar_evento.php?msg=5");
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    header("Location: ../criar_evento.php?msg=6");
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 70000000) {
    header("Location: ../criar_evento.php?msg=7");
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    header("Location: ../criar_evento.php?msg=8");
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header("Location: ../criar_evento.php?msg=4");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        if (isset($_POST["nome"]) && isset($_POST["data_inicio"]) && isset($_POST["data_fim"]) && isset($_POST["local"]) && isset($_POST["descricao"]) && isset($_POST["custos"]) && isset($_POST["responsavel"]) && isset($_POST["tema_noticia"]) && isset($_POST["grupo"]) && isset($_FILES["fileToUpload"])) {

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
                    header("Location: ../criar_evento.php?msg=3");
                } else {
                    $last_id = mysqli_insert_id($link);
                    echo "ID: " . "$last_id";
                }
                $link2 = new_db_connection();
                $stmt2 = mysqli_stmt_init($link2);
                $query2 = "INSERT INTO eventos (nome, data_inicio, data_fim, local, descricao, custos, grupos_id_grupos, responsavel, conteudos_id_conteudos, tema_evento_idtema_evento) VALUES (?,?,?,?,?,?,?,?,?,?)";

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_bind_param($stmt2, 'sssssiisii', $nome, $data_inicio, $data_fim, $local, $descricao, $custos, $grupos_id_grupos, $responsavel, $last_id, $tema_evento_idtema_evento);

                    $nome = $_POST['nome'];
                    $data_inicio = $_POST['data_inicio'];
                    $data_fim = $_POST['data_fim'];
                    $local = $_POST['local'];
                    $descricao = $_POST['descricao'];
                    $custos = $_POST['custos'];
                    $responsavel = $_POST['responsavel'];
                    $grupos_id_grupos = $_POST["grupo"];
                    $tema_evento_idtema_evento = $_POST["tema_noticia"];

                    // Devemos validar também o resultado do execute!
                    if (mysqli_stmt_execute($stmt2)) {
                        mysqli_stmt_close($stmt2);
                        mysqli_close($link2);

                        // Acção de sucesso
                        header("Location: ../eventos.php?msg=2");
                        //echo "DEU";
                    } else {
                        // Acção de erro
                        //echo "Error:" . mysqli_stmt_error($stmt);
                        //echo "Error:" . mysqli_error($link2);
                        header("Location: ../criar_evento.php?msg=3");

                    }
                } else {
                    // Acção de erro
                    header("Location: ../criar_evento.php?msg=3");
                    mysqli_close($link);
                }
            }
        }
    } else {
        header("Location: ../criar_evento.php?msg=4");
        echo "Sorry, there was an error uploading your file.";
    }
}


