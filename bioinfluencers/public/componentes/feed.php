<div class="container">
    <?php
    $id_u_feed = $_SESSION["id_utilizadores"];
    require_once "connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_partilhas, data_hora, descricao_p, utilizadores_id_utilizadores_p, eventos_id_eventos, id_utilizadores, nickname, img_perfil, filename, partilhas_id_partilhas, utilizadores_id_utilizadores, seguidores, id_eventos, nome, data_inicio, data_fim, descricao, local, conteudos_id_conteudos
              FROM partilhas
              LEFT JOIN conteudos
              ON partilhas.id_partilhas = conteudos.partilhas_id_partilhas
              INNER JOIN utilizadores
              ON partilhas.utilizadores_id_utilizadores_p = utilizadores.id_utilizadores
              INNER JOIN utilizadores_has_utilizadores
              ON partilhas.utilizadores_id_utilizadores_p = utilizadores_has_utilizadores.utilizadores_id_utilizadores
              LEFT JOIN eventos
              ON partilhas.eventos_id_eventos = eventos.id_eventos
              WHERE seguidores = ?
              ORDER BY data_hora DESC";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_u_feed);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_partilhas, $data_hora, $descricao_p, $utilizadores_id_utilizadores_p, $eventos_id_eventos, $id_utilizadores, $nome_u, $img_perfil, $filename, $partilhas_id_partilhas, $utilizadores_id_utilizadores, $id_u_feed, $id_e, $nome, $data_inicio, $data_fim, $descricao, $local, $conteudos_id_conteudos);

        while (mysqli_stmt_fetch($stmt)) {

            if ($eventos_id_eventos == null) {
                ?>
                <div class="row no-gutters"  data-aos="fade-up" >
                    <div class="card test">
                        <div class="header">
                            <div class="right-side">

                                <a href="profile.php?user=<?= $id_utilizadores ?>">
                                    <?php
                                    if (isset($img_perfil)) {
                                        ?>
                                        <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                             class="avatar"/>
                                        <?php
                                    } else {
                                        ?>
                                        <img src="img/default.gif" class="avatar"/>
                                        <?php
                                    }
                                    ?>
                                </a>
                                <div class="headers-text ml-2">
                                    <a href="profile.php?user=<?= $id_utilizadores ?>"><span
                                                class="author-name"><?= $nome_u ?></span></a>
                                    <span class="header-secondary-text"><?= substr($data_hora, 10, 6) ?></span>
                                </div>
                            </div>
                            <i class="material-icons dropdown-icon">expand_more</i>
                        </div>

                        <div class="text-content">
                            <p><?= $descricao_p ?></p>
                        </div>
                        <?php
                        if (isset($partilhas_id_partilhas)) {
                            ?>

                            <div class="photo-content">
                                <div class="photo two">
                                    <img class="card-photo" src="../admin/uploads/publicacao/<?= $filename ?>"/>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div></div>
                            <?php
                        }
                        ?>
                        <div class="actions">
                            <div class="like-wrapper">
                                <?php


                                // Create a new DB connection
                                $link2 = new_db_connection();

                                /* create a prepared statement */
                                $stmt2 = mysqli_stmt_init($link2);

                                $query2 = "SELECT utilizadores_id_utilizadores
                                FROM gostos
                                WHERE utilizadores_id_utilizadores = ? AND partilhas_id_partilhas = ?";


                                if (mysqli_stmt_prepare($stmt2, $query2)) {
                                    mysqli_stmt_bind_param($stmt2, 'ii', $id_u_feed, $id_partilhas);
                                    mysqli_stmt_execute($stmt2);
                                    mysqli_stmt_bind_result($stmt2, $id_u_feed);


                                    ?>

                                <a href="scripts/gostos.php?g=<?= $id_partilhas ?>" style="text-decoration: none">
                                    <?php
                                    if (!mysqli_stmt_fetch($stmt2)) {
                                        //echo $id_partilhas;
                                        //echo $id_u_feed;

                                        $link3 = new_db_connection();
                                        $stmt3 = mysqli_stmt_init($link3);

                                        $query3 = "SELECT COUNT(utilizadores_id_utilizadores) 
                                   FROM gostos
                                  WHERE partilhas_id_partilhas = ?";

                                        if (mysqli_stmt_prepare($stmt3, $query3)) {
                                            mysqli_stmt_bind_param($stmt3, 'i', $id_partilhas);
                                            mysqli_stmt_execute($stmt3);
                                            mysqli_stmt_bind_result($stmt3, $total_gostos);

                                            if (mysqli_stmt_fetch($stmt3)) {
                                                if ($total_gostos == 1) {
                                                    echo "<span class=\"fa fa-leaf gosto\" aria-hidden=\"true\" style=\"font-size: 1.5rem\">
                            <span class=\"like-napis-dla-rafala\">$total_gostos gosto</span>
                        </span>";
                                                } else {


                                                    echo "<span class=\"fa fa-leaf gosto\" aria-hidden=\"true\" style=\"font-size: 1.5rem\">
                            <span class=\"like-napis-dla-rafala\">$total_gostos gostos</span>
                        </span>";
                                                }
                                            }
                                        }
                                        ?>
                                        </a>
                                        <?php
                                    } else {
                                        $link3 = new_db_connection();
                                        $stmt3 = mysqli_stmt_init($link3);

                                        $query3 = "SELECT COUNT(utilizadores_id_utilizadores) 
                                   FROM gostos
                                  WHERE partilhas_id_partilhas = ?";

                                        if (mysqli_stmt_prepare($stmt3, $query3)) {
                                            mysqli_stmt_bind_param($stmt3, 'i', $id_partilhas);
                                            mysqli_stmt_execute($stmt3);
                                            mysqli_stmt_bind_result($stmt3, $total_gostos);

                                            if (mysqli_stmt_fetch($stmt3)) {
                                                if ($total_gostos == 1) {
                                                    echo "
                            <a href=\"scripts/gostos.php?ng=$id_partilhas\" style=\"text-decoration: none\">
                            <span class=\"fa fa-leaf gosto1\" aria-hidden=\"true\" style=\"font-size: 1.5rem\">
                            <span class=\"like-napis-dla-rafala\">$total_gostos gosto</span>
                        </span>
                            </a>";
                                                } else {
                                                    echo "
                            <a href=\"scripts/gostos.php?ng=$id_partilhas\" style=\"text-decoration: none\">
                            <span class=\"fa fa-leaf gosto1\" aria-hidden=\"true\" style=\"font-size: 1.5rem\">
                            <span class=\"like-napis-dla-rafala\">$total_gostos gostos</span>
                        </span>
                            </a>";
                                                }
                                            }
                                        }
                                    }
                                }


                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row no-gutters">
                    <div class="card test">
                        <div class="event-card ml-3"  data-aos="fade-up" >
                            <div>
                                <a href="evento_indv.php?id_e=<?= $id_e ?>">
                                    <h4 class="mt-2" style="text-decoration: none !important;"><i class="fa fa-calendar-o  mr-2" aria-hidden="true"></i>
                                        <span style="font-weight: bold;"><?= $nome ?>
                                            |   <?= substr($data_inicio, 8,2 ) ?>/<?= substr($data_inicio, 5,2 ) ?>
                                    </h4>
                                </a>
                            </div>
                            <div class="description">

                                <p class="mb-0"><i class="fa fa-map-marker  mr-2" aria-hidden="true"></i><?= $local ?></p>
                                <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><?= substr($data_inicio, 10, 6) ?>h
                                - <?= substr($data_fim, 10, 6) ?>h
                                <div class="controls w-50 mx-auto">

                                    <a href="evento_indv.php?id_e=<?= $id_e ?>">
                                        <button style="font-size: 1.3rem; color: black; width: 100%"
                                                class="buttonCustomise1 btn btn-default "><i class="fa fa-plus-circle"
                                                                                             aria-hidden="true"></i>
                                            <span style="font-size: 1.1rem">Ver mais</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

        }
    }
    ?>
    <a href="criar_publicacao.php" class="float">
        <i class="fa  fa-pencil-square-o my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Criar publicação</div>
        <i class="fa fa-play label-arrow"></i>
    </div>
</div>

