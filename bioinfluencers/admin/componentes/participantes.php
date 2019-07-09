<?php

if (isset($_GET["id_e"])) {
    $id_evento = $_GET["id_e"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_eventos, nome, descricao
              FROM eventos
              WHERE id_eventos LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_evento);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_evento, $nome_e, $descricao);
        while (mysqli_stmt_fetch($stmt)) {
            ?>

            <div class="container-fluid">
            <div class="col-8">
                <h1 class="h3 mb-2 text-gray-800">Evento: <?= $nome_e ?></h1>
                <p class="mb-4"><?= $descricao ?></p>
            </div>

            <div class="col-4">
                <?php
                $link5 = new_db_connection();
                $link6 = new_db_connection();
                $link7 = new_db_connection();

                $stmt5 = mysqli_stmt_init($link5);
                $stmt6 = mysqli_stmt_init($link6);
                $stmt7 = mysqli_stmt_init($link7);

                $query5 = "SELECT COUNT(utilizadores_interessados) 
                          FROM rsvp 
                          WHERE status = 'vou' AND eventos_interesse = ?";

                $query6 = "SELECT COUNT(utilizadores_interessados) FROM rsvp WHERE status = 'interessado' AND eventos_interesse = ?";

                $query7 = "SELECT COUNT(utilizadores_interessados) FROM rsvp WHERE status = 'não vou' AND eventos_interesse = ?";

                if (mysqli_stmt_prepare($stmt5, $query5)) {
                    mysqli_stmt_bind_param($stmt5, 'i', $id_evento);
                    mysqli_stmt_execute($stmt5);
                    mysqli_stmt_bind_result($stmt5, $status5);

                    while (mysqli_stmt_fetch($stmt5)) {
                        echo "<p>Nº de pessoas que vão: $status5</p>";

                    }

                    if (mysqli_stmt_prepare($stmt6, $query6)) {
                        mysqli_stmt_bind_param($stmt6, 'i', $id_evento);
                        mysqli_stmt_execute($stmt6);
                        mysqli_stmt_bind_result($stmt6, $status6);

                        while (mysqli_stmt_fetch($stmt6)) {
                            echo "<p>Nº de pessoas interessadas: $status6</p>";
                        }


                        if (mysqli_stmt_prepare($stmt7, $query7)) {
                            mysqli_stmt_bind_param($stmt7, 'i', $id_evento);
                            mysqli_stmt_execute($stmt7);
                            mysqli_stmt_bind_result($stmt7, $status7);

                            while (mysqli_stmt_fetch($stmt7)) {
                                echo "<p>Nº de pessoas que não vão: $status7 </p>";
                            }

                        }
                    }
                }
                ?>


            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-body">

            <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Presenças</th>
            </tr>
            </thead>
            <tbody>


            <?php

            // Create a new DB connection
            $link2 = new_db_connection();

            /* create a prepared statement */
            $stmt2 = mysqli_stmt_init($link2);

            $query2 = "SELECT id_eventos, nome, descricao, id_utilizadores, nome_u, eventos_interesse, utilizadores_interessados, status
              FROM eventos
              INNER JOIN rsvp
              ON eventos.id_eventos = rsvp.eventos_interesse
              INNER JOIN utilizadores 
              ON rsvp.utilizadores_interessados = utilizadores.id_utilizadores
              WHERE id_eventos LIKE ?";


            if (mysqli_stmt_prepare($stmt2, $query2)) {

                mysqli_stmt_bind_param($stmt2, 'i', $id_evento);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $id_evento, $nome_e, $descricao, $id_u, $nome_u, $eventos_interesse, $utilizadores_interessados, $status);
                while (mysqli_stmt_fetch($stmt2)) {
                    ?>
                    <tr>
                        <td><?= $nome_u ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <?php
                            $link3 = new_db_connection();
                            $stmt3 = mysqli_stmt_init($link3);
                            $query3 = "SELECT eventos_id_eventos, status_atual FROM utilizadores_has_eventos WHERE status_atual = 0 AND utilizadores_id_utilizadores = ? AND eventos_id_eventos = ?";

                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'ii', $id_u, $id_evento);
                                mysqli_stmt_execute($stmt3);
                                mysqli_stmt_bind_result($stmt3, $id_evento, $status_atual);
                                if (!mysqli_stmt_fetch($stmt3)) {
                                    echo "<a href='' data-toggle='modal' data-target='#marcarpresencas'>
                        <i class='fas fa-check'></i></a>";
                                } else {
                                    echo "<a href='' data-toggle='modal' data-target='#cancelarpresencas'>
                        <i class='fas fa-times'></i></a>";
                                }

                            }
                            ?>

                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>

                <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Presenças</th>
                </tr>
                </tfoot>

                </table>
                </div>
                </div>
                </div>

                </div>
                <!-- /.container-fluid -->
                <?php
            }
        }
    }
}
?>
<!-- Feed Modal-->
<div class="modal fade" id="marcarpresencas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso:</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tens a certeza que queres confirmar a presença desta pessoa?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                <a class="btn btn-primary"
                   href="scripts/confirmacao_evento.php?id_e=<?= $id_evento ?>&id_u=<?= $id_u ?>">Sim</a>
            </div>
        </div>
    </div>
</div>

<!-- Feed Modal-->
<div class="modal fade" id="cancelarpresencas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso:</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Tens a certeza que queres cancelar a presença desta pessoa?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                <a class="btn btn-primary"
                   href="scripts/confirmacao_evento.php?id_e=<?= $id_evento ?>&id_u=<?= $id_u ?>&s=<?= $status_atual ?>">Sim</a>
            </div>
        </div>
    </div>
</div>

