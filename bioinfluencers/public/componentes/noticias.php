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

            $query = "SELECT id_noticias, titulo, subtitulo, data_hora FROM noticias ORDER BY data_hora DESC LIMIT 4";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id, $titulo, $subtitulo, $data_hora);
                $active = true;

                while (mysqli_stmt_fetch($stmt)) {
                    if ($active == true) {
                        ?>
                        <div class="carousel-item active">
                            <img class="img-fluid" src="img/beata_n.jpg" alt="Los Angeles" width="1140" height="500">
                            <div class="carousel-caption">
                                <h3><?= $titulo ?></h3>
                                <p><?= $subtitulo ?></p>
                            </div>
                        </div>

                        <?php
                        $active = false;
                    } else {
                        ?>
                        <div class="carousel-item">
                            <img class="img-fluid" src="img/beata_n.jpg" alt="Los Angeles" width="1140" height="500">
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
                <select class="form-control" id="" name="">
                    <option>Seleciona uma notícia</option>
                    <?php

                    $link2 = new_db_connection();
                    $stmt2 = mysqli_stmt_init($link2);
                    $query2 = "SELECT nome_tema
                                FROM temas";

                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2, $nome_tema);

                        while (mysqli_stmt_fetch($stmt2)) {
                            ?>
                            <option value="nome_tema"><?= $nome_tema ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        $link3 = new_db_connection();
        $stmt3 = mysqli_stmt_init($link);

        $query3 = "SELECT id_noticias, titulo, subtitulo, data_hora, conteudos_id_conteudos, id_conteudos, filename
                  FROM noticias 
                  INNER JOIN conteudos
                  ON noticias.conteudos_id_conteudos = conteudos.id_conteudos
                  ORDER BY data_hora DESC";
        if (mysqli_stmt_prepare($stmt3, $query3)) {

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $id, $titulo, $subtitulo, $data_hora, $conteudos_id_cont, $id_conteudos, $filename);

            while (mysqli_stmt_fetch($stmt3)) {

                ?>
                <div class="card-content mb-5">
                    <div class="card-photo1">
                        <img class="img-fluid foto_card_noticias" src="../admin/uploads/noticias/<?= $filename ?>">
                    </div>
                    <div class="card-text">
                        <h2><?= $titulo ?></h2>
                        <p><?= $subtitulo ?></p>
                        <a href="noticia_indv.php?id=<?= $id ?>">Saber mais</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>


    </div>

</div>