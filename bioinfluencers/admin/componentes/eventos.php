<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Eventos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos eventos do BioInfluencers.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Ocorreu um erro ao apagar o evento, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 1:
                $message = "Evento apagado com sucesso!";
                $class = "alert-success";
                break;
            case 2:
                $message = "Evento inserido com sucesso!";
                $class = "alert-success";
                break;
            case 9:
                $message = "Evento atualizado com sucesso!";
                $class = "alert-success";
                break;
            case 10:
                $message = "Ocorreu um erro ao atualizar o evento, por favor tente novamente...";
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

        <div class="mt-3">
            <a href="criar_evento.php" class="mr-4 ml-md-3 my-2 my-md-0 mw-2 mt-4">Criar evento <i class="fa fa-plus-square fa-1x" aria-hidden="true"></i></a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Participantes</th>
                        <th>Responsável</th>
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

                    $result_temas = "SELECT id_eventos, nome, data_inicio, data_fim, local, descricao, custos, grupos_id_grupos, responsavel, conteudos_id_conteudos, tema_evento_idtema_evento 
                                    FROM eventos 
                                    ORDER BY id_eventos DESC
                                    LIMIT $inicio, $qtn_result_pg";

                    $resultado_temas = mysqli_query($link, $result_temas);



                   //Prepared Statements
                   if (mysqli_stmt_prepare($stmt, $result_temas)) {

                   mysqli_stmt_execute($stmt);
                   mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $local, $descricao, $custos, $grupos_id_grupos, $responsavel, $conteudos_id_conteudos, $tema_evento_idtema_evento);

                   while ($row_temas = mysqli_fetch_assoc($resultado_temas)) {
                   ?>
                    <tbody>
                    <tr>
                        <td><?= $row_temas['nome'] ?></td>
                        <td><?= $row_temas['local'] ?></td>
                        <td><?= substr($row_temas['data_inicio'], 0, 10) ?></td>
                        <td><a href="participantes.php?id_e=<?= $row_temas['id_eventos'] ?>">Ver participantes</td>
                        <td><?= $row_temas['responsavel'] ?></td>
                        <td>
                            <!-- Button trigger modal -->

                            <a href="" data-toggle="modal"
                               data-target="#exampleModal<?= $row_temas['id_eventos'] ?>""><i
                                    class="fas fa-info-circle"></i> </a>
                            <a href='editar_evento.php?id=<?= $row_temas['id_eventos'] ?>"'><i class="fas fa-edit"></i></a>

                            <a href="" data-toggle="modal" data-target="#apagar<?= $row_temas['id_eventos'] ?>""><i
                                    class="fas fa-trash"></i></a>

                        </td>

                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $row_temas['id_eventos'] ?>"
                    " tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #78BE20; color:white">
                                <h5 class="modal-title" id="exampleModalLabel">Mais info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Nome do Evento:</h5>
                                <p><?= $row_temas['nome'] ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                                <h5>Responsável do Evento:</h5>
                                <p><?= $row_temas['responsavel'] ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                                <h5>Data:</h5>
                                <p><?= substr($row_temas['data_inicio'], 0, 10) . " -> " . substr($row_temas['data_fim'], 0, 10) ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                                <h5>Horário:</h5>
                                <p><?= substr($row_temas['data_inicio'], 10, 6) . "h -> " . substr($row_temas['data_fim'], 10, 6) . "h" ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                                <h5>Local:</h5>
                                <p><?= $row_temas['local'] ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                                <h5>Descrição:</h5>
                                <p><?= $row_temas['descricao'] ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                                <h5>Custos do evento:</h5>
                                <p><?= $row_temas['custos'] ?></p>
                                <hr style="background-color: #78BE20; opacity: 0.3">
                            </div>

                        </div>
                    </div>
            </div>

            <!--MODAL PARA APAGAR-->
            <div class="modal fade" id="apagar<?= $row_temas['id_eventos'] ?>" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #78BE20; color:white">
                            <h5 class="modal-title" id="exampleModalLabel">Apagar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Tem a certeza que quer apagar o evento <?= $row_temas['nome'] ?>?</p>
                            <a href="scripts/delete_evento.php?id=<?= $row_temas['id_eventos'] ?>"><input type="submit"
                                                                                                          value="Eliminar"
                                                                                                          class="buttonCustomise">
                            </a>
                            <button type="button" class="buttonCustomise" data-dismiss="modal">Cancelar</button>

                        </div>

                    </div>
                </div>
            </div>


            <?php
            }
            }
                    ?>
                        </tbody>
                    <tfoot>
                    <tr>
                    <?php

                        $result_pg = "SELECT COUNT(id_eventos) AS num_result FROM eventos";
                        $link2 = new_db_connection();

                        $resultado_pg = mysqli_query($link2, $result_pg);

                        $row_pg = mysqli_fetch_assoc($resultado_pg);

                        $quantidade_pg = ceil($row_pg['num_result'] / $qtn_result_pg);

                        $max_links = 5;
                        ?>
                        <th>Nome</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>Participantes</th>
                        <th>Responsável</th>
                        <th>Ação</th>

                    </tr>
                    </tfoot>

                </table>
            <nav>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <?php

                            echo "<li class='page-item'><a class='page-link' href='eventos.php?p=1'>Primeira</a></li>";

                            for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){

                                if($pag_ant >= 1){
                                    echo "<li class='page-item'><a class='page-link' href='eventos.php?p=$pag_ant'>$pag_ant</a>";
                                }
                            }

                            echo "<li class='page-item'><a style='background-color: lightgrey;' class='page-link' href='eventos.php?p=$pagina'>$pagina</a>";

                            for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){

                                if($pag_dep <= $quantidade_pg){

                                    echo "<li class='page-item'><a class='page-link' href='eventos.php?p=$pag_dep'>$pag_dep</a>";
                                }
                            }

                            echo "<li class='page-item'><a class='page-link' href='eventos.php?p=$quantidade_pg'>Última</a>";
                            ?>
                    </ul>
                </nav>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

