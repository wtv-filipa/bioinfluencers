<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Criar uma notícia</h1>
    <p class="mb-4">Aqui é possível criar novas notícias.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 3:
                $message = "Ocorreu um erro ao inserir a notícia, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 4:
                $message = "Ocorreu um erro ao inserir o seu ficheiro, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 5:
                $message = "O ficheiro inserido não é uma imagem.";
                $class = "alert-warning";
                break;
            case 6:
                $message = "O ficheiro inserido já existe.";
                $class = "alert-warning";
                break;
            case 7:
                $message = "O ficheiro inserido é demasiado grande.";
                $class = "alert-warning";
                break;
            case 8:
                $message = "Apenas ficheiros JPG, JPEG, PNG e GIF são aceites";
                $class = "alert-warning";
                break;
            default:
                $msg_show = false;
        }

        echo "<div class=\"alert $class alert-dismissible fade show mt-2\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
        if ($msg_show) {
            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
        }
    }
    ?>



    <div class="row">
        <div class="col-xl-12">


            <!--FORM-->

            <form method="post" action="scripts/inserir_noticias.php" enctype="multipart/form-data">
                <div class="row">
                    <?php
                    require_once("connections/connection.php");
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_noticias, titulo, subtitulo, texto, temas_id_temas
                              FROM noticias";
                    if (mysqli_stmt_prepare($stmt, $query)) {


                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_noticias, $titulo, $subtitulo, $texto, $temas_id_temas);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>
                    <!--colocar título da notícia-->
                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" placeholder="Indique o título"
                               name="titulo">
                    </div>

                    <!--colocar subtítulo da notícia-->
                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="subtitulo">Subtítulo</label>
                        <input type="text" class="form-control" id="subtitulo" placeholder="Indique o subtítulo"
                               name="subtitulo">
                    </div>

                    <!--colocar corpo da notícia-->
                    <div class="form-group col-12">
                        <label class="text-gray-800" for="corpo">Corpo da notícia</label>
                        <textarea type="text" class="form-control" id="corpo"
                                  placeholder="Insira o texto relativo à notícia" name="texto"></textarea>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="cat">Temas</label>
                        <select class="form-control" id="cat" name="tema">
                            <?php
                            $stmt = mysqli_stmt_init($link);

                            $query = "SELECT id_temas, nome_tema FROM temas_noticias";

                            if (mysqli_stmt_prepare($stmt, $query)) {

                                /* execute the prepared statement */
                                if (mysqli_stmt_execute($stmt)) {
                                    /* bind result variables */
                                    mysqli_stmt_bind_result($stmt, $id_t, $nome_tema);

                                    /* fetch values */
                                    while (mysqli_stmt_fetch($stmt)) {
                                        if ($temas_id_temas == $id_t) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "\n\t\t<option value=\"$id_t\" $selected>$nome_tema</option>";
                                    }
                                } else {
                                    echo "Error: " . mysqli_stmt_error($stmt);
                                }

                                /* close statement */
                                //mysqli_stmt_close($stmt);
                            } else {
                                echo "Error: " . mysqli_error($link);
                            }

                            /* close connection */
                            //mysqli_close($link);
                            ?>
                        </select>
                    </div>

                    <div class="col-xl-12">
                            <div class="row">
                                <div class="form-group col-xl-6 col-lg-6 col-sm-6 mt-2">
                                        <!--colocar nome do forum-->

                                            <label class="text-gray-800" for="nome">Seleciona uma imagem para
                                                upload:</label>

                                            <div class="row">
                                                <input type="file" name="fileToUpload" class="file-upload ml-3"/>
                                            </div>
                                        </div>


                                        <div class="form-group col-12 mt-3">
                                            <button class="buttonCustomise" type="submit" value="Upload Image" name="Submit"> Criar</button>
                                        </div>

                                        <?php

                                }
                                }


                                ?>
                            </div>
                    </div>
                </div>
        </div>