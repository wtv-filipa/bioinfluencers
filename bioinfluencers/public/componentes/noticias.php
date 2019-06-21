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
                            <img class="img-fluid lala" src="../admin/uploads/noticias/<?= $filename ?>" alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption ">
                                <h3><?= $titulo ?></h3>
                                <p><?= $subtitulo ?></p>
                            </div>
                        </div>

                        <?php
                        $active = false;
                    } else {
                        ?>
                        <div class="carousel-item">
                            <img class="img-fluid lala" src="../admin/uploads/noticias/<?= $filename ?>" alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption">
                                <h3><?= $titulo ?></h3>
                                <p><?= $subtitulo ?></p>
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
                                <a class="dropdown-item" href="noticias.php?cat=<?= $nome_c ?>"><?= $nome_c ?></a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_GET["cat"])){
            $tema = $_GET["cat"];
        } else {
            $tema = "";
        }

        $link3 = new_db_connection();
        $stmt3 = mysqli_stmt_init($link3);

        $query3 = "SELECT id_noticias, titulo, subtitulo, data_hora, conteudos_id_conteudos, id_conteudos, filename
                  FROM noticias 
                  INNER JOIN conteudos
                  ON noticias.conteudos_id_conteudos = conteudos.id_conteudos
                  ORDER BY data_hora DESC";

        if (mysqli_stmt_prepare($stmt3, $query3)) {

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $id_n, $titulo, $subtitulo, $data_hora, $conteudos_id_cont, $id_conteudos, $filename);

            while (mysqli_stmt_fetch($stmt3)) {

                ?>
                <div class="card-content mb-3">
                    <div class="card-photo1" style="background-image: url('../admin/uploads/noticias/<?= $filename ?>')">

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
        ?>


    </div>

</div>