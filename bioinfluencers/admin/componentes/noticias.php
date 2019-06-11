<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Notícias</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral das notícias da BioInfluencers.</p>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
              method="get" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..."
                       aria-label="Search" aria-describedby="basic-addon2" name="p">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th><a href="noticias.php?sort=t">Título</a></th>
                        <th><a href="noticias.php?sort=s">Subtitulo</a></th>
                        <th>Ações</th>

                    </tr>
                    </thead>
                    <?php
                    require_once("connections/connection.php");
                    if (isset($_GET["p"])) {

                        $pesquisar = "%" . $_GET["p"] . "%";
                    } else {

                        $pesquisar = "%";
                    }


                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT id_noticias, titulo, subtitulo, texto, data_hora FROM noticias WHERE titulo LIKE ?";

                    if (isset($_GET["sort"])) {
                        if ($_GET["sort"] == "t") {
                            $ordem_listagem = "titulo";
                        } else {
                            if ($_GET["sort"] == "s") {
                                $ordem_listagem = "subtitulo";
                            }
                        }

                        $query .= " ORDER BY " . $ordem_listagem . " ASC ";
                    }



                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $pesquisar);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt,  $id,$title, $subtitle, $text, $date);
                    while (mysqli_stmt_fetch($stmt)) {

                        ?>
                        <tbody>
                        <tr>
                            <td><?= $title?></td>
                            <td><?= $subtitle ?></td>

                            <td>
                                <!-- Button trigger modal -->

                                <a href="" data-toggle="modal" data-target="#exampleModalCenter<?=$id?>"><i class="fas fa-info-circle"></i></a>

                                <a href="editar_noticia.php?id=<?=$id?>"><i class="fas fa-edit"></i></a>

                                <a href="" data-toggle="modal" data-target="#apagar<?=$id?>"><i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                        </tbody>
                        <!-- Modal para mais infos-->
                        <div class="modal fade" id="exampleModalCenter<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <?php

                                $link2 = new_db_connection();
                                $stmt2 = mysqli_stmt_init($link2);

                                $query2 = "SELECT id_noticias, titulo, subtitulo, texto, data_hora FROM noticias WHERE id_noticias=?";


                                if (mysqli_stmt_prepare($stmt2, $query2)) {

                                    mysqli_stmt_bind_param($stmt2, 'i', $id);
                                    /* execute the prepared statement */
                                    mysqli_stmt_execute($stmt2);
                                    /* bind result variables */
                                    mysqli_stmt_bind_result($stmt2, $id,$title, $subtitle, $text, $date );

                                    /* resultados da store */
                                    mysqli_stmt_store_result($stmt2);
                                    while (mysqli_stmt_fetch($stmt2)) {
                                        echo ' ';
                                    }
                                }
                                ?>
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #78BE20; color:white">
                                        <h5 class="modal-title" id="exampleModalLabel">Mais info</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Título:</h5>
                                        <p><?=$title?></p>
                                        <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Subtítulo:</h5>
                                        <p><?=$subtitle?></p>
                                        <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Corpo da notícia:</h5>
                                        <p><?=$text?></p>
                                        <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Data de publicação:</h5>
                                        <p><?=$date?></p>
                                        <hr style="background-color: #78BE20; opacity: 0.3">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--MODAL PARA APAGAR-->
                    <div class="modal fade" id="apagar<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <?php

                            $link3 = new_db_connection();
                            $stmt3 = mysqli_stmt_init($link3);

                            $query3 = "SELECT id_noticias, titulo, subtitulo, texto, data_hora FROM noticias WHERE id_noticias=?";


                            if (mysqli_stmt_prepare($stmt3, $query3)) {

                                mysqli_stmt_bind_param($stmt3, 'i', $id);
                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt3);
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt3, $id,$title, $subtitle, $text, $date );

                                /* resultados da store */
                                mysqli_stmt_store_result($stmt3);
                                while (mysqli_stmt_fetch($stmt3)) {
                                    echo ' ';
                                }
                            }
                            ?>
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #78BE20; color:white">
                                    <h5 class="modal-title" id="exampleModalLabel">Apagar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Tem a certeza que quer apagar a notícia <?=$title?>?</p>
                                    <a href="scripts/delete_noticias.php?id=<?=$id?>"><input type = "submit" value = "Eliminar" class="buttonCustomise"> </a>
                                    <button type="button" class="buttonCustomise" data-dismiss="modal">Cancelar</button>

                                </div>

                            </div>
                        </div>
                    </div>


                        <?php
                    }

                    ?>
                    <tfoot>
                    <tr>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Ações</th>

                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>
<?php
/* close statement */
mysqli_stmt_close($stmt);

/* close connection */
mysqli_close($link);
}
?>
<!-- /.container-fluid -->
