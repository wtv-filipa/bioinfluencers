<?php

if (isset($_GET["user"])) {

    $nickname = $_GET["user"];

// We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();


    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);


    $query = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, img_perfil, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $nickname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $img_perfil, $active, $nome_tipo);

        ?>

        <header id="perfil">

        <div class="container">

        <div class="topo">

        </div>
        <!--DIV QUE CONTÉM OS SEGUIDORES E A FOTO DE PERFIL-->
        <div class="row text-center topo">

        <div class="col-4 text-right centro">
            <h5>2345 <br> Seguidores</h5>
        </div>

        <div class="col-4 tamanho">
        <div class="avatar-upload">
        <div class="avatar-edit">
        <?php
        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <form style="display: block; margin: auto" id="form1">

                <a href="criar_perfil.php?edit=<?= $nickname ?>"><label class="label fa fa-pencil"
                                                                        for="imgInp"></label></a>

            </form>
            <?php
        }
    }
    ?>
    </div>
    <div class="avatar-preview">
        <?php
        //var_dump($img_perfil);
        if (isset($img_perfil)) {
            ?>
            <img id="img_perf" class="img_redonda img-fluid" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                 alt="your image"/>
            <?php
        } else {
            ?>
            <img id="img_perf" class="img_redonda" src="img/default.gif" alt="your image"/>
            <?php
        }
        ?>


    </div>
    </div>
    </div>

    <div class="col-4 text-left centro">

        <h5>2345 <br> A seguir</h5>
    </div>

    </div>


    <!--DIV QUE CONTÉM O NOME E A PONTUAÇÃO DO UTILIZADOR-->
    <div class="text-center utilizador topo1">
        <?php

        // Create a new DB connection
        $link2 = new_db_connection();


        /* create a prepared statement */
        $stmt2 = mysqli_stmt_init($link2);


        $query2 = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";


        if (mysqli_stmt_prepare($stmt2, $query2)) {

            mysqli_stmt_bind_param($stmt2, 's', $nickname);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $active, $nome_tipo);


            while (mysqli_stmt_fetch($stmt2)) {
                ?>
                <h4 class="mt-2"><?= $nome_u ?></h4>
                <h6 class="mt-2">@<?= $nickname ?> |<b> <?= $pontos ?></b> pontos </h6>
                <?php
            }
        }
        ?>
    </div>

    <!--DIV QUE CONTÉM A DESCRIÇÃO DO UTILIZADOR-->
    <div class="alinhar">

        <div class="text-center ">
            <?php
            // Create a new DB connection
            $link3 = new_db_connection();


            /* create a prepared statement */
            $stmt3 = mysqli_stmt_init($link3);


            $query3 = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";


            if (mysqli_stmt_prepare($stmt3, $query3)) {

                mysqli_stmt_bind_param($stmt3, 's', $nickname);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $active, $nome_tipo);


                while (mysqli_stmt_fetch($stmt3)) {
                    ?>
                    <p class="text-center "><?= $descricao_u ?></p>

                    <?php
                }
            }

            ?>

        </div>

    </div>
    </div>
    </header>

    <!--DIV QUE É A "SEGUNDA NAV" AKA A QUE SELECIONA SE É IMAGENS, MEDALHAS OU CALENDÁRIO-->

    <div class="sticky">
        <div style="display: block; margin: auto;" class="container text-center">

            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item col-4">
                            <a class="nav-link active" data-toggle="tab" href="#galeria"><img
                                        class="img-fluid icon_perfil"
                                        src="img/galeria.png"></a>
                        </li>
                        <li class="nav-item col-4">
                            <a class="nav-link" data-toggle="tab" href="#medalhas"><img
                                        class="img-fluid"
                                        src="img/med_trof.png"></a>
                        </li>
                        <li class="nav-item col-4">
                            <a class="nav-link" data-toggle="tab" href="#evento"><img
                                        class="img-fluid"
                                        src="img/eventos.png"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Tab panes -->
    <div class="tab-content">

        <!----------------------------------------GALERIA------------------------------------------------------------->
        <div id="galeria" class="container tab-pane active"><br>
            <div class="row">
                <?php
                $link5 = new_db_connection();


                /* create a prepared statement */
                $stmt5 = mysqli_stmt_init($link5);


                $query5 = "SELECT id_conteudos, filename, partilhas_id_partilhas, id_partilhas, utilizadores_id_utilizadores,id_utilizadores FROM conteudos INNER JOIN partilhas ON conteudos.partilhas_id_partilhas= partilhas.id_partilhas INNER JOIN utilizadores ON partilhas.utilizadores_id_utilizadores= utilizadores.id_utilizadores
WHERE id_utilizadores=?";

                if (mysqli_stmt_prepare($stmt5, $query5)) {

                    mysqli_stmt_bind_param($stmt5, 'i', $id);
                    mysqli_stmt_execute($stmt5);
                    mysqli_stmt_bind_result($stmt5, $id_conteudos, $filename, $partilhas_id_partilhas, $id_partilhas, $utilizadores_id_utilizadores, $id);


                    while (mysqli_stmt_fetch($stmt5)) {
                        ?>

                        <div class="col-4">
                            <div class="square "><img class="img-fluid cantos_redondos" src="../admin/uploads/<?=$filename?>"></div>
                        </div>


                        <?php

                    }
                }
                ?>

            </div>
        </div>

        <!----------------------------------------MEDALHAS------------------------------------------------------------->
        <div id="medalhas" class="container tab-pane fade"><br>

            <h4 class="text-center mt-3 mb-3">Troféus</h4>


            <div class="row text-center">
                <?php
                // Create a new DB connection
                $link6 = new_db_connection();


                /* create a prepared statement */
                $stmt6 = mysqli_stmt_init($link6);


                $query6 = "SELECT COUNT(eventos_id_eventos), utilizadores_id_utilizadores, id_eventos, tema_evento_idtema_evento,id_utilizadores, id_tema_evento, nome_tema_e FROM eventos INNER JOIN utilizadores_has_eventos ON eventos.id_eventos= utilizadores_has_eventos.eventos_id_eventos INNER JOIN utilizadores ON utilizadores.id_utilizadores= utilizadores_has_eventos.utilizadores_id_utilizadores INNER JOIN temas_eventos ON eventos.tema_evento_idtema_evento= temas_eventos.id_tema_evento WHERE id_utilizadores=?";

                if (mysqli_stmt_prepare($stmt6, $query6)) {

                    mysqli_stmt_bind_param($stmt6, 'i', $id);
                    mysqli_stmt_execute($stmt6);
                    mysqli_stmt_bind_result($stmt6,  $ref_id_eventos,$ref_id_utilizadores, $id_eventos, $ref_tema_evento,$id, $id_tema, $nome_tema);


                    while (mysqli_stmt_fetch($stmt6)) {
                        ?>

                        <div class="col-4">
                            <?php
                            echo $nome_tema;

                            if ($ref_id_eventos >= 4 && $nome_tema=="anfíbios") {
                                    ?>

                                    <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                    <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/trof_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-4">
                            <?php
                            if ($ref_id_eventos >= 2 && $nome_tema=="plantação") {
                                    ?>

                                    <div class="square1 img-fluid"><img src="img/trofeus/trof_plantar.png"></div>

                                    <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/trof_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-4">
                            <?php

                            if ($ref_id_eventos >= 2 && $nome_tema=="beatas") {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_beatas.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/trof_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                    }
                }
                ?>

            </div>

            <h4 class="text-center mt-3 mb-3">Medalhas</h4>
            <div class="row text-center">

                <?php
                // Create a new DB connection
                $link4 = new_db_connection();


                /* create a prepared statement */
                $stmt4 = mysqli_stmt_init($link4);


                $query4 = "SELECT id_utilizadores, pontos
                              FROM utilizadores
                              WHERE nickname LIKE ?";


                if (mysqli_stmt_prepare($stmt4, $query4)) {

                    mysqli_stmt_bind_param($stmt4, 's', $nickname);
                    mysqli_stmt_execute($stmt4);
                    mysqli_stmt_bind_result($stmt4, $id, $pontos);


                    while (mysqli_stmt_fetch($stmt4)) {
                        ?>

                        <!--pontuação de 500-->
                        <div class="col-4">
                            <?php
                            if ($pontos >= 500) {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <!--pontuação de 1000-->
                        <div class="col-4">
                            <?php
                            if ($pontos >= 1000) {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <!--pontuação de 5000-->
                        <div class="col-4">
                            <?php
                            if ($pontos >= 5000) {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <!--pontuação de 10 000-->
                        <div class="col-4">
                            <?php
                            if ($pontos >= 10000) {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <!--pontuação de 25 000-->
                        <div class="col-4">
                            <?php
                            if ($pontos >= 25000) {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                        <!--pontuação de 50 000-->
                        <div class="col-4">
                            <?php
                            if ($pontos >= 50000) {
                                ?>

                                <div class="square1 img-fluid"><img src="img/trofeus/trof_anfibios.png"></div>

                                <?php
                            } else {
                                ?>
                                <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                <?php
                            }
                            ?>
                        </div>

                <div class="col-4">
                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                </div>

                <div class="col-4">
                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                </div>
                <div class="col-4">
                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                </div>
                <div class="col-4">
                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                </div>
                <div class="col-4">
                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                </div>
                <div class="col-4">
                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                </div>

                        <?php
                    }
                }
                ?>

            </div>

        </div>

        <!----------------------------------------EVENTOS--------------------------------------------------------->
        <div id="evento" class="container tab-pane fade">

            <h4 class="text-center mt-5 mb-3">Próximos eventos</h4>

            <div class="events row mx-auto">

    <?php
    $link6 = new_db_connection();


    /* create a prepared statement */
    $stmt6 = mysqli_stmt_init($link6);


    $query6 = "SELECT id_utilizadores,id_eventos, nome, data_inicio, hora_inicio, hora_fim, local, conteudos_id_conteudos, eventos_id_eventos, utilizadores_id_utilizadores, id_conteudos, filename FROM utilizadores INNER JOIN rsvp ON utilizadores.id_utilizadores= rsvp.utilizadores_id_utilizadores INNER JOIN eventos ON eventos.id_eventos= rsvp.eventos_id_eventos INNER JOIN conteudos ON conteudos.id_conteudos= eventos.conteudos_id_conteudos WHERE id_utilizadores=?";

    if (mysqli_stmt_prepare($stmt6, $query6)) {

        mysqli_stmt_bind_param($stmt6, 'i', $id);
        mysqli_stmt_execute($stmt6);
        mysqli_stmt_bind_result($stmt6, $id_utilizadores,$id_eventos, $nome, $data_inicio, $hora_inicio, $hora_fim, $local, $ref_conteudos, $ref_eventos, $ref_utilizadores, $id_conteudos, $img);


        while (mysqli_stmt_fetch($stmt6)) {
            //$nextWeek = time() + (7 * 24 * 60 * 60);
           $today=date('y-m-d');
           //echo $today;

           if(strtotime($today) < strtotime($data_inicio)){


            ?>

            <div class="event-card">
                <img class="cantos_redondos" src="../admin/uploads/<?=$img?>" alt=""/>
                <div class="description">
                    <h4 class="mt-2"><span style="font-weight: bold;"><?=$data_inicio?> | </span><?=$nome?>
                    </h4>
                    <p class="location mb-0"><?=$local?></p>
                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><?=substr($hora_inicio, 0, 5)?>h - <?=substr($hora_fim, 0, 5)?>h
                </div>
            </div>
            <?php
           }

        }
    }
            ?>

            </div>


            <h4 class="text-center mt-5 mb-3">Eventos passados</h4>

            <div class="events row mx-auto">

                <?php
                $link7 = new_db_connection();


                /* create a prepared statement */
                $stmt7 = mysqli_stmt_init($link7);


                $query7 = "SELECT id_utilizadores,id_eventos, nome, data_inicio, hora_inicio, hora_fim, local, conteudos_id_conteudos, eventos_id_eventos, utilizadores_id_utilizadores, id_conteudos, filename FROM utilizadores INNER JOIN rsvp ON utilizadores.id_utilizadores= rsvp.utilizadores_id_utilizadores INNER JOIN eventos ON eventos.id_eventos= rsvp.eventos_id_eventos INNER JOIN conteudos ON conteudos.id_conteudos= eventos.conteudos_id_conteudos WHERE id_utilizadores=?";


                if (mysqli_stmt_prepare($stmt7, $query7)) {

                    mysqli_stmt_bind_param($stmt7, 'i', $id);
                    mysqli_stmt_execute($stmt7);
                    mysqli_stmt_bind_result($stmt7, $id_utilizadores,$id_eventos, $nome, $data_inicio, $hora_inicio, $hora_fim, $local, $ref_conteudos, $ref_eventos, $ref_utilizadores, $id_conteudos, $img);


                    while (mysqli_stmt_fetch($stmt7)) {
                        //$nextWeek = time() + (7 * 24 * 60 * 60);
                        $today=date('y-m-d');
                        //echo $today;

                        if(strtotime($today) > strtotime($data_inicio)){


                            ?>

                            <div class="event-card">
                                <img class="cantos_redondos" src="../admin/uploads/<?=$img?>" alt=""/>
                                <div class="description">
                                    <h4 class="mt-2"><span style="font-weight: bold;"><?=$data_inicio?> | </span><?=$nome?>
                                    </h4>
                                    <p class="location mb-0"><?=$local?></p>
                                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><?=substr($hora_inicio, 0, 5)?>h - <?=substr($hora_fim, 0, 5)?>h
                                </div>
                            </div>
                            <?php
                        }

                    }
                }
                ?>

            </div>





            <?php
            if (isset($tipo)) {
                if ($tipo == 1 || $tipo == 3) {
                    ?>
                    <a href="#" class="float">
                        <i class="fa fa-calendar-plus-o my-float"></i>
                    </a>
                    <div class="label-container">
                        <div class="label-text">Criar evento</div>
                        <i class="fa fa-play label-arrow"></i>
                    </div>

                    <?php
                }
            }
            ?>


        </div>


    </div>


    <?php
}
?>