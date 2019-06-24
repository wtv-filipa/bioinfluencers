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

            $query = "SELECT id_grupos, nome_grupos, descricao_g, data_criacao_g, conteudos_id_conteudos, id_conteudos, filename
                      FROM grupos 
                      INNER JOIN conteudos
                      ON grupos.conteudos_id_conteudos = conteudos.id_conteudos
                      ORDER BY data_criacao_g DESC";

            if (mysqli_stmt_prepare($stmt, $query)) {
                $query .= "LIMIT 3";

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id, $nome_grupos, $descricao, $data_criacao_g, $conteudos_id_cont, $id_conteudos, $filename);
                $active = true;

                while (mysqli_stmt_fetch($stmt)) {
                    if ($active == true) {
                        ?>
                        <div class="carousel-item active">
                            <img class="img-fluid lala" src="../admin/uploads/grupos/<?= $filename ?>" alt="" width="1140" height="500">
                            <div class="carousel-caption">
                                <div class="p-2" style="background-color: white; opacity: 0.7; border-radius: 20px">
                                    <h3 style="font-weight: 700; text-shadow: white 0.1em 0.1em 0.2em"><?= $nome_grupos ?></h3>
                                    <p style="font-weight: 600;"><?= $descricao ?></p>
                                </div>
                            </div>
                        </div>

                        <?php
                        $active = false;
                    } else {
                        ?>
                        <div class="carousel-item">
                            <img class="img-fluid lala" src="../admin/uploads/grupos/<?= $filename ?>" alt="" width="1140" height="500">
                            <div class="carousel-caption">
                                <div class="p-2" style="background-color: white; opacity: 0.7; border-radius: 20px">
                                    <h3 style="font-weight: 700; text-shadow: white 0.1em 0.1em 0.2em"><?= $nome_grupos ?></h3>
                                    <p style="font-weight: 600;"><?= $descricao ?></p>
                                </div>
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

        $link2 = new_db_connection();
        $stmt2 = mysqli_stmt_init($link2);

        $query2 = "SELECT COUNT(id_grupos) FROM grupos";

        if (mysqli_stmt_prepare($stmt2, $query2)) {

            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $nr_total);

            if (mysqli_stmt_fetch($stmt2)) {

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
                        $query = "SELECT id_grupos, nome_grupos, descricao_g, conteudos_id_conteudos, id_conteudos, filename
                                  FROM grupos
                                  INNER JOIN conteudos
                                  ON grupos.conteudos_id_conteudos = conteudos.id_conteudos
                                  LIMIT 1 OFFSET $offset";
                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id, $nome_grupos, $descricao, $conteudos_id, $id_conteudos, $filename);

                            mysqli_stmt_fetch($stmt)
                            ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mx-auto p-0">

                                <div class="event-card1 ">
                                    <div class="mg-image">
                                        <img src="../admin/uploads/grupos/<?= $filename ?>" alt=""/>
                                    </div>

                                    <div class="description">

                                        <h4 class="mt-2"><?= $nome_grupos ?></h4>
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

                        $link4 = new_db_connection();
                        $stmt4 = mysqli_stmt_init($link4);
                        $query4 = "SELECT id_categorias, nome_categoria
                              FROM categorias";

                        if (mysqli_stmt_prepare($stmt4, $query4)) {

                            mysqli_stmt_execute($stmt4);
                            mysqli_stmt_bind_result($stmt4, $id_c, $nome_c);

                            while (mysqli_stmt_fetch($stmt4)) {
                                ?>
                                <a class="dropdown-item" href="grupos.php?c=<?= $id_c ?>"><?= $nome_c ?></a>
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

        $query3 = "SELECT id_grupos, nome_grupos, descricao_g, data_criacao_g, categorias_id_categorias, conteudos_id_conteudos, id_conteudos, filename, id_categorias, nome_categoria
                  FROM grupos 
                  INNER JOIN conteudos
                  ON grupos.conteudos_id_conteudos = conteudos.id_conteudos
                  INNER JOIN categorias
                  ON grupos.categorias_id_categorias = categorias.id_categorias";

        if (isset($_GET["c"])) {
            $id_c = $_GET["c"];

            $tema = "id_categorias";
            $data = "data_criacao_g";
            $query3 .= " WHERE " . $tema . " = ? ORDER BY " . $data . " DESC ";


            if (mysqli_stmt_prepare($stmt3, $query3)) {
                mysqli_stmt_bind_param($stmt3, 'i', $id_c);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $id_g, $nome_grupos, $descricao, $data_criacao_g, $categorias_id_cat, $conteudos_id_cont, $id_conteudos, $filename, $id_c, $nome_c);

                while (mysqli_stmt_fetch($stmt3)) {

                    ?>
                    <div class="card-content mb-3">
                        <div class="card-photo1"
                             style="background-image: url('../admin/uploads/grupos/<?= $filename ?>')">

                        </div>
                        <div class="card-text">
                            <h2><?= $nome_grupos ?></h2>
                            <p><?= $descricao ?></p>
                            <a href="grupo_indv.php?id_g=<?= $id_g ?>">Saber mais</a>
                        </div>
                    </div>
                    <?php
                }
            }

        } else {
            $data = "data_criacao_g";
            $query3 .= " ORDER BY " . $data . " DESC ";

            if (mysqli_stmt_prepare($stmt3, $query3)) {

                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $id_g, $nome_grupos, $descricao, $data_criacao_g, $categorias_id_cat ,$conteudos_id_cont, $id_conteudos, $filename, $id_c, $nome_c);
                while (mysqli_stmt_fetch($stmt3)) {

                    ?>
                    <div class="card-content mb-3">
                        <div class="card-photo1"
                             style="background-image: url('../admin/uploads/grupos/<?= $filename ?>')">

                        </div>
                        <div class="card-text">
                            <h2><?= $nome_grupos ?></h2>
                            <p><?= $descricao ?></p>
                            <a href="grupo_indv.php?id_g=<?= $id_g ?>">Saber mais</a>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>

    </div>
</div>
