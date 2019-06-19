<?php

if (isset($_GET["edit"])) {

    $nickname = $_GET["edit"];

// We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    $link3 = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $stmt3 = mysqli_stmt_init($link3);

    $query = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";


    $query3 = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $nickname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $active, $nome_tipo);

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
            <form style="display: block; margin: auto" id="form1" class="img_redonda"
                  action="../scripts/upload_imgperfil.php" method="post">

                <a href="criar_perfil.php?edit=<?= $nome_u ?>"><label class="label fa fa-pencil"
                                                                      for="imgInp"></label></a>

            </form>
            <?php
        }
    }
    ?>
    </div>
    <div class="avatar-preview">
        <img id="blah" class="img_redonda img-fluid" src="img/default.gif" alt="your image"/>
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
                <h6 class="mt-2">@<?= $nickname ?></h6>
                <p><?= $pontos ?></p>
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
                    <div class="col-4">
                        <div class="square "><img class="img-fluid cantos_redondos"
                                                  src="img/arvores.jpg"></div>
                    </div>

                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>

                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>

                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>

                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>

                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                    <div class="col-4">
                        <div class="square"><img class="img-fluid cantos_redondos"
                                                 src="img/arvores.jpg"></div>
                    </div>
                </div>
            </div>

            <!----------------------------------------MEDALHAS------------------------------------------------------------->
            <div id="medalhas" class="container tab-pane fade"><br>

                <h4 class="text-center mt-3 mb-3">Troféus</h4>


                <div class="row text-center">

                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/trof_plantar.png"></div>
                    </div>

                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/trof_anfibios.png"></div>
                    </div>
                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/trof_beatas.png"></div>
                    </div>


                </div>

                <h4 class="text-center mt-3 mb-3">Medalhas</h4>
                <div class="row text-center">

                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/med_lixo.png"></div>
                    </div>

                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/med_oceano.png"></div>
                    </div>
                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/med_abelhas.png"></div>
                    </div>
                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/med_plantar.png"></div>
                    </div>
                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/med_reciclar.png"></div>
                    </div>
                    <div class="col-4">
                        <div class="square1 img-fluid"><img src="img/med_frutas.png"></div>
                    </div>

                </div>

            </div>

            <!----------------------------------------EVENTOS--------------------------------------------------------->
            <div id="evento" class="container tab-pane fade">

                <h4 class="text-center mt-5 mb-3">Próximos eventos</h4>

                <div class="events row mx-auto">


                    <div class="event-card">
                        <img class="cantos_redondos" src="img/escavar.jpg" alt=""/>
                        <div class="description">
                            <h4 class="mt-2"><span style="font-weight: bold;">6 JUN | </span>BioLousada
                            </h4>
                            <p class="location mb-0">Serra da Lousada</p>
                            <i class="fa fa-clock-o mr-2" aria-hidden="true"></i>9h-16
                        </div>
                    </div>

                    <div class="event-card">
                        <img class="cantos_redondos" src="img/beata.jpg" alt=""/>
                        <div class="description">
                            <h4 class="mt-2"><span style="font-weight: bold;">6 JUN | </span>Campus Sem
                                Filtros
                            </h4>
                            <p class="location mb-0">Universidade de Aveiro</p>
                            <i class="fa fa-clock-o mr-2" aria-hidden="true"></i>14h-15h30
                        </div>
                    </div>

                </div>


                <h4 class="text-center mt-5 mb-3">Eventos passados</h4>

                <div class="events row mx-auto">

                    <div class="event-card cantos_redondos">
                        <img class="cantos_redondos" src="img/escavar.jpg" alt=""/>
                        <div class="description">
                            <h4 class="mt-2"><span style="font-weight: bold;">6 JUN | </span>BioLousada
                            </h4>
                            <p class="location mb-0">Serra da Lousada</p>
                            <i class="fa fa-clock-o mr-2" aria-hidden="true"></i>9h-16
                        </div>
                    </div>

                    <div class="event-card cantos_redondos ">
                        <img class="cantos_redondos" src="img/beata.jpg" alt=""/>
                        <div class="description">
                            <h4 class="mt-2"><span style="font-weight: bold;">6 JUN | </span>Campus Sem
                                Filtros
                            </h4>
                            <p class="location mb-0">Universidade de Aveiro</p>
                            <i class="fa fa-clock-o mr-2" aria-hidden="true"></i>14h-15h30
                        </div>
                    </div>

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
}
?>