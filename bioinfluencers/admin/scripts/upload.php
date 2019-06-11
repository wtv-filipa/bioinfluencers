<?php
if (isset($_FILES["fileToUpload"])) {

    $ficheiro = $_FILES["fileToUpload"]["name"];
    $tipo=$_POST["tipo"];
    // We need the function!
    require_once("../connections/connection.php");

// Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statemet */
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO conteudos (filename, tipos_conteudos_id_tiposconteudos1)
              VALUES (?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'si',$ficheiro, $tipo);

        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)){
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            header("Location: ../conteudos.php");
        }

        /* close statement */
        mysqli_stmt_close($stmt);
    }

    /* close connection */
    mysqli_close($link);
}

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


header("Location: ../conteudos.php");
    // mysql_query("update SQL statement ");

