<div class="container">
    <div id="demo" class="carousel slide mb-5" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <?php
            require_once("connections/connection.php");

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT id_foruns, nome_forum, descricao, data_criacao_f FROM foruns ORDER BY data_criacao_f DESC LIMIT 3";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id, $nome_f, $descricao, $data_criacao_f);
                $active = true;

                while (mysqli_stmt_fetch($stmt)) {
                    if ($active == true) {

                        ?>
                        <div class="carousel-item active">
                            <img class="img-fluid" src="img/beata_n.jpg" alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption">
                                <h3><?= $nome_f ?></h3>
                                <p><?= $descricao ?></p>
                            </div>
                        </div>

                        <?php
                        $active = false;
                    } else {
                        ?>
                        <div class="carousel-item">
                            <img class="img-fluid" src="img/beata_n.jpg" alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption">
                                <h3><?= $nome_f ?></h3>
                                <p><?= $descricao ?></p>
                            </div>
                        </div>
                        <?php
                    }
                }
            }

            ?>

        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <div class="row no-gutters">
        <h3 class="">Temas Populares</h3>

    </div>

    <div class="events1 mx-auto">
        <?php

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT COUNT(id_foruns) FROM foruns";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $nr_total);

            if (mysqli_stmt_fetch($stmt)) {

                $array_noticias = array();


                $registos_mostra = 4;
                if ($nr_total < $registos_mostra) {
                    $registos_mostra = $nr_total;
                }

                for ($i = 1; $i <= $registos_mostra; $i++) {

                    $n_ale = rand(1, $nr_total);

                    $registo_ja_existe = in_array($n_ale, $array_noticias);


                    if ($registo_ja_existe == "") {
                        array_push($array_noticias, $n_ale);

                        $offset = $n_ale - 1;
                        $query = "SELECT id_foruns, nome_forum, descricao
                                  FROM foruns
                                  LIMIT 1 OFFSET $offset";
                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id, $nome_forum, $descricao);

                            mysqli_stmt_fetch($stmt)
                            ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mx-auto p-0">

                                <div class="event-card1 ">
                                    <div class="mg-image">
                                        <img src="img/escavar.jpg" alt=""/>
                                    </div>

                                    <div class="description">

                                        <h4 class="mt-2"><?= $nome_forum ?></h4>
                                        <p class="mb-0"><?= $descricao ?></p>

                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        $i--;
                    }
                }
            }
        }

        ?>
    </div>


    <div>
        <div class="row mb-3">
            <div class="col-xl-8 col-lg-8 col-sm-12 mb-2 lili">
                <h3>Encontra aqui todos os grupos disponíveis</h3>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-8 mb-5 mx-auto">
                <div class="dropdown text-center">
                    <button class="btn btn-default dropdown-toggle botao_select" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Seleciona a categoria
                    </button>
                    <div class="dropdown-menu drop_select" aria-labelledby="dropdownMenuButton">
                        <?php

                        $link2 = new_db_connection();
                        $stmt2 = mysqli_stmt_init($link2);
                        $query2 = "SELECT id_categorias, nome_categoria
                              FROM categorias";

                        if (mysqli_stmt_prepare($stmt2, $query2)) {

                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $id_c, $nome_c);

                            while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                <a class="dropdown-item" href="#"><?= $nome_c ?></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>





        <?php
        $link3 = new_db_connection();
        $stmt3 = mysqli_stmt_init($link3);

        $query3 = "SELECT id_foruns, nome_forum, descricao
                  FROM foruns";

        if (mysqli_stmt_prepare($stmt3, $query3)) {

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $id, $nome_forum, $descricao);

            while (mysqli_stmt_fetch($stmt3)) {

                ?>
                <div class="card-content mb-5">
                    <div class="card-photo1"></div>
                    <div class="card-text">
                        <h2><?= $nome_forum ?></h2>
                        <p><?= $descricao ?></p>
                        <a href="grupo_indv.php">Saber mais</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>


    </div>
</div>
