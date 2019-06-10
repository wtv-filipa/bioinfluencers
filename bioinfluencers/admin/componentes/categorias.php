<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
    <p class="mb-4">Aqui é possível gerir todas as categorias dos grupos.</p>

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
                        <th><a href="categorias.php?sort=n">Nome</a></th>
                        <th><a href="categorias.php?sort=d">Data de criação</a></th>
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
                    $query = "SELECT id_categorias, nome_categoria, data_criacao, descricao_c
                              FROM categorias WHERE nome_categoria LIKE ?";

                    if (isset($_GET["sort"])) {
                        if ($_GET["sort"] == "n") {
                            $ordem_listagem = "nome_categoria";
                        } else {
                            if ($_GET["sort"] == "d") {
                                $ordem_listagem = "data_criacao";
                            }
                        }

                        $query .= " ORDER BY " . $ordem_listagem . " ASC ";
                    }



                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $pesquisar);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_categoria,$nome_categoria, $data_criacao, $descricao);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>
                    <tbody>
                    <tr>
                        <td><?= $nome_categoria?></td>
                        <td><?= $data_criacao?></td>

                        <td>
                            <!-- Button trigger modal -->

                            <a  href="" data-toggle="modal" data-target="#exampleModal<?=$id_categoria?>"><i class="fas fa-info-circle"></i> </a>
                            <a href="editar_categorias.php?id=<?=$id_categoria?>"><i class="fas fa-edit"></i></a>

                            <a href="" data-toggle="modal" data-target="#apagar<?=$id_categoria?>"><i class="fas fa-trash"></i> </a>
                        </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?=$id_categoria?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <?php

                            $link2 = new_db_connection();
                            $stmt2 = mysqli_stmt_init($link2);

                            $query2 = "SELECT id_categorias, nome_categoria, data_criacao, descricao_c
                              FROM categorias WHERE id_categorias=?";


                            if (mysqli_stmt_prepare($stmt2, $query2)) {

                                mysqli_stmt_bind_param($stmt2, 'i', $id_categoria);
                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt2);
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt2, $id_categoria,$nome_categoria, $data_criacao, $descricao);

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
                                    <h5>Nome da Categoria:</h5>
                                    <p><?=$nome_categoria?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Data de criação</h5>
                                    <p><?=$data_criacao?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Descrição:</h5>
                                    <p><?=$descricao?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">

                                </div>

                            </div>
                        </div>
                    </div>


                    <!--MODAL PARA APAGAR-->
                    <div class="modal fade" id="apagar<?=$id_categoria?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <?php

                            $link3 = new_db_connection();
                            $stmt3 = mysqli_stmt_init($link3);

                            $query3 = "SELECT id_categorias, nome_categoria FROM categorias WHERE id_categorias=?";


                            if (mysqli_stmt_prepare($stmt3, $query3)) {

                                mysqli_stmt_bind_param($stmt3, 'i', $id_categoria);
                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt3);
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt3, $id_categoria,$nome_categoria );

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
                                    <p>Tem a certeza que quer apagar a categoria <?=$nome_categoria?>?</p>
                                    <a href="scripts/apagar_categorias.php?id=<?=$id_categoria?>"><input type = "submit" value = "Eliminar" class="buttonCustomise"> </a>
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
                        <th>Data de criação</th>
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
