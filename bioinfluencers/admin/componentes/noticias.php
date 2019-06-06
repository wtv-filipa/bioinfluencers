<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Notícias</h1>
    <p class="mb-4">Aqui é possível fazer update das notícias e verificar quais já se encontram publicadas, podendo ser atualizadas se necessário.</p>
    <div class="row">
        <div class="col-xl-12">


            <!--FORM-->

            <form method="post" action="scripts/inserir_noticias.php">
                <div class="row">
                <!--upload de imagem de capa da notícia
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img1">Imagem principal</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img1" class="file-upload" />
                    </div>
                </div>
-->

                <!--colocar título da notícia-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" placeholder="Indique o título" name="titulo">
                </div>

                <!--colocar subtítulo da notícia-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="subtitulo">Subtítulo</label>
                    <input type="text" class="form-control" id="subtitulo" placeholder="Indique o subtítulo" name="subtitulo">
                </div>

                <!--colocar corpo da notícia-->
                <div class="form-group col-12">
                    <label class="text-gray-800" for="corpo">Corpo da notícia</label>
                    <textarea type="text" class="form-control" id="corpo" placeholder="Insira o texto relativo à notícia" name="texto"></textarea>
                </div>

                <!--upload de imagem adicional
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img2">Imagem adicional</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img2" class="file-upload" />
                    </div>
                </div>

                <!--upload de imagem adicional
                <div class="form-group col-12">
                    <label class="text-gray-800" for="img2">Imagem adicional</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="img2" class="file-upload" />
                    </div>
                </div>
-->


                <div class="form-group col-3">
                    <button class="buttonCustomise"> Criar </button>
                </div>
                </div>
            </form>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary textCustom">Notícias</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Corpo da notícia</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Corpo da notícia</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                    </tfoot>

                    <?php

                    require_once "connections/connection.php";

                    $link= new_db_connection(); //Create a new DB connection
                    $stmt = mysqli_stmt_init($link); //create a prepared statement

                    $query = "SELECT id_noticias, titulo, subtitulo, texto, data_hora FROM noticias"; // Define the query
                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                        mysqli_stmt_bind_result($stmt, $id, $title, $subtitle, $text, $date); // Bind results


                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tbody>
                    <tr>
                        <td>$title</td>
                        <td>$subtitle</td>
                        <td>$text</td>
                        <td></td>
                        <td>
                            <i class=\"fas fa-trash\"></i>
                            <i class=\"fas fa-ban\"></i>
                            <i class=\"fas fa-edit\"></i></td>
                    </tr>

                    </tbody>";

                        }
                    }

                    ?>



                </table>
            </div>
        </div>
    </div>



</div>