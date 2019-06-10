<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Grupos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos grupos do BioInfluencers.</p>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
              method="get" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
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
                        <th><a href="grupos.php?sort=n">Nome</a></th>
                        <th><a href="noticias.php?sort=c">Categoria</a></th>
                        <th>Estado</th>
                        <th>Comentários</th>
                        <th>Ação</th>


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
                    $query = "SELECT id_foruns, nome_forum, descricao, estado, categorias_id_categorias, id_categorias, nome_categoria FROM foruns INNER JOIN categorias ON foruns.categorias_id_categorias= categorias.id_categorias WHERE nome_forum LIKE ?";

                    if (isset($_GET["sort"])) {
                        if ($_GET["sort"] == "n") {
                            $ordem_listagem = "nome_forum";
                        } else {
                            if ($_GET["sort"] == "c") {
                                $ordem_listagem = "nome_categoria";
                            }
                        }

                        $query .= " ORDER BY " . $ordem_listagem . " ASC ";
                    }



                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $pesquisar);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_f, $nome, $descricao, $estado, $categorias_id, $id_cat, $nome_cat);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>
                    <tbody>
                    <tr>
                        <td><?= $nome ?></td>
                        <td><?=$nome_cat ?></td>
                        <td><?=$estado ?></td>
                        <td> <a href="comentarios.php?id_f=<?=$id_f?>">ver comentários</a></td>


                        <td>
                            <!-- Button trigger modal -->

                            <a  href="" data-toggle="modal" data-target="#exampleModal<?=$id_f?>"><i class="fas fa-info-circle"></i> </a>

                            <a href='editar_grupo.php?id=<?=$id_f?>'><i class="fas fa-edit"></i></a>

                            <a href="" data-toggle="modal" data-target="#apagar<?=$id_f?>"><i class="fas fa-trash"></i></a>

                        </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?=$id_f?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <?php

                            $link2 = new_db_connection();
                            $stmt2 = mysqli_stmt_init($link2);

                            $query2 = "SELECT id_foruns, nome_forum, descricao, estado, categorias_id_categorias, id_categorias, nome_categoria FROM foruns INNER JOIN categorias ON foruns.categorias_id_categorias= categorias.id_categorias WHERE id_foruns=?";


                            if (mysqli_stmt_prepare($stmt2, $query2)) {

                                mysqli_stmt_bind_param($stmt2, 'i', $id_f);
                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt2);
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt2, $id_f, $nome, $descricao, $estado, $categorias_id, $id_cat, $nome_cat);

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
                                    <h5>Nome do grupo:</h5>
                                    <p><?=$nome?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Categoria:</h5>
                                    <p><?=$nome_cat?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Descrição:</h5>
                                    <p><?=$descricao?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--MODAL PARA APAGAR-->
                    <div class="modal fade" id="apagar<?=$id_f?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <?php

                            $link3 = new_db_connection();
                            $stmt3 = mysqli_stmt_init($link3);

                            $query3 = "SELECT id_foruns, nome_forum FROM foruns WHERE id_foruns=?";


                            if (mysqli_stmt_prepare($stmt3, $query3)) {

                                mysqli_stmt_bind_param($stmt3, 'i', $id_f);
                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt3);
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt3, $id,$nome);

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
                                    <p>Tem a certeza que quer apagar o forum <?=$nome?>?</p>
                                    <a href="scripts/delete_grupo.php?id_f=<?=$id_f?>"><input type = "submit" value = "Eliminar" class="buttonCustomise"> </a>
                                    <button type="button" class="buttonCustomise" data-dismiss="modal">Cancelar</button>

                                </div>

                            </div>
                        </div>
                    </div>


                    <?php
                    }

                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Comentários</th>
                        <th>Ação</th>

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
