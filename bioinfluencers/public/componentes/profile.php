<?php

if (isset($_GET["user"]) && $_SESSION["id_utilizadores"]) {

    $id_u = $_GET["user"];
    $id_navegar= $_SESSION["id_utilizadores"];

    if ($id_u != $id_navegar) {

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
                              WHERE  id_utilizadores=?";

        // Create a new DB connection
        $link16 = new_db_connection();


        /* create a prepared statement */
        $stmt16 = mysqli_stmt_init($link16);


        $query16 = "SELECT COUNT(seguidores) FROM utilizadores_has_utilizadores INNER JOIN utilizadores ON utilizadores_has_utilizadores.utilizadores_id_utilizadores= utilizadores.id_utilizadores
WHERE id_utilizadores=?  AND utilizadores_id_utilizadores!=seguidores";


        // Create a new DB connection
        $link17 = new_db_connection();


        /* create a prepared statement */
        $stmt17 = mysqli_stmt_init($link17);


        $query17 = "SELECT COUNT(utilizadores_id_utilizadores) FROM utilizadores_has_utilizadores
WHERE seguidores=?  AND utilizadores_id_utilizadores!=seguidores";


        ?>

            <header id="perfil">

            <div class="container">
                <div class="topo">

                </div>
                <?php
                if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "ocorreu um erro, por favor tente novamente...";
                            $class = "alert-warning";
                            break;
                        default:
                            $msg_show = false;
                    }

                    echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                }
                ?>


            <!--DIV QUE CONTÉM OS SEGUIDORES E A FOTO DE PERFIL-->
            <div class="row text-center topo">

            <div class="col-4 text-right centro">
                <?php
                if (mysqli_stmt_prepare($stmt16, $query16)) {

                    mysqli_stmt_bind_param($stmt16, 'i', $id_u);
                    mysqli_stmt_execute($stmt16);
                    mysqli_stmt_bind_result($stmt16, $num_seguidores);

                    while (mysqli_stmt_fetch($stmt16)) {
                        echo "<h5 class=\"alinhar1\"> <span class=\"font-weight-bolder\">$num_seguidores</span> <br> Seguidores</h5>";
                    }
                }
                ?>
            </div>

            <div class="col-4 tamanho">
            <div class="avatar-upload">
            <div class="avatar-edit">
            <?php
            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'i', $id_u);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_u, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $img_perfil, $active, $nome_tipo);
            while (mysqli_stmt_fetch($stmt)) {

        ?>
        </div>
        <div class="avatar-preview">
            <?php
            //var_dump($img_perfil);
            if (isset($img_perfil)) {
                ?>
                <img id="img_perf" class="img_redonda" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                     alt="your image"/>
                <?php
            } else {
                ?>
                <img id="img_perf" class="img_redonda" src="img/default.gif" alt="your image"/>
                <?php
            }
            }
            }
            ?>


        </div>
        </div>
        </div>

        <div class="col-4 text-left centro">
            <?php
            if (mysqli_stmt_prepare($stmt17, $query17)) {

                mysqli_stmt_bind_param($stmt17, 'i', $id_u);
                mysqli_stmt_execute($stmt17);
                mysqli_stmt_bind_result($stmt17, $num_aseguir);

                while (mysqli_stmt_fetch($stmt17)) {
                    echo "<h5 class=\"alinhar1\"> <span class=\"font-weight-bolder\">$num_aseguir</span> <br> A Seguir</h5>";
                }
            }
            ?>
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
                mysqli_stmt_bind_result($stmt2, $id_u, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $active, $nome_tipo);


                while (mysqli_stmt_fetch($stmt2)) {
                    ?>
                    <h4 class="cima"><?= $nome_u ?></h4>

                <a href="scripts/seguir.php?segue=<?=$id_u?>">
                    <?php

                    // Create a new DB connection
                    $link14 = new_db_connection();

                    /* create a prepared statement */
                    $stmt14 = mysqli_stmt_init($link14);


                    $query14 = "SELECT utilizadores_id_utilizadores
FROM utilizadores_has_utilizadores
WHERE utilizadores_id_utilizadores = ? AND seguidores = ?";

                    if (mysqli_stmt_prepare($stmt14, $query14)) {

                        mysqli_stmt_bind_param($stmt14, 'ii', $id_u, $id_navegar);
                        mysqli_stmt_execute($stmt14);
                        mysqli_stmt_bind_result($stmt14, $id_u);

                        if (!mysqli_stmt_fetch($stmt14)){
                            //echo "no results";
                            echo "
<button style='width: 12%' class=\"buttonCustomise btn btn-primary\" type=\"submit\" value=\"Upload Image\" name=\"Submit\"> Seguir</button>
";
                            ?>
                            </a>
                            <?php
                        }

                        else{
                            //echo "relação existe";
                            echo " <a href=\"scripts/seguir.php?naosegue=$id_u\"><button style='width: 12%; background-color: #f1f2f2; color: black;' class=\"buttonCustomise btn btn-light\" type=\"submit\" value=\"Upload Image\" name=\"Submit\">Não Seguir </button></a>";
                        }

                    }

                    ?>


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


                $query3 = "SELECT id_utilizadores, nickname, descricao_u
                              FROM utilizadores
                              WHERE nickname LIKE ?";


                if (mysqli_stmt_prepare($stmt3, $query3)) {

                    mysqli_stmt_bind_param($stmt3, 's', $nickname);
                    mysqli_stmt_execute($stmt3);
                    mysqli_stmt_bind_result($stmt3, $id_u,  $nickname,  $descricao_u);


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
                                            style="display: block; margin: auto" src="img/galeria.png"></a>
                            </li>
                            <li class="nav-item col-4">
                                <a class="nav-link" data-toggle="tab" href="#medalhas"><img
                                            style="display: block; margin: auto" src="img/med_trof.png"></a>
                            </li>
                            <li class="nav-item col-4">
                                <a class="nav-link" data-toggle="tab" href="#evento"><img
                                            style="display: block; margin: auto" src="img/eventos.png"></a>
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


                    $query5 = "SELECT id_conteudos, filename FROM conteudos INNER JOIN partilhas ON conteudos.partilhas_id_partilhas= partilhas.id_partilhas INNER JOIN utilizadores ON partilhas.utilizadores_id_utilizadores_p= utilizadores.id_utilizadores
WHERE id_utilizadores=?";

                    if (mysqli_stmt_prepare($stmt5, $query5)) {

                        mysqli_stmt_bind_param($stmt5, 'i', $id_u);
                        mysqli_stmt_execute($stmt5);
                        mysqli_stmt_bind_result($stmt5, $id_conteudos, $filename);


                        while (mysqli_stmt_fetch($stmt5)) {
                            ?>

                            <div class="col-4" data-aos="fade-up">
                                <a href="publicacao_ind.php?img=<?=$id_conteudos?>">
                                <div class="square "><img class="img-fluid cantos_redondos"
                                                          src="../admin/uploads/publicacao/<?= $filename ?>"></div>
                                </a>
                            </div>


                            <?php

                        }
                    }
                    ?>

                </div>
            </div>

            <!----------------------------------------MEDALHAS------------------------------------------------------------->
            <div id="medalhas" data-aos="fade-up" class="container tab-pane fade"><br>

                <h2 style="font-weight: 500" class="text-center mt-3 mb-3">Troféus</h2>


                <div class="row text-center">
                    <!-------TROFÉUS------>

                    <?php
                    // Create a new DB connection
                    $link12 = new_db_connection();
                    /* create a prepared statement */
                    $stmt12 = mysqli_stmt_init($link12);

                    $query12 = "SELECT id_utilizadores, nome_tema_e, COUNT(id_tema_evento) 
                              FROM utilizadores 
                              INNER JOIN utilizadores_has_eventos
                              ON utilizadores.id_utilizadores=utilizadores_has_eventos.utilizadores_id_utilizadores
                              INNER JOIN eventos
                              ON eventos.id_eventos=utilizadores_has_eventos.eventos_id_eventos
                              INNER JOIN temas_eventos
                              ON temas_eventos.id_tema_evento= eventos.tema_evento_idtema_evento
                              WHERE id_utilizadores=?
                              GROUP BY id_tema_evento";


                    if (mysqli_stmt_prepare($stmt12, $query12)) {

                        mysqli_stmt_bind_param($stmt12, 'i', $id_u);
                        mysqli_stmt_execute($stmt12);
                        mysqli_stmt_bind_result($stmt12, $id_u, $nome_tema, $n_total);



                        while (mysqli_stmt_fetch($stmt12)) {
                            if (isset($nome_tema)) {


                                if ($n_total >= 5 && $nome_tema == 'abelhas') {
                                    echo "<div class=\"col-4\">
                          
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_abelhas.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'anfíbios') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_anfibios.png\"></div>
</div>";

                                }
                                if ($n_total >= 5 && $nome_tema == 'animais') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_animais.png\"></div>
</div>";

                                }
                                if ($n_total >= 8 && $nome_tema == 'beatas') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_beatas.png\"></div>
</div>";

                                }
                                if ($n_total >= 5 && $nome_tema == 'árvores de fruto') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_frutos.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'incêndios florestais') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_incendios.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'insetos') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_insetos.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'observação animal') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_observacao.png\"></div>
</div>";
                                }
                                if ($n_total >= 6 && $nome_tema == 'palestras') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_palestras.png\"></div>
</div>";
                                }
                                if ($n_total >= 8 && $nome_tema == 'plantação') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_plantar.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'poluição') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_poluicao.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'praias') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_praias.png\"></div>
</div>";
                                }
                                if ($n_total >= 5 && $nome_tema == 'reciclagem') {
                                    echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/trof_reciclar.png\"></div>
</div>";
                                }


                            }
                        }
                    }
                    mysqli_close($link12);

                    ?>

                    <!----------------FIM----------------->
                </div>

                <h2 style="font-weight: 500" class="text-center mt-3 mb-3" data-aos="fade-up">Medalhas</h2>
                <div class="row text-center">

                    <!-------MEDALHAS------>

                    <?php
                    // Create a new DB connection
                    $link10 = new_db_connection();
                    /* create a prepared statement */
                    $stmt10 = mysqli_stmt_init($link10);

                    $query10 = "SELECT DISTINCT id_utilizadores, id_tema_evento, nome_tema_e
                              FROM utilizadores 
                              INNER JOIN utilizadores_has_eventos
                              ON utilizadores.id_utilizadores=utilizadores_has_eventos.utilizadores_id_utilizadores
                              INNER JOIN eventos
                              ON eventos.id_eventos=utilizadores_has_eventos.eventos_id_eventos
                              INNER JOIN temas_eventos
                              ON temas_eventos.id_tema_evento= eventos.tema_evento_idtema_evento
                              WHERE id_utilizadores=?";


                    if (mysqli_stmt_prepare($stmt10, $query10)) {

                        mysqli_stmt_bind_param($stmt10, 'i', $id_u);
                        mysqli_stmt_execute($stmt10);
                        mysqli_stmt_bind_result($stmt10, $id_u, $id_tema_evento, $nome_tema);


                        while (mysqli_stmt_fetch($stmt10)) {
                            if (isset($nome_tema)) {


                                // Create a new DB connection
                                $link11 = new_db_connection();
                                /* create a prepared statement */
                                $stmt11 = mysqli_stmt_init($link11);
                                $query11 = "SELECT COUNT(eventos_id_eventos) FROM utilizadores_has_eventos";

                                if (mysqli_stmt_prepare($stmt11, $query11)) {

                                    mysqli_stmt_execute($stmt11);
                                    mysqli_stmt_bind_result($stmt11, $n_total);
                                    mysqli_stmt_fetch($stmt11);

                                    if ($n_total >= 1 && $nome_tema == 'abelhas' || $nome_tema == 'anfíbios' || $nome_tema == 'animais' || $nome_tema == 'beatas' || $nome_tema == 'árvores de fruto' || $nome_tema == 'incêndios florestais' || $nome_tema == 'insetos' || $nome_tema == 'observação animal' || $nome_tema == 'palestras' || $nome_tema == 'plantação' || $nome_tema == 'poluição' || $nome_tema == 'praias' || $nome_tema == 'reciclagem') {

                                        switch ($nome_tema) {
                                            //medalha das abelhas
                                            case 'abelhas':
                                                echo "<div class=\"col-4\">
                          
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_abelhas.png\"></div>
</div>";
                                                break;

                                            //medalha dos anfibios
                                            case 'anfíbios':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_anfibios.png\"></div>
</div>";
                                                break;

                                            //medalha dos animais
                                            case 'animais':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_animais.png\"></div>
</div>";
                                                break;
                                            //medalha das beatas
                                            case 'beatas':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_beatas.png\"></div>
</div>";
                                                break;
                                            //medalha das arvores de fruto
                                            case 'árvores de fruto':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_frutas.png\"></div>
</div>";
                                                break;

                                            //medalha dos incêndios
                                            case 'incêndios florestais':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_incendio.png\"></div>
</div>";
                                                break;
                                            //medalha dos insetos
                                            case 'insetos':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_insetos.png\"></div>
</div>";
                                                break;

                                            //medalha da observação animal
                                            case 'observação animal':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_observacao.png\"></div>
</div>";
                                                break;
                                            //medalha das palestras
                                            case 'palestras':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_palestras.png\"></div>
</div>";
                                                break;

                                            //medalha da plantação
                                            case 'plantação':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_plantar.png\"></div>
</div>";
                                                break;

                                            //medalha da poluição
                                            case 'poluição':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_poluicao.png\"></div>
</div>";
                                                break;

                                            //medalha das praias
                                            case 'praias':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_praias.png\"></div>
</div>";
                                                break;

                                            //medalha da reciclagem
                                            case 'reciclagem':
                                                echo "<div class=\"col-4\">
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_reciclar.png\"></div>
</div>";
                                                break;

                                        }

                                    } else {

                                        echo "<div class=\"col-4\">
                                           ahahaha
<div class=\"square1 img-fluid\"><img src=\"img/trofeus/med_default.png\"></div>
</div>";
                                    }

                                }
                                mysqli_close($link11);
                            }
                        }
                    }
                    mysqli_close($link10);

                    ?>

                    <!----------------FIM----------------->


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
                        mysqli_stmt_bind_result($stmt4, $id_u, $pontos);


                        while (mysqli_stmt_fetch($stmt4)) {
                            ?>

                            <!--pontuação de 500-->

                            <?php
                            if ($pontos >= 500) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/500pt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 1000-->

                            <?php
                            if ($pontos >= 1000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/1kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 3000-->

                            <?php
                            if ($pontos >= 3000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/3kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 5000-->

                            <?php
                            if ($pontos >= 5000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/5kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 10 000-->

                            <?php
                            if ($pontos >= 10000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/10kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 20 000-->

                            <?php
                            if ($pontos >= 20000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/20kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 30 000-->

                            <?php
                            if ($pontos >= 30000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/30kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <!--pontuação de 50 000-->

                            <?php
                            if ($pontos >= 50000) {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/50kpt.png"></div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="col-4">
                                    <div class="square1 img-fluid"><img src="img/trofeus/med_default.png"></div>
                                </div>
                                <?php
                            }
                            ?>


                            <?php
                        }
                    }
                    ?>


                </div>

            </div>

            <!----------------------------------------EVENTOS--------------------------------------------------------->
            <div id="evento" class="container tab-pane fade">

                <h2 style="font-weight: 500" class="text-center mt-5 mb-3">Próximos eventos</h2>

                <div class="events row mx-auto" data-aos="fade-up" >

                    <?php
                    $link6 = new_db_connection();


                    /* create a prepared statement */
                    $stmt6 = mysqli_stmt_init($link6);


                    $query6 = "SELECT id_utilizadores,id_eventos, nome, data_inicio, data_fim, local, conteudos_id_conteudos, eventos_interesse, utilizadores_interessados, id_conteudos, filename FROM utilizadores INNER JOIN rsvp ON utilizadores.id_utilizadores= rsvp.utilizadores_interessados INNER JOIN eventos ON eventos.id_eventos= rsvp.eventos_interesse INNER JOIN conteudos ON conteudos.id_conteudos= eventos.conteudos_id_conteudos WHERE id_utilizadores=?";

                    if (mysqli_stmt_prepare($stmt6, $query6)) {

                        mysqli_stmt_bind_param($stmt6, 'i', $id_u);
                        mysqli_stmt_execute($stmt6);
                        mysqli_stmt_bind_result($stmt6, $id_u, $id_eventos, $nome, $data_inicio, $data_fim, $local, $ref_conteudos, $ref_eventos, $ref_utilizadores, $id_conteudos, $img);


                        while (mysqli_stmt_fetch($stmt6)) {
                            //$nextWeek = time() + (7 * 24 * 60 * 60);
                            $today = date('Y-m-d H:i:s');
                            //echo $today;

                            if (strtotime($today) < strtotime($data_inicio)) {


                                ?>

                                <div class="event-card">
                                    <img class="cantos_redondos" src="../admin/uploads/eventos/<?=$img?>" alt=""/>
                                    <div class="description">
                                        <h4 class="mt-2"><span style="font-weight: bold;"><?= substr($data_inicio, 0, 10)?>
                                                | </span><?= $nome ?>
                                        </h4>
                                        <p class="location mb-0"><?= $local ?></p>
                                        <i class="fa fa-clock-o mr-2"
                                           aria-hidden="true"></i><?= substr($data_inicio, 10, 6)?>h
                                        - <?= substr($data_fim, 10, 6) ?>h
                                    </div>
                                </div>
                                <?php
                            }

                        }
                    }
                    ?>

                </div>


                <h2 style="font-weight: 500" class="text-center mt-5 mb-3" >Eventos passados</h2>

                <div class="events row mx-auto">

                    <?php
                    $link7 = new_db_connection();


                    /* create a prepared statement */
                    $stmt7 = mysqli_stmt_init($link7);


                    $query7 = "SELECT id_utilizadores,id_eventos, nome, data_inicio, data_fim, local, conteudos_id_conteudos, eventos_interesse, utilizadores_interessados, id_conteudos, filename FROM utilizadores INNER JOIN rsvp ON utilizadores.id_utilizadores= rsvp.utilizadores_interessados INNER JOIN eventos ON eventos.id_eventos= rsvp.eventos_interesse INNER JOIN conteudos ON conteudos.id_conteudos= eventos.conteudos_id_conteudos WHERE id_utilizadores=?";


                    if (mysqli_stmt_prepare($stmt7, $query7)) {

                        mysqli_stmt_bind_param($stmt7, 'i', $id_u);
                        mysqli_stmt_execute($stmt7);
                        mysqli_stmt_bind_result($stmt7, $id_u, $id_eventos, $nome, $data_inicio, $data_fim, $local, $ref_conteudos, $ref_eventos, $ref_utilizadores, $id_conteudos, $img);


                        while (mysqli_stmt_fetch($stmt7)) {
                            //$nextWeek = time() + (7 * 24 * 60 * 60);
                            $today = date('Y-m-d H:i:s');
                            //echo $today;

                            if (strtotime($today) > strtotime($data_inicio)) {


                                ?>

                                <div class="event-card"  data-aos="fade-up" >
                                    <img class="cantos_redondos" src="../admin/uploads/eventos/<?=$img?>" alt=""/>
                                    <div class="description">
                                        <h4 class="mt-2"><span style="font-weight: bold;"><?= substr($data_inicio, 0, 10)?>
                                                | </span><?= $nome ?>
                                        </h4>
                                        <p class="location mb-0"><?= $local ?></p>
                                        <i class="fa fa-clock-o mr-2"
                                           aria-hidden="true"></i><?= substr($data_inicio, 10, 6)?>h
                                        - <?= substr($data_fim, 10, 6) ?>h
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
                        <a href="criar_evento.php" class="float">
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
    }else{

        $link15 = new_db_connection();


        /* create a prepared statement */
        $stmt15 = mysqli_stmt_init($link15);


        $query15 = "SELECT nickname FROM utilizadores  WHERE id_utilizadores=?";


        if (mysqli_stmt_prepare($stmt15, $query15)) {

            mysqli_stmt_bind_param($stmt15, 'i', $id_navegar);
            mysqli_stmt_execute($stmt15);
            mysqli_stmt_bind_result($stmt15, $nickname_navegar);


            while (mysqli_stmt_fetch($stmt15)) {

                echo "<meta http-equiv=\"refresh\" content=\"0;perfil.php?user=".$nickname_navegar."\" />";

                //echo "és tu mesmo $nickname_navegar";
            }
        }

    }
}
?>