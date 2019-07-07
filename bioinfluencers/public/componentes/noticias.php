<div class="container">
    <div id="demo" class="carousel slide mb-5" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            <li data-target="#demo" data-slide-to="3"></li>
        </ul>
        <div class="carousel-inner">


            <?php
            require_once("connections/connection.php");

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT id_noticias, titulo, subtitulo, data_hora, conteudos_id_conteudos, id_conteudos, filename 
                      FROM noticias 
                      INNER JOIN conteudos
                      ON noticias.conteudos_id_conteudos = conteudos.id_conteudos
                      ORDER BY data_hora DESC LIMIT 4";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_n, $titulo, $subtitulo, $data_hora, $conteudos_id_cont, $id_conteudos, $filename);
                $active = true;

                while (mysqli_stmt_fetch($stmt)) {
                    if ($active == true) {
                        ?>
                        <div class="carousel-item active">
                            <img class="img-fluid lala" src="../admin/uploads/noticias/<?= $filename ?>"
                                 alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption">
                                <a style="text-decoration: none" href="noticia_indv.php?id_n=<?= $id_n ?>">
                                    <div class="p-2" style="background-color: white; opacity: 0.7; border-radius: 20px">
                                        <h3 style="font-weight: 700; text-shadow: white 0.1em 0.1em 0.2em"><?= $titulo ?></h3>
                                        <p style="font-weight: 600;"><?= $subtitulo ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php
                        $active = false;
                    } else {
                        ?>
                        <div class="carousel-item">
                            <img class="img-fluid lala" src="../admin/uploads/noticias/<?= $filename ?>"
                                 alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption">
                                <a style="text-decoration: none" href="noticia_indv.php?id_n=<?= $id_n ?>">
                                    <div class="p-2" style="background-color: white; opacity: 0.7; border-radius: 20px">
                                        <h3 style="font-weight: 700; text-shadow: white 0.1em 0.1em 0.2em"><?= $titulo ?></h3>
                                        <p style="font-weight: 600;"><?= $subtitulo ?></p>
                                    </div>
                                </a>
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

    <div>
        <div class="row mb-3">
            <div class="col-xl-8 col-sm-12">
                <h3>Encontra aqui todas as notícias disponíveis</h3>
            </div>
            <div class="col-xl-4 col-sm-8 mx-auto mb-5">
                <div class="dropdown text-center">
                    <button class="btn btn-default dropdown-toggle botao_select" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Seleciona a categoria
                    </button>
                    <div class="dropdown-menu drop_select" aria-labelledby="dropdownMenuButton" style="font-size: 1rem">
                        <?php

                        $link2 = new_db_connection();
                        $stmt2 = mysqli_stmt_init($link2);
                        $query2 = "SELECT id_temas, nome_tema
                              FROM temas_noticias";

                        if (mysqli_stmt_prepare($stmt2, $query2)) {

                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $id_t, $nome_t);

                            while (mysqli_stmt_fetch($stmt2)) {
                                ?>
                                <a class="dropdown-item" href="noticias.php?t=<?= $id_t ?>"> <?= $nome_t ?></a>
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

        $query3 = "SELECT id_noticias, titulo, subtitulo, data_hora, conteudos_id_conteudos, temas_id_temas, id_conteudos, filename, id_temas, nome_tema
                  FROM noticias 
                  INNER JOIN conteudos
                  ON noticias.conteudos_id_conteudos = conteudos.id_conteudos
                  INNER JOIN temas_noticias
                  ON noticias.temas_id_temas = temas_noticias.id_temas";

        if (isset($_GET["t"])) {
            $id_t = $_GET["t"];

            $tema = "id_temas";
            $data = "data_hora";
            $query3 .= " WHERE " . $tema . " = ? ORDER BY " . $data . " DESC ";


            if (mysqli_stmt_prepare($stmt3, $query3)) {
                mysqli_stmt_bind_param($stmt3, 'i', $id_t);
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $id_n, $titulo, $subtitulo, $data_hora, $conteudos_id_cont, $temas, $id_conteudos, $filename, $id_t, $nome_t);
                while (mysqli_stmt_fetch($stmt3)) {

                    ?>
                    <div class="card-content mb-3">
                        <div class="card-photo1"
                             style="background-image: url('../admin/uploads/noticias/<?= $filename ?>')">

                        </div>
                        <div class="card-text">
                            <h2><?= $titulo ?></h2>
                            <p><?= $subtitulo ?></p>
                            <a href="noticia_indv.php?id_n=<?= $id_n ?>">Saber mais</a>
                        </div>
                    </div>
                    <?php
                }
            }

        } else {
            $data = "data_hora";
            $query3 .= " ORDER BY " . $data . " DESC ";

            if (mysqli_stmt_prepare($stmt3, $query3)) {

                mysqli_stmt_execute($stmt3);
                mysqli_stmt_bind_result($stmt3, $id_n, $titulo, $subtitulo, $data_hora, $conteudos_id_cont, $tema, $id_conteudos, $filename, $id_temas, $nome_t);
                while (mysqli_stmt_fetch($stmt3)) {

                    ?>
                    <div class="card-content mb-3">
                        <div class="card-photo1"
                             style="background-image: url('../admin/uploads/noticias/<?= $filename ?>')">

                        </div>
                        <div class="card-text">
                            <h2><?= $titulo ?></h2>
                            <p><?= $subtitulo ?></p>
                            <a href="noticia_indv.php?id_n=<?= $id_n ?>">Saber mais</a>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>


    </div>

</div>