<div class="container">
    <?php

    require_once "connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_partilhas, data_hora, descricao, utilizadores_id_utilizadores, id_utilizadores, nickname, img_perfil, filename, partilhas_id_partilhas
              FROM partilhas
              LEFT JOIN conteudos
              ON partilhas.id_partilhas = conteudos.partilhas_id_partilhas
              INNER JOIN utilizadores
              ON partilhas.utilizadores_id_utilizadores = utilizadores.id_utilizadores
              ORDER BY data_hora DESC";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_partilhas, $data_hora, $descricao, $uti_id_uti, $id_utilizadores, $nome_u, $img_perfil, $filename, $partilhas_id_partilhas);

        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="row no-gutters">
                <div class="card test">
                    <div class="header">
                        <div class="right-side">
                            <?php
                            if (isset($img_perfil)) {
                                ?>
                                <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>" class="avatar"/>
                                <?php
                            } else {
                                ?>
                                <img src="img/default.gif" class="avatar"/>
                                <?php
                            }
                            ?>
                            <div class="headers-text ml-2">
                                <span class="author-name"><?= $nome_u ?></span>
                                <span class="header-secondary-text"><?= substr($data_hora, 10, 6) ?></span>
                            </div>
                        </div>
                        <i class="material-icons dropdown-icon">expand_more</i>
                    </div>

                    <div class="text-content">
                        <p><?= $descricao ?></p>
                    </div>
                    <?php
                    if (isset($partilhas_id_partilhas)) {
                        echo "ESTA A DAR!"
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
                            <i class="fa fa-leaf" aria-hidden="true" style="font-size: 1.5rem"></i>
                            <span class="like-napis-dla-rafala">
          Gosto
        </span>
                        </div>
                        <div class="social-wrapper">
                            <!--<a href="#" class="comment-count">16 comments</a>-->
                            <i class="fa fa-share" aria-hidden="true" style="font-size: 1.2rem"></i>
                            <span class="like-napis-dla-rafala pl-1">
         Partilhar
        </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
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

<!--
        <div class="row no-gutters">
            <div class="card test">
                <div class="header">
                    <div class="right-side">
                        <img src="img/pessoa2.jpg" class="avatar"/>
                        <div class="headers-text">
                            <span class="author-name">Cristina Costa</span>
                            <span class="header-secondary-text">Há 15 min.</span>
                        </div>
                    </div>
                    <i class="material-icons dropdown-icon">expand_more</i>
                </div>
                <div class="text-content">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fringilla et turpis in condimentum. Sed
                        ac turpis massa.
                    </p>
                </div>
                <div class="photo-content">
                    <div class="photo two">
                        <img class="card-photo" src="img/beata.jpg"/>
                    </div>
                    <div class="photo three">
                        <img class="card-photo" src="img/escavar.jpg"/>
                    </div>
                </div>

                <div class="actions">
                    <div class="like-wrapper">
                        <i class="fa fa-leaf" aria-hidden="true" style="font-size: 1.5rem"></i>
                        <span class="like-napis-dla-rafala">
              Gosto
            </span>
                    </div>
                    <div class="social-wrapper">
                       <a href="#" class="comment-count">16 comments</a>
                    <i class="fa fa-share" aria-hidden="true" style="font-size: 1.2rem"></i>
                    <span class="like-napis-dla-rafala pl-1">
         Partilhar
        </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="card test">
            <div class="header">
                <div class="right-side">
                    <img src="img/pessoa4.jpg" class="avatar"/>
                    <div class="headers-text">
                        <span class="author-name">Rui Ferreira</span>
                        <span class="header-secondary-text">Há 22 min.</span>
                    </div>
                </div>
                <i class="material-icons dropdown-icon">expand_more</i>
            </div>
            <div class="text-content">
                <p>
                    <span style="font-weight: bold;">Comentou</span> "Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit.
                    Sed fringilla et turpis in condimentum. Sed ac turpis massa." <span style="font-weight: bold;">em #desflorestação.</span>

                </p>
            </div>
            <div class="actions">
                <div class="like-wrapper">
                    <i class="fa fa-leaf" aria-hidden="true" style="font-size: 1.5rem"></i>
                    <span class="like-napis-dla-rafala">
          Gosto
        </span>
                </div>
                <div class="social-wrapper">
                    <a href="#" class="comment-count">16 comments</a>
                    <i class="fa fa-share" aria-hidden="true" style="font-size: 1.2rem"></i>
                    <span class="like-napis-dla-rafala pl-1">
         Partilhar
        </span>
                </div>
            </div>
        </div>
    </div>



-->