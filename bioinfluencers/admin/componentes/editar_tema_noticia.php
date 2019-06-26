<?php

if (isset($_GET["id"])){
    $id_temas= $_GET["id"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_temas, nome_tema FROM temas_noticias WHERE id_temas = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_temas);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_temas, $temas_noticias);
        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Editar o tema da notícia "<?= $temas_noticias?>"</h1>
                <p class="mb-4">Aqui é possível editar/atualizar os temas da noticias.</p>
                <div class="row">
                    <div class="col-xl-12">


                        <!--FORM-->

                        <form method="post" action="scripts/update_tema_noticia.php?id=<?=$id_temas?>">
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
                                    <label class="text-gray-800" for="titulo">Tema</label>
                                    <input type="text" class="form-control" id="titulo" placeholder="Indique o tema" name="titulo" value="<?=$temas_noticias?>">
                                </div>

                                <div class="form-group col-8">
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
