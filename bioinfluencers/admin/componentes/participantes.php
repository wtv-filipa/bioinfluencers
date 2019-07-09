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

            <div>
                <a style="text-decoration: none" href="eventos.php">

                    <h5>&#8592; voltar</h5>
                </a>
            </div>

            <div class="col-8">
                <h1 class="h3 mb-2 text-gray-800">Evento: <?= $nome_e ?></h1>
                <p class="mb-4"><?= $descricao ?></p>
            </div>


            <?php
            $link5 = new_db_connection();
            $link6 = new_db_connection();

            $stmt5 = mysqli_stmt_init($link5);
            $stmt6 = mysqli_stmt_init($link6);

            $query5 = "SELECT COUNT(utilizadores_interessados) 
                          FROM rsvp 
                          WHERE status = 'vai' AND eventos_interesse = ?";

            $query6 = "SELECT COUNT(utilizadores_interessados) FROM rsvp WHERE status = 'interessado' AND eventos_interesse = ?";
            ?>

            <div class="row text-center">

                <?php
                if (mysqli_stmt_prepare($stmt5, $query5)) {
                    mysqli_stmt_bind_param($stmt5, 'i', $id_evento);
                    mysqli_stmt_execute($stmt5);
                    mysqli_stmt_bind_result($stmt5, $status5);

                    while (mysqli_stmt_fetch($stmt5)) {
                        echo "<div class=\"card col-6 mb-5\">
 <div class=\"card-body\">
  <b> $status5 </b>pessoas responderam que iam a este evento.
  </div>
</div>";

                    }
                }

                if (mysqli_stmt_prepare($stmt6, $query6)) {
                    mysqli_stmt_bind_param($stmt6, 'i', $id_evento);
                    mysqli_stmt_execute($stmt6);
                    mysqli_stmt_bind_result($stmt6, $status6);

                    while (mysqli_stmt_fetch($stmt6)) {
                        echo "<div class=\"card col-6 mb-5\">
 <div class=\"card-body\">
   <b> $status6 </b>têm interesse neste evento.
  </div>
</div>";

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

            $pagina_atual = filter_input(INPUT_GET,'p', FILTER_SANITIZE_NUMBER_INT);

            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

            $qtn_result_pg = 5;

            $inicio = ($qtn_result_pg * $pagina) - $qtn_result_pg;

            $query2 = "SELECT id_eventos, nome, descricao, id_utilizadores, nome_u, eventos_interesse, utilizadores_interessados, status
              FROM eventos
              INNER JOIN rsvp
              ON eventos.id_eventos = rsvp.eventos_interesse
              INNER JOIN utilizadores 
              ON rsvp.utilizadores_interessados = utilizadores.id_utilizadores
              WHERE id_eventos LIKE ?
              LIMIT $inicio, $qtn_result_pg";


            $resultado_temas = mysqli_query($link, $query2);

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
                            $query3 = "SELECT eventos_id_eventos FROM utilizadores_has_eventos WHERE utilizadores_id_utilizadores = ? AND eventos_id_eventos = ?";

                            if (mysqli_stmt_prepare($stmt3, $query3)) {
                                mysqli_stmt_bind_param($stmt3, 'ii', $id_u, $id_evento);
                                mysqli_stmt_execute($stmt3);
                                mysqli_stmt_bind_result($stmt3, $id_evento);
                                ?>
                            <a href="scripts/confirmacao_evento.php?confirma=<?= $id_evento ?>&u=<?= $id_u ?>">
                                <?php
                                if (!mysqli_stmt_fetch($stmt3)) {
                                    //echo "não fui confirmado";
                                    echo "<i class='fas fa-check'></i>";
                                    ?>
                                    </a>
                                    <?php
                                } else {
                                    //echo "fui confirmado";
                                    echo "<a href=\"scripts/confirmacao_evento.php?cancela=$id_evento&u=$id_u\"> <i style='color: red' class='fas fa-times'></i></a>";
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

                    <?php

                    $id_evento = $_GET["id_e"];

                    $result_pg = "SELECT COUNT(eventos_interesse) AS num_result FROM rsvp";
                    $link7 = new_db_connection();

                    $resultado_pg = mysqli_query($link7, $result_pg);

                    $row_pg = mysqli_fetch_assoc($resultado_pg);

                    $quantidade_pg = ceil($row_pg['num_result'] / $qtn_result_pg);

                    $max_links = 5;


                    ?>

                    <th>Nome</th>
                    <th>Status</th>
                    <th>Presenças</th>
                </tr>
                </tfoot>

                </table>

                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <?php


                            echo "<li class='page-item'><a class='page-link' href='participantes.php?id_e=$id_evento&p=1'>Primeira</a></li>";

                            for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){

                                if($pag_ant >= 1){
                                    echo "<li class='page-item'><a class='page-link' href='participantes.php?id_e=$id_evento&p=$pag_ant'>$pag_ant</a>";
                                }
                            }

                            echo "<li class='page-item'><a class='page-link' style='background-color: lightgrey;' href='participantes.php?id_e=$id_evento&p=$pagina'>$pagina</a>";

                            for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){

                                if($pag_dep < $quantidade_pg){

                                    echo "<li class='page-item'><a class='page-link' href='participantes.php?id_e=$id_evento&p=$pag_dep'>$pag_dep</a>";
                                }
                            }

                            echo "<li class='page-item'><a class='page-link' href='participantes.php?id_e=$id_evento&p=$quantidade_pg'>Última</a>";
                            ?>
                    </ul>
                </nav>

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
