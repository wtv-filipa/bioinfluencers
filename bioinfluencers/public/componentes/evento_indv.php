<?php

if (isset($_GET["id_e"])) {
    $id_e = $_GET["id_e"];

    require_once("connections/connection.php");

    ?>


    <?php
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
                <img class="img-fluid" src="../admin/uploads/eventos/<?= $filename ?>">
            </div>

            <div class="back-eventos "
                 style="-moz-border-radius-topleft: 10px; -moz-border-radius-topright: 10px;">


            <div class="eventos_ind " style="">
                <div class="event-card-ind mt-3">
                    <div class="titulos_ev" style="">
                        <h2 class="mt-2 titulo_prin"><span
                                    style="font-weight: bold;"><?= $data_inicio ?> | </span><?= $nome ?>
                        </h2>
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

            // Create a new DB connection
            $link13 = new_db_connection();
            /* create a prepared statement */
            $stmt13 = mysqli_stmt_init($link13);
            $query13 = "SELECT COUNT(status) FROM rsvp WHERE status='interessado'";

            if (mysqli_stmt_prepare($stmt13, $query13)) {

                mysqli_stmt_execute($stmt13);
                mysqli_stmt_bind_result($stmt13, $n_total);
                while (mysqli_stmt_fetch($stmt13)){
                    ?>
                    <a href="scripts/status_eventos.php?interessado=<?=$id_e?>">
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
                        mysqli_stmt_bind_result($stmt14, $id_e);

                        if (!mysqli_stmt_fetch($stmt14)) {
                            //echo "não estou neste evento";
                            echo "<button style='width: 100%' class=\"buttonCustomise btn btn-default\" type=\"submit\" value=\"Upload Image\" name=\"Submit\"><i class=\"fa fa-heart-o\" aria-hidden=\"true\" style=\"font-size: 1rem\"></i> <span>$n_total</span></button>";
                            ?>
                            </a>
                            <?php
                        } else{
                            //echo "estou neste evento";
                            echo "  <a href=\"scripts/status_eventos.php?naointeressado=$id_e\"><button style='width: 100%' class=\"buttonCustomise btn btn-default\" type=\"submit\" value=\"Upload Image\" name=\"Submit\"><i class=\"fa fa-heart\" aria-hidden=\"true\" style=\"font-size: 1rem; color: red;\"></i> <span>$n_total</span></button></a>";

                        }

                    }


                }



                ?>

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

                    <div class="text-center">
                        <button type="button" class="btn" style="background-color: #7FC53C; color: #fff;">Abrir no
                            grupo
                        </button>
                    </div>
                </div>
                <div class="mt-5 no-gutters ">
                    <div class=" mb-5 col-lg-12 col-sm-6 pl-4">
                        <h4 class="" style="font-weight: bold;">
                            Responsável</h4>

                    </div>

                    <div class="col-sm-4">
                        <div class="media-ranking-item terceiro-colocado">
                            <h5 class="name-user mt-2"><?= $responsavel ?></h5>
                            <small>Organizador</small>
                        </div>
                    </div>
                </div>
                </div>


                <?php


            }
        }
    }

}
?>






