    <?php
require_once "../connections/connection.php";


$target_dir = "../../admin/uploads/img_perfil/";
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


        if (isset($_GET["id"]) && isset($_POST["nome"]) && isset($_POST["descricao"]) && isset($_FILES["fileToUpload"])) {
            $id_user= $_GET["id"];
            $nome= $_POST["nome"];
            $descricao = $_POST["descricao"];
            $ficheiro = $_FILES["fileToUpload"]["name"];

            // We need the function!
            require_once("../connections/connection.php");

            // Create a new DB connection
            $link = new_db_connection();

            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);

            $query = "UPDATE utilizadores
              SET nome_u = ?, descricao_u = ?, img_perfil = ?
              WHERE id_utilizadores = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'sssi',$nome, $descricao, $ficheiro, $id_user);

                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                /* close statement */
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($link);
            }

            header("Location: ../index.php");
            /* close connection */
            mysqli_close($link);
        }


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>

