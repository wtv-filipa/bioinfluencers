<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Conteúdos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos conteúdos do BioInfluencers.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Ocorreu um erro ao apagar o conteúdo, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 1:
                $message = "Conteúdo apagado com sucesso!";
                $class = "alert-success";
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
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..." aria-label="Search" aria-describedby="basic-addon2" name="p">
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
                        <th>Nome do ficheiro</th>
                        <th>Data</th>
                        <th>Tipo de conteúdo</th>
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

                    $result_temas = "SELECT id_conteudos, filename, data, partilhas_id_partilhas, tipos_conteudos_id_tiposconteudos1 
                                    FROM conteudos 
                                    ORDER BY id_conteudos DESC
                                    LIMIT $inicio, $qtn_result_pg";

                    $resultado_temas = mysqli_query($link, $result_temas);

                    //Prepared Statements
                    if (mysqli_stmt_prepare($stmt, $result_temas)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_conteudos, $filename, $data, $partilhas_id_partilhas, $tipos_conteudos_id_tiposconteudos1);

                    while ($row_temas = mysqli_fetch_assoc($resultado_temas)) {
                    ?>

                    <tbody>
                    <tr>
                        <td><?= $row_temas['filename'] ?></td>
                        <td><?= $row_temas['data'] ?></td>
                        <td><?= $row_temas['tipos_conteudos_id_tiposconteudos1'] ?></td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#apagar<?= $row_temas['id_conteudos'] ?>"><i
                                        class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="apagar<?= $row_temas['id_conteudos'] ?>" tabindex="-1" role="dialog"
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
                                    <p>Tem a certeza que quer apagar o tema <?= $row_temas['filename'] ?>?</p>
                                    <a href="scripts/delete_conteudos.php?id=<?= $row_temas['id_conteudos'] ?>"><input
                                                type="submit" value="Eliminar" class="buttonCustomise"> </a>
                                    <button type="button" class="buttonCustomise" data-dismiss="modal">Cancelar</button>

                                </div>

                            </div>
                        </div>
                    </div>

                    <tfoot>
                    <tr>
                        <?php
                        }
                        }

                        $link2 = new_db_connection();

                        $result_pg = "SELECT COUNT(id_conteudos) AS num_result FROM conteudos";

                        $resultado_pg = mysqli_query($link2, $result_pg);

                        $row_pg = mysqli_fetch_assoc($resultado_pg);

                        $quantidade_pg = ceil($row_pg['num_result'] / $qtn_result_pg);

                        $max_links = 5;
                        ?>
                        <th>Nome do ficheiro</th>
                        <th>Data</th>
                        <th>Tipo de conteúdo</th>
                        <th>Ação</th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>

                <nav>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <?php

                                echo "<li class='page-item'><a class='page-link' href='conteudos.php?p=1'>Primeira</a></li>";

                                for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){

                                    if($pag_ant >= 1){
                                        echo "<li class='page-item'><a class='page-link' href='conteudos.php?p=$pag_ant'>$pag_ant</a>";
                                    }
                                }

                                echo "<li class='page-item'><a class='page-link' href='conteudos.php?p=$pagina'>$pagina</a>";

                                for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){

                                    if($pag_dep <= $quantidade_pg){

                                        echo "<li class='page-item'><a class='page-link' href='conteudos.php?p=$pag_dep'>$pag_dep</a>";
                                    }
                                }

                                echo "<li class='page-item'><a class='page-link' href='conteudos.php?p=$quantidade_pg'>Última</a>";
                                ?>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>




</div>
<!-- /.container-fluid -->