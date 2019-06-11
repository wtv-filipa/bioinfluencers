<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Utilizadores</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos utilizadores do BioInfluencers.</p>

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

                    if (isset($_GET["p"])) {

                        $pesquisar = "%" . $_GET["p"] . "%";
                    } else {

                        $pesquisar = "%";
                    }

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";

                    if (isset($_GET["sort"])) {
                        if ($_GET["sort"] == "n") {
                            $ordem_listagem = "nickname";
                        } else {
                            if ($_GET["sort"] == "e") {
                                $ordem_listagem = "email";
                            } /*else {
                                if ($_GET["sort"] == "p") {
                                    $ordem_listagem = "pontos";
                                } else {
                                    if ($_GET["sort"] == "t") {
                                        $ordem_listagem = "tipo";
                                    } else {
                                        $ordem_listagem = "username";
                                    }
                                }
                            }*/
                        }

                        $query .= " ORDER BY " . $ordem_listagem . " ASC ";
                    }



                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $pesquisar);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $active, $nome_tipo);

                    while (mysqli_stmt_fetch($stmt)) {

                        ?>
                        <tbody>
                        <tr>
                            <td>
                                <?php
                                if ($active == 0) {
                                    echo '<i class="fas fa-lock mr-1" style="color: red"></i>';
                                } echo $nickname
                                ?>
                            </td>
                            <td><?= $email ?></td>
                            <td>pontos</td>
                            <td><?= $nome_tipo ?></td>
                            <td>
                                <!-- Button trigger modal -->

                                <a data-toggle="modal" data-target="#info<?=$id?>">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <?php
                                if ($active == 0 ) {
                                    echo "<a href='' data-toggle=\"modal\" data-target=\"#bloquear_ativar_utilizador$id\">
                                        <i class=\"fas fa-lock-open\"></i>
                                    </a>";

                                } else {
                                    echo "<a data-toggle=\"modal\" data-target=\"#bloquear_ativar_utilizador$id\">
                                        <i style='color:red' class=\"fas fa-lock\"></i>
                                    </a>";

                                }

                                ?>

                            </td>

                        </tr>
                        </tbody>
                        <!-- Modal Info -->
                        <div class="modal fade" id="info<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <?php

                                $link2 = new_db_connection();
                                $stmt2 = mysqli_stmt_init($link2);

                                $query2 = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, nome_tipo
                                            FROM utilizadores";

                                if (mysqli_stmt_prepare($stmt2, $query2)) {

                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt2);
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt2, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $nome_tipo );

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
                                        <h5>Nome:</h5>
                                        <p><?=$nome_u?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Nickname</h5>
                                        <p><?=$nickname?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Email:</h5>
                                        <p><?=$email?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Data de Nascimento:</h5>
                                        <p><?=$data_nasc?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Descrição:</h5>
                                        <p><?=$descricao_u?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Pontos:</h5>
                                        <p><?=$pontos?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Código:</h5>
                                        <p><?=$codigo_utilizador?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                        <h5>Tipo:</h5>
                                        <p><?=$nome_tipo?></p>
                                            <hr style="background-color: #78BE20; opacity: 0.3">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Info -->
                        <div class="modal fade" id="bloquear_ativar_utilizador<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="bloquear_utilizador" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <?php

                                $link3 = new_db_connection();
                                $stmt3 = mysqli_stmt_init($link3);

                                $query3 = "SELECT id_utilizadores, active,
                                            FROM utilizadores";

                                if (mysqli_stmt_prepare($stmt3, $query3)) {

                                    /* execute the prepared statement */
                                    mysqli_stmt_execute($stmt3);
                                    /* bind result variables */
                                    mysqli_stmt_bind_result($stmt3, $id, $active);

                                    /* resultados da store */
                                    mysqli_stmt_store_result($stmt3);
                                    while (mysqli_stmt_fetch($stmt3)) {
                                        echo ' ';
                                    }
                                }
                                ?>
                                <div class="modal-content">
                                    <?php
                                    if ($active == 0 ){
                                        echo "<div class=\"modal-header\" style=\"background-color: #5a5c69; color:white\">
                                        <h5 class=\"modal-title\" id=\"bloquear_utilizador\">Alerta</h5>
                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                            <span aria-hidden=\"true\">&times;</span>
                                        </button>
                                    </div>
                                    <div class=\"modal-body\">
                                        <h5>Tem a certeza que deseja ativar este utilizador?</h5>
                                        <a href=\"scripts/update_active.php?id=$id&a=$active\">
                                            <button type=\"submit\" class=\"btn btn-secondary\">Sim</a>
                                        </button>
                                        <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Não</button>

                                    </div>";

                                    } else {
                                        echo "<div class=\"modal-header\" style=\"background-color: #5a5c69; color:white\">
                                        <h5 class=\"modal-title\" id =\"bloquear_utilizador\"> Alerta</h5 >
                                        <button type = \"button\" class=\"close\" data-dismiss= \"modal\" aria-label = \"Close\" >
                                            <span aria-hidden = \"true\">&times;</span >
                                        </button >
                                    </div >
                                    <div class=\"modal-body\" >
                                        <h5 > Tem a certeza que deseja ativar este utilizador ?</h5 >
                                        <a href = \"scripts/update_active.php?id=$id&a=$active\" >
                                            <button type = \"submit\" class=\"btn btn-secondary\" >Sim</a >

                                        </button >
                                        <button type = \"button\" class=\"btn btn-secondary\" data-dismiss =\"modal\">Não</button >

                                    </div >";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
            <?php
                    }

                    ?>
                    <tfoot>
                    <tr>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Pontos</th>
                        <th>Tipo</th>
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
