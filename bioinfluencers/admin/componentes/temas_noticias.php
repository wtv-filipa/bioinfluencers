<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Temas das Notícias</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos temas das notícias da BioInfluencers.</p>


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

        <a href="criar_tema_noticia.php" class="mr-4 ml-md-3 my-2 my-md-0 mw-2">Criar tema <i class="fa fa-plus-square fa-1x" aria-hidden="true"></i></a>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th><a href="temas_noticias.php?sort=t">Tema</a></th>
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
                    $query = "SELECT id_temas, nome_tema FROM temas_noticias WHERE nome_tema LIKE ?";

                    if (isset($_GET["sort"])) {
                        if ($_GET["sort"] == "t") {
                            $ordem_listagem = "tema";
                        }

                        $query .= " ORDER BY " . $ordem_listagem . " ASC ";
                    }



                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $pesquisar);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt,  $id,$tema_noticia);
                    while (mysqli_stmt_fetch($stmt)) {

                        ?>
                        <tbody>
                        <tr>

                            <td><?=$tema_noticia?></td>

                            <td>
                                <!-- Button trigger modal -->

                                <!--<a href="" data-toggle="modal" data-target="#exampleModalCenter<?=$id?>"><i class="fas fa-info-circle"></i></a>-->

                                <a href="editar_tema_noticia.php?id=<?=$id?>"><i class="fas fa-edit"></i></a>

                                <a href="" data-toggle="modal" data-target="#apagar<?=$id?>"><i class="fas fa-trash"></i></a>
                            </td>

                        </tr>
                        </tbody>



                        <div class="modal fade" id="apagar<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <?php

                                $link3 = new_db_connection();
                                $stmt3 = mysqli_stmt_init($link3);

                                $query3 = "SELECT id_temas, nome_tema FROM temas_noticias WHERE id_temas LIKE ?";


                                if (mysqli_stmt_prepare($stmt3, $query3)) {

                                    mysqli_stmt_bind_param($stmt3, 'i', $id);
                                    /* execute the prepared statement */
                                    mysqli_stmt_execute($stmt3);
                                    /* bind result variables */
                                    mysqli_stmt_bind_result($stmt3, $id,$tema_noticia);

                                    /* resultados da store */
                                    mysqli_stmt_store_result($stmt3);
                                    while (mysqli_stmt_fetch($stmt3)) {
                                        echo ' ';
                                    }
                                }

                                //PAGINAÇÃO
                                $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

                                //Selecionar todos os temas
                                $result_temas = "SELECT * FROM temas_noticias";

                                $resultado_temas = mysqli_query($local_link, $result_temas);

                                //Contar o total de temas
                                $total_temas = mysqli_num_rows($resultado_temas);

                                //Quantidade de temas por página
                                $quantidade_temas = 5;

                                //Cálculo de número de páginas necessárias para apresentar os temas
                                $num_pagina = ceil($total_temas/$quantidade_temas);

                                //Calcular o inicio da visualização
                                $inicio = ($quantidade_temas * $pagina) - $quantidade_temas;

                                //Selecionar os temas a ser apresentados na página
                                $result_temas = "SELECT * FROM temas_noticias limit 5 $inicio, $quantidade_temas";

                                $resultado_temas = mysqli_query($local_link, $result_temas);

                                $total_temas = mysqli_num_rows($resultado_temas);

                                //ACABOU PAGINAÇÃO

                                ?>
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #78BE20; color:white">
                                        <h5 class="modal-title" id="exampleModalLabel">Apagar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem a certeza que quer apagar o tema <?=$tema_noticia?>?</p>
                                        <a href="scripts/delete_tema_noticias.php?id=<?=$id?>"><input type = "submit" value = "Eliminar" class="buttonCustomise"> </a>
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
                        <th>Tema</th>
                        <th>Ações</th>

                    </tr>
                    </tfoot>
                </table>

                <?php

                $pagina_anterior= $pagina - 1;
                $pagina_posterior= $pagina + 1;
                ?>

                <nav aria-label="Navegação de página exemplo">
                    <ul class="pagination">
                        <li class="page-item">
                            <?php

                            if($pagina_anterior != 0){ ?>

                                <a class="page-link" href="#" aria-label="Anterior">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>

                            <?php }?>



                        </li>

                            <?php
                            //Apresentar a paginação

                            for($i = 1; $i < $num_pagina + 1; $i++){ ?>

                                <li class="page-item">
                                    <a class="page-link" href="temas_noticias.php?pagina=<?= $id?>"><?= $i?></a>
                                </li>

                        <?php } ?>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Próximo">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Próximo</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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
