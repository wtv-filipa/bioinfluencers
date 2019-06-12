<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Conteúdos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos conteúdos do BioInfluencers.</p>

    <div class="row">
        <div class="col-xl-12">
            <form action="scripts/upload.php" method="post" enctype="multipart/form-data">

                <div class="row">
                    <?php
                    require_once("connections/connection.php");
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_conteudos, tipos_conteudos_id_tiposconteudos1
                                                  FROM conteudos ";
                    if (mysqli_stmt_prepare($stmt, $query)) {


                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_cont1,$ref_tipo);
                        while (mysqli_stmt_fetch($stmt)) {

                            ?>


                            <!--colocar nome do forum-->
                            <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                                <label class="text-gray-800" for="nome">Seleciona uma imagem para upload:</label>

                                <div class="row">
                                <input type="file" name="fileToUpload" class="file-upload"/>
                                </div>
                            </div>

                            <div class="form-group row col-xl-6 col-lg-6 col-sm-6">
                                <label class="text-gray-800" for="cat">Categoria</label>
                                <select class="form-control" id="cat" name="tipo">
                                    <?php
                                    $stmt = mysqli_stmt_init($link);

                                    $query = "SELECT id_tiposconteudos, nome_tipo
                                                  FROM tipos_conteudos ";

                                    if (mysqli_stmt_prepare($stmt, $query)) {

                                        /* execute the prepared statement */
                                        if (mysqli_stmt_execute($stmt)) {
                                            /* bind result variables */
                                            mysqli_stmt_bind_result($stmt, $id_cont,$nome);

                                            /* fetch values */
                                            while (mysqli_stmt_fetch($stmt)) {
                                                if ($ref_tipo == $id_cont) {
                                                    $selected = "selected";
                                                } else {
                                                    $selected = "";
                                                }
                                                echo "\n\t\t<option value=\"$id_cont\" $selected>$nome</option>";
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


                            <input type="submit" value="Upload Image" name="Submit">

                            <?php
                        }

                        mysqli_stmt_close($stmt);
                        mysqli_close($link);

                    }
                    ?>
            </form>
        </div>
    </div>




    </div>
    <!-- /.container-fluid -->

