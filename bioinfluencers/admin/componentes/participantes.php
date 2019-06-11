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
              FROM eventos";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_evento, $nome_e, $descricao);
        while (mysqli_stmt_fetch($stmt)) {
            ?>

            <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Evento: <?= $nome_e ?></h1>
            <p class="mb-4"><?= $descricao ?></p>
            <?php

            // Create a new DB connection
            $link2 = new_db_connection();

            /* create a prepared statement */
            $stmt2 = mysqli_stmt_init($link2);

            $query2 = "SELECT id_eventos, nome, descricao, id_utilizadores, nome_u, codigo_evento, pontos_e
              FROM eventos
              INNER JOIN utilizadores_has_eventos
              ON eventos.id_eventos = utilizadores_has_eventos.eventos_id_eventos
              INNER JOIN utilizadores 
              ON utilizadores_has_eventos.utilizadores_id_utilizadores = utilizadores.id_utilizadores
              WHERE id_eventos LIKE ?";


            if (mysqli_stmt_prepare($stmt2, $query2)) {

                mysqli_stmt_bind_param($stmt2, 'i', $id_evento);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $id_evento, $nome_e, $descricao, $id_u, $nome_u, $codigo_e, $pontos_e);
                while (mysqli_stmt_fetch($stmt2)) {
                    ?>


                    <?php
                }
                ?>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Código evento</th>
                                    <th>Pontos</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr>
                                    <td><?= $nome_u?></td>
                                    <td><?= $codigo_e?></td>
                                    <td><?= $pontos_e?></td>
                                    <td></td>
                                </tr>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Código evento</th>
                                    <th>Pontos</th>
                                    <th>Ação</th>
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