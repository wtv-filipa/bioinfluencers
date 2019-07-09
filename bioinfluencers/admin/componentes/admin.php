<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Utilizadores</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos utilizadores do BioInfluencers.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Ação realizada com sucesso.";
                $class = "alert-success";
                break;
            case 1:
                $message = "Ocorreu um erro ao processar o seu pedido.";
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
                        <th><a href="administradores.php?sort=n">Nickname</a></th>
                        <th><a href="administradores.php?sort=e">Email</a></th>
                        <th><!--<a href="administradores.php?sort=p"-->Pontos</th>
                        <th><!--<a href="administradores.php?sort=t"-->Tipo</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <?php
                    require_once("connections/connection.php");

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $pagina_atual = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);

                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                    $qtn_result_pg = 5;

                    $inicio = ($qtn_result_pg * $pagina) - $qtn_result_pg;

                    $result_temas = "SELECT id_utilizadores, nome_u, nickname, password, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, img_perfil, active, id_tipos, nome_tipo
                                    FROM utilizadores 
                                    INNER JOIN tipos_utilizador
                                    ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                                    ORDER BY id_utilizadores DESC
                                    LIMIT $inicio, $qtn_result_pg";


                    $resultado_temas = mysqli_query($link, $result_temas);

                    //Prepared Statements
                    if (mysqli_stmt_prepare($stmt, $result_temas)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_utilizadores, $nome_u, $nickname, $password, $email, $data_nascimento, $descricao_u, $pontos, $data_criacao, $tipos_id_tipos, $codigo_utilizador, $img_perfil, $active, $id_tipos, $nome_tipo);

                    while ($row_temas = mysqli_fetch_assoc($resultado_temas)) {


                    ?>
                    <tbody>
                    <tr>
                        <td>
                            <?php
                            if ($row_temas['active'] == 0) {
                                echo '<i class="fas fa-lock mr-1" style="color: red"></i>';
                            }
                            echo $row_temas['nickname']
                            ?>
                        </td>
                        <td><?= $row_temas['email'] ?></td>
                        <td>pontos</td>
                        <td><?= $row_temas['nome_tipo'] ?></td>
                        <td>
                            <!-- Button trigger modal -->

                            <a data-toggle="modal" data-target="#info<?= $row_temas['id_utilizadores'] ?>">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <?php
                            if ($row_temas['active'] == 0) { ?>
                                <a href='' data-toggle="modal" data-target="#bloquear_ativar_utilizador<?= $row_temas['id_utilizadores']?>">
                                        <i class="fas fa-lock-open"></i>
                                    </a>
                            <?php
                            } else {?>
                                <a data-toggle="modal" data-target="#bloquear_ativar_utilizador<?= $row_temas['id_utilizadores']?>">
                                        <i style='color:red' class="fas fa-lock"></i>
                                    </a>
                            <?php
                            }

                            ?>

                        </td>

                    </tr>
                    </tbody>
                    <!-- Modal Info -->
                    <div class="modal fade" id="info<?= $row_temas['id_utilizadores']?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #78BE20; color:white">
                                    <h5 class="modal-title" id="exampleModalLabel">Mais info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Nome:</h5>
                                    <p><?= $row_temas['nome_u'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Nickname</h5>
                                    <p><?= $row_temas['nickname'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Email:</h5>
                                    <p><?= $row_temas['email'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Data de Nascimento:</h5>
                                    <p><?= $row_temas['data_nascimento'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Descrição:</h5>
                                    <p><?= $row_temas['descricao_u'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Pontos:</h5>
                                    <p><?= $row_temas['pontos'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Código:</h5>
                                    <p><?= $row_temas['codigo_utilizador'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                    <h5>Tipo:</h5>
                                    <p><?= $row_temas['nome_tipo'] ?></p>
                                    <hr style="background-color: #78BE20; opacity: 0.3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Info -->
                    <div class="modal fade" id="bloquear_ativar_utilizador<?= $row_temas['id_utilizadores'] ?>"
                         tabindex="-1" role="dialog" aria-labelledby="bloquear_utilizador" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">
                                <?php
                                if ($row_temas['active'] == 0){ ?>

                                <div class="modal-header" style="background-color: #5a5c69; color:white">
                                <h5 class="modal-title" id="bloquear_utilizador">Alerta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Tem a certeza que deseja ativar este utilizador?</h5>
                                <a class='branco'
                                   href="scripts/update_active.php?id=<?= $row_temas['id_utilizadores'] ?>&a=<?= $row_temas['active'] ?>">
                                    <button type="submit" class="buttonCustomise">Sim</button> </a>


                                <button type="button" class="buttonCustomise" data-dismiss="modal">Não</button>

                            </div>

                            <?php
                            } else { ?>

                            <div class="modal-header" style="background-color: #5a5c69; color:white">
                            <h5 class="modal-title" id="bloquear_utilizador"> Alerta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5> Tem a certeza que deseja bloquear este utilizador ?</h5>
                            <a class='branco'
                               href="scripts/update_active.php?id=<?= $row_temas['id_utilizadores'] ?>&a=<?= $row_temas['active'] ?>">
                                <button type="submit" class="buttonCustomise">Sim</button ></a>



                            <button type="button" class="buttonCustomise" data-dismiss="modal">Não</button>

                        </div>
                        <?php
                        }
                        }
                        ?>
                    </div>
            </div>
        </div>
        <tfoot>
        <?php
        }
        $result_pg = "SELECT COUNT(id_utilizadores) AS num_result FROM utilizadores";

        $link2 = new_db_connection();

        $resultado_pg = mysqli_query($link2, $result_pg);

        $row_pg = mysqli_fetch_assoc($resultado_pg);

        $quantidade_pg = ceil($row_pg['num_result'] / $qtn_result_pg);

        $max_links = 5;
        ?>
        <tr>
            <th>Nickname</th>
            <th>Email</th>
            <th>Pontos</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
        </tfoot>

        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php

                    echo "<li class='page-item'><a class='page-link' href='administradores.php?p=1'>Primeira</a></li>";

                    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {

                        if ($pag_ant >= 1) {
                            echo "<li class='page-item'><a class='page-link' href='administradores.php?p=$pag_ant'>$pag_ant</a>";
                        }
                    }

                    echo "<li class='page-item'><a style='background-color: lightgrey;'  class='page-link' href='administradores.php?p=$pagina'>$pagina</a>";

                    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {

                        if ($pag_dep <= $quantidade_pg) {

                            echo "<li class='page-item'><a class='page-link' href='administradores.php?p=$pag_dep'>$pag_dep</a>";
                        }
                    }

                    echo "<li class='page-item'><a class='page-link' href='administradores.php?p=$quantidade_pg'>Última</a>";
                    ?>
            </ul>
        </nav>

    </div>
</div>
</div>
</div>

