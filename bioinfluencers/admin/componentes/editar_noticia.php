<?php

if (isset($_GET["id"])){
    $id_noticia= $_GET["id"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_noticias, titulo, subtitulo, texto FROM noticias WHERE id_noticias = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_noticia);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_noticia, $titulo, $subtitulo, $texto);
        while (mysqli_stmt_fetch($stmt)) {
                                        ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Editar a notícia " <?= $titulo?> "</h1>
                <p class="mb-4">Aqui é possível editar/atualizar notícias novas notícias.</p>
                <div class="row">
                    <div class="col-xl-12">


                        <!--FORM-->

                        <form method="post" action="scripts/update_noticia.php?id=<?=$id_noticia?>">
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
                                    <input type="text" class="form-control" id="titulo" placeholder="Indique o título" name="titulo" value="<?= $titulo?>">
                                </div>

                                <!--colocar subtítulo da notícia-->
                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="subtitulo">Subtítulo</label>
                                    <input type="text" class="form-control" id="subtitulo" placeholder="Indique o subtítulo" name="subtitulo" value="<?= $subtitulo?>">
                                </div>

                                <!--colocar corpo da notícia-->
                                <div class="form-group col-12">
                                    <label class="text-gray-800" for="corpo">Corpo da notícia</label>
                                    <input style="height: 100px"  type="text" class="form-control" id="corpo" placeholder="Insira o texto relativo à notícia" name="texto" value="<?= $texto?>">
                                </div>

                                <!--upload de imagem adicional-
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
                                    <button class="buttonCustomise"> Editar </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}
        ?>
