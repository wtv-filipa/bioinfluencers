<?php

if (isset($_GET["id_e"])) {
    $id_e = $_GET["id_e"];

    require_once("connections/connection.php");

    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_eventos, nome, data_inicio, data_fim, local, descricao, conteudos_id_conteudos, id_conteudos, responsavel, filename
              FROM eventos
              INNER JOIN conteudos
              ON eventos.conteudos_id_conteudos = conteudos.id_conteudos
              WHERE id_eventos LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_e);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_e, $nome, $data_inicio, $data_fim, $local, $descricao, $conteudos_id_conteudos, $id_conteudos, $responsavel, $filename);

        while (mysqli_stmt_fetch($stmt)) {
//$nextWeek = time() + (7 * 24 * 60 * 60);
            $today = date('y-m-d');
//echo $today;
            ?>
            <div class="container p-0 div_geral_event col-lg-9">
            <div class="text-center eventos_ind_img ">
                <img style="" class="img-fluid" src="../admin/uploads/eventos/<?= $filename ?>">
            </div>

            <div class="back-eventos "
                 style="-moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;">


            <div class="eventos_ind " style="">
                <div class="event-card-ind mt-3">
                    <div class="titulos_ev" style="">
                        <h4 class="mt-2 titulo_prin"><span
                                    style="font-weight: bold;"><?= substr($data_inicio, 0, 10) ?>   |   </span><?= $nome ?>
                        </h4>
                        <p class="mb-0"><i class="fa fa-map-marker mr-2"
                                           aria-hidden="true"></i><?= $local ?></p>
                        <i class="fa fa-clock-o mr-2"
                           aria-hidden="true"></i><?= substr($data_inicio, 10, 6) ?>h
                        - <?= substr($data_fim, 10, 6) ?>h <?php
                        if (strtotime($today) > strtotime($data_inicio)) {

                            echo "<span class='text-warning ml-2'>TERMINADO</span>";

                        }
                        ?>

                    </div>

                </div>
            </div>
            <div class="eventos_ind text-center mx-auto">
            <div class="event-card-ind mb-3"> <!--style=" border-top: 2px solid lightgrey;"-->
            <div class="description">
            <div class="controls">
            <?php
            //este é para selcionar que esta interessado
            // Create a new DB connection
            $link13 = new_db_connection();
            /* create a prepared statement */
            $stmt13 = mysqli_stmt_init($link13);
            $query13 = "SELECT COUNT(status) FROM rsvp WHERE status='interessado' AND eventos_interesse = ? AND utilizadores_interessados = ?";

            if (mysqli_stmt_prepare($stmt13, $query13)) {

                mysqli_stmt_bind_param($stmt13, 'ii', $id_e, $id);
                mysqli_stmt_execute($stmt13);
                mysqli_stmt_bind_result($stmt13, $n_total);
                while (mysqli_stmt_fetch($stmt13)){
                    ?>

                    <?php
                    // Create a new DB connection
                    $link14 = new_db_connection();

                    /* create a prepared statement */
                    $stmt14 = mysqli_stmt_init($link14);

                    $query14 = "SELECT eventos_interesse FROM rsvp
WHERE eventos_interesse = ? AND utilizadores_interessados = ? AND status= 'interessado'";

                    if (mysqli_stmt_prepare($stmt14, $query14)) {

                        mysqli_stmt_bind_param($stmt14, 'ii', $id_e, $id);
                        mysqli_stmt_execute($stmt14);
                        mysqli_stmt_bind_result($stmt14, $id_e); ?>

    <?php
                        if (!mysqli_stmt_fetch($stmt14)) {
                            $id_e = $_GET["id_e"];
                            //echo "não estou neste evento";
                            echo "<a href=\"scripts/status_eventos.php?interessado=$id_e\"><button style='width: 100%' class=\"buttonCustomise btn btn-default\" ><i class=\"fa fa-heart-o\" aria-hidden=\"true\" style=\"font-size: 1.2rem\"></i> <span style=\"font-size: 1.2rem\">$n_total</span></button></a>";
                            ?>

                            <?php
                        } else{

                            //echo "estou neste evento";
                            echo " <a href=\"scripts/status_eventos.php?naointeressado=$id_e\"><button style='width: 100%' class=\"buttonCustomise btn btn-default\"><i class=\"fa fa-heart\" aria-hidden=\"true\" style=\"font-size: 1.2em; color: red;\"></i> <span style=\"font-size: 1.2rem\">$n_total</span></button></a>";
                        }

                    }
                }


            }



            $id_e = $_GET["id_e"];
            //este é para selcionar que vai
            // Create a new DB connection
            $link15 = new_db_connection();
            /* create a prepared statement */
            $stmt15 = mysqli_stmt_init($link15);
            $query15 = "SELECT COUNT(status) FROM rsvp WHERE status='vai' AND eventos_interesse = ? AND utilizadores_interessados = ?";

            if (mysqli_stmt_prepare($stmt15, $query15)) {
                mysqli_stmt_bind_param($stmt15, 'ii', $id_e, $id);
                mysqli_stmt_execute($stmt15);
                mysqli_stmt_bind_result($stmt15, $n_total);
                while (mysqli_stmt_fetch($stmt15)){
                    ?>

                    <?php
                    // Create a new DB connection
                    $link16 = new_db_connection();

                    /* create a prepared statement */
                    $stmt16 = mysqli_stmt_init($link16);

                    $query16 = "SELECT eventos_interesse FROM rsvp
WHERE eventos_interesse = ? AND utilizadores_interessados = ? AND status= 'vai'";

                    if (mysqli_stmt_prepare($stmt16, $query16)) {

                        mysqli_stmt_bind_param($stmt16, 'ii', $id_e, $id);
                        mysqli_stmt_execute($stmt16);
                        mysqli_stmt_bind_result($stmt16, $id_e);

                        if (!mysqli_stmt_fetch($stmt16)) {
                            $id_e = $_GET["id_e"];
                            //echo "não estou neste evento";
                            echo " <a href=\"scripts/status_eventos.php?vai=$id_e\"><button style='width: 100%' class=\"buttonCustomise btn btn-default\" ><i class=\"fa fa-check\" aria-hidden=\"true\" style=\"font-size: 1.2rem; color: black\"></i> <span style=\"font-size: 1.2rem\">$n_total</span></button>   </a>";
                            ?>

                            <?php
                        } else{

                            //echo "estou neste evento";
                            echo " <a href=\"scripts/status_eventos.php?naovai=$id_e\"><button style='width: 100%' class=\"buttonCustomise btn btn-default\"><i class=\"fa fa-check\" aria-hidden=\"true\" style=\"font-size: 1.2rem; color: green;\"></i> <span style=\"font-size: 1.2rem\">$n_total</span></button></a>";
                        }

                    }
                }
            }
                ?>

                <a href="scripts/partilha_evento.php?e=<?= $id_e ?>">
                    <button style="font-size: 1.3rem; color: black;"style='width: 100%' class="buttonCustomise btn btn-default">
                        <i style="font-size: 1.2rem" class="fa fa-share" aria-hidden="true"></i>
                        <span style="font-size: 1.2rem">0</span>
                    </button>
                </a>

                </div>
                </div>
                </div>
                </div>
                </div>

                <div class="back-sobre">
                    <div class="row no-gutters">
                        <h4 class="mt-5 pl-4" style="font-weight: bold;">
                            Sobre</h4>

                    </div>

                    <div class="notic_text mb-2 mt-2 pr-4 pl-4">
                        <p>
                            <?= $descricao ?>

                        </p>
                    </div>

                    <?php


            $link19 = new_db_connection();


            /* create a prepared statement */
            $stmt19 = mysqli_stmt_init($link19);


            $query19 = "SELECT grupos_id_grupos
              FROM eventos
              WHERE id_eventos = ?";

            if (mysqli_stmt_prepare($stmt19, $query19)) {
                    $id_e = $_GET["id_e"];

                mysqli_stmt_bind_param($stmt19, 'i', $id_e);
                mysqli_stmt_execute($stmt19);
                mysqli_stmt_bind_result($stmt19, $id_e);

                while (mysqli_stmt_fetch($stmt19)) {

                    ?>
                    <div  class="text-center">
                        <a href="grupo_indv.php?id_g=<?=$id_e?>"> <button type="button" class="btn" style="background-color: #7FC53C; color: #fff;">Abrir no grupo
                        </button></a>
                    </div>
                    </div>

                    <?php
                }
            }
                    ?>

                <div class="mt-5 no-gutters ">
                    <div class=" mb-5 col-lg-12 col-sm-6 pl-4">
                        <h4 class="" style="font-weight: bold;">
                            Responsável</h4>

                    </div>

                    <div class="col-sm-4">
                        <div class="media-ranking-item terceiro-colocado">
                            <h6 class="name-user mt-2"><?= $responsavel ?></h6>
                            <small>Organizador</small>
                        </div>
                    </div>
                </div>
                </div>


                <?php

            }
        }
}
?>






