<?php
if (isset($_GET['img'])){

    $id_c=$_GET['img'];
    //echo "sou a publicação";
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt= mysqli_stmt_init($link);


    $query = "SELECT id_conteudos, filename, partilhas_id_partilhas, id_partilhas, data_hora, descricao_p, utilizadores_id_utilizadores_p,id_utilizadores, nickname, img_perfil FROM conteudos INNER JOIN partilhas ON conteudos.partilhas_id_partilhas= partilhas.id_partilhas INNER JOIN utilizadores ON partilhas.utilizadores_id_utilizadores_p= utilizadores.id_utilizadores
WHERE id_conteudos=?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_c);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_conteudos, $filename, $partilhas_id_partilhas, $id_partilhas, $data_hora, $descricao, $utilizadores_id_utilizadores, $id, $nickname, $img_perfil);


        while (mysqli_stmt_fetch($stmt)) {


    ?>
            <div class=" container mt-5">
            <a href="profile.php?user=<?=$id?>">

                <h5>&#8592; voltar</h5>
            </a>
            </div>

    <div class="row no-gutters">
        <div class="card test">
            <div class="header">
                <div class="right-side">

                    <?php
                    //var_dump($img_perfil);
                    if (isset($img_perfil)) {
                        ?>
                        <img class="avatar" src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                             alt="your image"/>
                        <?php
                    } else {
                        ?>
                        <img class="avatar" src="img/default.gif" alt="your image"/>
                        <?php
                    }
                    ?>
                    <div class="headers-text">
                        <span class="author-name"><?=$nickname?></span>
                        <span class="header-secondary-text"><?= substr($data_hora, 10, 6) ?></span>
                    </div>
                </div>
                <i class="material-icons dropdown-icon">expand_more</i>
            </div>
            <div class="text-content">
                <p>
                   <?=$descricao?>
                </p>
            </div>
            <div class="photo-content">
                <div class="photo two">
                    <img class="card-photo" src="../admin/uploads/publicacao/<?= $filename ?>"/>
                </div>
            </div>

            <div class="actions">
                <div class="like-wrapper">
                    <?php

                    $id_u_feed=  $_SESSION["id_utilizadores"];

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

                        $id_c=$_GET['img'];
                        ?>

                    <a href="scripts/gostos_perfil.php?g=<?= $id_partilhas?>&c=<?= $id_c?>" style="text-decoration: none">
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
                            <a href=\"scripts/gostos_perfil.php?ng=$id_partilhas&c=$id_c\" style=\"text-decoration: none\">
                            <span class=\"fa fa-leaf gosto1\" aria-hidden=\"true\" style=\"font-size: 1.5rem\">
                            <span class=\"like-napis-dla-rafala\">$total_gostos gosto</span>
                        </span>
                            </a>";
                                    } else {
                                        echo "
                            <a href=\"scripts/gostos_perfil.php?ng=$id_partilhas&c=$id_c\" style=\"text-decoration: none\">
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

            <!--botão flutuante para criar uma nova publicação-->
            <a href="criar_publicacao.php" class="float">
                <i class="fa  fa-pencil-square-o my-float"></i>
            </a>
            <div class="label-container">
                <div class="label-text">Criar publicação</div>
                <i class="fa fa-play label-arrow"></i>
            </div>
<?php
        }
    }
}
?>