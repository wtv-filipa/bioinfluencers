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
            <h1 class="h3 mb-2 text-gray-800">Evento: <?= $nome_e ?></h1>
            <p class="mb-4"><?= $descricao ?></p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <!--<th>Código evento</th>
                                    <th>Pontos</th>-->
                                    <th>Presenças</th>
                                </tr>
                                </thead>
                                <tbody>


                <?php

                // Create a new DB connection
                $link2 = new_db_connection();

                /* create a prepared statement */
                $stmt2 = mysqli_stmt_init($link2);

            $query2 = "SELECT id_eventos, nome, descricao, id_utilizadores, nome_u, eventos_interesse, utilizadores_interessados
              FROM eventos
              INNER JOIN rsvp
              ON eventos.id_eventos = rsvp.eventos_interesse
              INNER JOIN utilizadores 
              ON rsvp.utilizadores_interessados = utilizadores.id_utilizadores
              WHERE id_eventos LIKE ?";


            if (mysqli_stmt_prepare($stmt2, $query2)) {

                mysqli_stmt_bind_param($stmt2, 'i', $id_evento);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $id_evento, $nome_e, $descricao, $id_u, $nome_u, $eventos_interesse, $utilizadores_interessados);
                while (mysqli_stmt_fetch($stmt2)) {
                    ?>
                    <tr>
                        <td><?= $nome_u?></td>
                        <!--<td> //$codigo_e?></td>
                        <td> //$pontos_e?></td>-->
                        <td>
                            <a href='' data-toggle="modal" data-target="#marcarpresencas">
                                <i class="fas fa-check"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                }
                ?>

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <!--<th>Código evento</th>
                                    <th>Pontos</th>-->
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
                <a class="btn btn-primary" href="scripts/confirmacao_evento.php?id_e<?= $id_evento ?>">Sim</a>
            </div>
        </div>
    </div>
</div>

