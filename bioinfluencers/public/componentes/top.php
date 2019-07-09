<div class=" container col-lg-8 col-sm-12 mx-auto mt-5">
    <h4 class="title-ranking">TOP 6</h4>
    <div class="row box-ranking no-gutters" style="margin-top: 9%">


<?php

        $link7 = new_db_connection();
        $stmt7 = mysqli_stmt_init($link7);

        $query7 = "SELECT id_utilizadores, nickname, pontos, img_perfil
        FROM utilizadores
        ORDER BY pontos DESC LIMIT 1";

        if (mysqli_stmt_prepare($stmt7, $query7)) {

        mysqli_stmt_execute($stmt7);
        mysqli_stmt_bind_result($stmt7, $id, $nome, $ptn, $img_perfil);
        while (mysqli_stmt_fetch($stmt7)) {
        ?>

        <div class="col-sm-4 primeiro-colocado phone1">
            <div class="media-ranking-item">
                <img class="coroas1" src="img/coroa1.png" alt="">
                <?php
                //var_dump($img_perfil);
                if ($img_perfil == "") {
                    //echo "NAO HA IMAGEM"
                    ?>
                    <img class="br img-ranking" src="img/default.gif" alt="your image">
                    <?php
                } else {
                    //echo "HA IMAGEM"
                    ?>
                    <img class="br img-ranking" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                         alt="your image">
                    <?php
                }
                ?>
                <a href="profile.php?user=<?=$id?>"><h5 class="name-user">#1 • <?= $nome ?></h5></a>
                <small><?= $ptn ?> pontos</small>
            </div>
        </div>
        <?php
            }
        }
        ?>






        <?php
        require_once("connections/connection.php");

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT id_utilizadores, nickname, pontos, img_perfil
              FROM utilizadores
             ORDER BY pontos DESC LIMIT 1 OFFSET 1";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id,$nome, $ptn, $img_perfil);
            while (mysqli_stmt_fetch($stmt)) {
                ?>
                <div class="col-sm-4">
                    <div class="media-ranking-item segundo-colocado">
                        <img class="coroas img-fluid" src="img/coroa2.png" alt="">
                        <?php
                        //var_dump($img_perfil);
                        if ($img_perfil == "") {
                            //echo "NAO HA IMAGEM"
                            ?>
                            <img class="br img-ranking" src="img/default.gif" alt="your image">
                            <?php
                        } else {
                            //echo "HA IMAGEM"
                            ?>
                            <img class="br img-ranking" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 alt="your image">
                            <?php
                        }
                        ?>
                        <a href="profile.php?user=<?=$id?>"><h5 class="name-user">#2 • <?= $nome ?></h5></a>
                        <small><?= $ptn ?> pontos</small>
                    </div>
                </div>


                <?php

            }

        }

        ?>
        <?php


        $link2 = new_db_connection();
        $stmt2 = mysqli_stmt_init($link2);

        $query2 = "SELECT id_utilizadores, nickname, pontos, img_perfil
              FROM utilizadores
             ORDER BY pontos DESC LIMIT 1";

        if (mysqli_stmt_prepare($stmt2, $query2)) {

            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $id, $nome, $ptn, $img_perfil);
            while (mysqli_stmt_fetch($stmt2)) {
                ?>

                <div class="col-sm-4 primeiro-colocado phone2">
                    <div class="media-ranking-item">
                        <img class="coroas1" src="img/coroa1.png" alt="">
                        <?php
                        //var_dump($img_perfil);
                        if ($img_perfil == "") {
                            //echo "NAO HA IMAGEM"
                            ?>
                            <img class="br img-ranking" src="img/default.gif" alt="your image">
                            <?php
                        } else {
                            //echo "HA IMAGEM"
                            ?>
                            <img class="br img-ranking" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 alt="your image">
                            <?php
                        }
                        ?>
                        <a href="profile.php?user=<?=$id?>"><h5 class="name-user">#1 • <?= $nome ?></h5></a>
                        <small><?= $ptn ?> pontos</small>
                    </div>
                </div>
                <?php
            }
        }
        ?>


        <?php


        $link3 = new_db_connection();
        $stmt3 = mysqli_stmt_init($link3);

        $query3 = "SELECT id_utilizadores, nickname, pontos, img_perfil
              FROM utilizadores
             ORDER BY pontos DESC LIMIT 1 OFFSET 2";

        if (mysqli_stmt_prepare($stmt3, $query3)) {

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $id,$nome, $ptn, $img_perfil);
            while (mysqli_stmt_fetch($stmt3)) {
                ?>

                <div class="col-sm-4 terceiro-colocado">
                    <div class="media-ranking-item">
                        <img class="coroas2 img-fluid" src="img/coroa2.png" alt="">
                        <?php
                        //var_dump($img_perfil);
                        if ($img_perfil == "") {
                            //echo "NAO HA IMAGEM"
                            ?>
                            <img class="br img-ranking" src="img/default.gif" alt="your image">
                            <?php
                        } else {
                            //echo "HA IMAGEM"
                            ?>
                            <img class="br img-ranking" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 alt="your image">
                            <?php
                        }
                        ?>
                        <a href="profile.php?user=<?=$id?>"><h5 class="name-user">#3 • <?= $nome ?></h5></a>
                        <small><?= $ptn ?> pontos</small>
                    </div>
                </div>
                <?php
            }
        }
        ?>


    </div>


    <hr>
    <div class="row linha-ultimos">


        <?php
        $cont = 4;

        $link4 = new_db_connection();
        $stmt4 = mysqli_stmt_init($link4);

        $query4 = "SELECT id_utilizadores, nickname, pontos, img_perfil
              FROM utilizadores
             ORDER BY pontos DESC LIMIT 3 OFFSET 3";

        if (mysqli_stmt_prepare($stmt4, $query4)) {
            mysqli_stmt_execute($stmt4);
            mysqli_stmt_bind_result($stmt4, $id, $nome, $ptn, $img_perfil);
            while (mysqli_stmt_fetch($stmt4)) {
                ?>

                <div class="col-md-12">
                    <div class="flex-row">
                        <h5 class="number-ranking-position">#<?= $cont++ ?></h5>
                        <?php
                        //var_dump($img_perfil);
                        if ($img_perfil == "") {
                            //echo "NAO HA IMAGEM"
                            ?>
                            <img class="br img-list-ultimos" src="img/default.gif" alt="your image">
                            <?php
                        } else {
                            //echo "HA IMAGEM"
                            ?>
                            <img class="br img-list-ultimos" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 alt="your image">
                            <?php
                        }
                        ?>


                        <div class="name-user-ranking-cidade">
                            <a href="profile.php?user=<?=$id?>"><h5 class="name-user-ultimos"><?= $nome ?></h5></a>
                            <span><?= $ptn ?> pontos</span>
                        </div>
                    </div>
                </div>


                <?php
            }
        }
        ?>
    </div>
</div>

<!-- INFLUENCERS EM DESTAQUE -->

<div class="row no-gutters" style="margin-top: 5%"><h3 class="mx-auto">
        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
        Em destaque</h3>

</div>

<div class="comment-container col-lg-8 col-xs-10 theme--light mx-auto mt-5">

    <div class="comments">
        <?php


        $link5 = new_db_connection();
        $stmt5 = mysqli_stmt_init($link5);

        $query5 = "SELECT COUNT(id_utilizadores) FROM  utilizadores";

        if (mysqli_stmt_prepare($stmt5, $query5)) {

            mysqli_stmt_execute($stmt5);
            mysqli_stmt_bind_result($stmt5, $nr_total);

            if (mysqli_stmt_fetch($stmt5)) {

                $array_noticias = array();


                $registos_mostra = 5;
                if ($nr_total < $registos_mostra) {
                    $registos_mostra = $nr_total;
                }

                for ($i = 1;
                     $i <= $registos_mostra;
                     $i++) {

                    $n_ale = rand(1, $nr_total);
                    $registo_ja_existe = in_array($n_ale, $array_noticias);

                    if ($registo_ja_existe == "") {
                        array_push($array_noticias, $n_ale);
                        $offset = $n_ale - 1;


                        $link6 = new_db_connection();
                        $stmt6 = mysqli_stmt_init($link6);

                        $query6 = "SELECT id_utilizadores, nickname, pontos, descricao_u,img_perfil
        FROM utilizadores
        ORDER BY pontos DESC LIMIT 1 OFFSET $offset";

                        if (mysqli_stmt_prepare($stmt6, $query6)) {

                            mysqli_stmt_execute($stmt6);
                            mysqli_stmt_bind_result($stmt6, $id, $nome, $ptn, $descricao, $img_perfil);
                            while (mysqli_stmt_fetch($stmt6)) {
                                ?>

                                <div class="mx-auto">
                                    <div class="carddest v-card v-sheet theme--light elevation-2 ">
                                        <div class="">
                                            <div class="v-avatar avatar_dest" style="height: 50px; width: 50px;">
                                                <?php
                                                //var_dump($img_perfil);
                                                if ($img_perfil == "") {
                                                    //echo "NAO HA IMAGEM"
                                                    ?>
                                                    <img class="br img-ranking" src="img/default.gif" alt="your image">
                                                    <?php
                                                } else {
                                                    //echo "HA IMAGEM"
                                                    ?>
                                                    <img class="br img-ranking"
                                                         src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                                         alt="your image">
                                                    <?php
                                                }
                                                ?>
                                            </div>


                                            <a href="profile.php?user=<?=$id?>"><span class="displayName title"><?= $nome ?> |</span></a> <span
                                                    class=""><?= $ptn ?> pontos</span>
                                        </div>
                                        <!---->
                                        <div class="wrapper comment">
                                            <p><?= $descricao ?></p>
                                        </div>
                                    </div>

                                </div>

                                <?php

                            }

                        }
                    } else {
                        $i--;
                    }
                }
            }
        }
        ?>
    </div>

