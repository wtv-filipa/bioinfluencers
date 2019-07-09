<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
    <p class="mb-4">Aqui é possível gerir todas as categorias dos grupos.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Ocorreu um erro ao apagar a categoria, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 1:
                $message = "Categoria apagada com sucesso!";
                $class = "alert-success";
                break;
            case 2:
                $message = "Categoria inserida com sucesso!";
                $class = "alert-success";
                break;
            case 3:
                $message = "Ocorreu um erro ao inserir a categoria, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 4:
                $message = "Campos do fomulário por preencher.";
                $class = "alert-warning";
                break;
            case 5:
                $message = "Categoria atualizada com sucesso!";
                $class = "alert-success";
                break;
            case 6:
                $message = "Ocorreu um erro ao atualizar a categoria, por favor tente novamente...";
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search mb-4"
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

        <div class="mt-3">
        <a href="criar_categorias.php" class="mr-4 ml-md-3 my-2 my-md-0 mw-2 mt-4">Criar categoria <i class="fa fa-plus-square fa-1x" aria-hidden="true"></i></a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de criação</th>
                        <th>Ação</th>


                    </tr>
                    </thead>
                    <?php
                    require_once("connections/connection.php");

                    $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);

                        $pagina_atual = filter_input(INPUT_GET,'p', FILTER_SANITIZE_NUMBER_INT);

                        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                        $qtn_result_pg = 5;

                        $inicio = ($qtn_result_pg * $pagina) - $qtn_result_pg;

                        $result_temas = "SELECT id_categorias, nome_categoria, data_criacao, descricao_c
                                        FROM categorias 
                                        ORDER BY id_categorias DESC
                                        LIMIT $inicio, $qtn_result_pg";

                        $resultado_temas = mysqli_query($link, $result_temas);


                    //Prepared Statements
                    if (mysqli_stmt_prepare($stmt, $result_temas)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_categorias, $nome_categoria, $data_criacao, $descricao_c);

                    while ($row_temas = mysqli_fetch_assoc($resultado_temas)){
                    ?>
                    <tbody>
                    <tr>
                        <td><?= $row_temas['nome_categoria'] ?></td>
                        <td><?= $row_temas['data_criacao'] ?></td>

                        <td>
                            <!-- Button trigger modal -->

                            <a href="" data-toggle="modal"
                               data-target="#exampleModal<?= $row_temas['id_categorias'] ?>"><i
                                        class="fas fa-info-circle"></i> </a>
                            <a href="editar_categorias.php?id=<?= $row_temas['id_categorias'] ?>"><i
                                        class="fas fa-edit"></i></a>

                            <a href="" data-toggle="modal" data-target="#apagar<?= $row_temas['id_categorias'] ?>"><i
                                        class="fas fa-trash"></i> </a>
                        </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $row_temas['id_categorias'] ?>" tabindex="-1"
                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #78BE20; color:white">
                                    <h5 class="modal-title" id="exampleModalLabel">Mais info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Nome da Categoria:</h5>
                                    <p><?= $row_temas['nome_categoria'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Data de criação</h5>
                                    <p><?= $row_temas['data_criacao'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Descrição:</h5>
                                    <p><?= $row_temas['descricao_c'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">

                                </div>

                            </div>
                        </div>
                    </div>


                    <!--MODAL PARA APAGAR-->
                    <div class="modal fade" id="apagar<?= $row_temas['id_categorias'] ?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                mysqli_stmt_bind_result($stmt3, $id_categoria, $nome_categoria);

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
                                    <p>Tem a certeza que quer apagar a categoria <?= $row_temas['nome_categoria'] ?>
                                        ?</p>
                                    <a href="scripts/apagar_categorias.php?id=<?= $row_temas['id_categorias'] ?>"><input
                                                type="submit" value="Eliminar" class="buttonCustomise"> </a>
                                    <button type="button" class="buttonCustomise" data-dismiss="modal">Cancelar</button>

                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    }

                    $result_pg = "SELECT COUNT(id_categorias) AS num_result FROM categorias";
                    $link2 = new_db_connection();

                    $resultado_pg = mysqli_query($link2, $result_pg);

                    $row_pg = mysqli_fetch_assoc($resultado_pg);

                    $quantidade_pg = ceil($row_pg['num_result'] / $qtn_result_pg);

                    $max_links = 5;
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


                <nav>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <?php

                                echo "<li class='page-item'><a class='page-link' href='categorias.php?p=1'>Primeira</a></li>";

                                for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){

                                    if($pag_ant >= 1){
                                        echo "<li class='page-item'><a class='page-link' href='categorias.php?p=$pag_ant'>$pag_ant</a>";
                                    }
                                }

                                echo "<li class='page-item'><a style='background-color: lightgrey;' class='page-link' href='categorias.php?p=$pagina'>$pagina</a>";

                                for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){

                                    if($pag_dep <= $quantidade_pg){

                                        echo "<li class='page-item'><a class='page-link' href='categorias.php?p=$pag_dep'>$pag_dep</a>";
                                    }
                                }

                                echo "<li class='page-item'><a class='page-link' href='categorias.php?p=$quantidade_pg'>Última</a>";
                                ?>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
