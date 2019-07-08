<?php
if (isset($_GET['id_g'])) {

    // We need the function!
    require_once("connections/connection.php");

    $id_g = $_GET['id_g'];
?>
    <div class="container">
    <?php
    $link3 = new_db_connection();
    $stmt3 = mysqli_stmt_init($link3);

    $query3 = "SELECT id_grupos, nome_grupos, filename
                      FROM grupos 
                      INNER JOIN conteudos
                      ON grupos.conteudos_id_conteudos = conteudos.id_conteudos
                      WHERE id_grupos=?";

    if (mysqli_stmt_prepare($stmt3, $query3)) {

        mysqli_stmt_bind_param($stmt3, 'i',$id_g);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_bind_result($stmt3, $id_g, $nome_grupos, $filename);

        while (mysqli_stmt_fetch($stmt3)) {
            ?>

            <section class="wrapper" style=" background-image: url('../admin/uploads/grupos/<?=$filename?>')">
                <div class="divider">
                    <h1 class=""><?=$nome_grupos?></h1>
                </div>
            </section>
            <?php
        }
    }
    ?>




    <!---------------------DEIXAR UM COMENTÁRIO------------------->
    <div class="row justify-content-center py-5">
        <div class="col-auto">

            <?php
            // Create a new DB connection
            $link = new_db_connection();


            /* create a prepared statement */
            $stmt = mysqli_stmt_init($link);


            $query = "SELECT id_utilizadores, img_perfil
                              FROM utilizadores
                              WHERE id_utilizadores LIKE ?";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id, $img_perfil);
                while (mysqli_stmt_fetch($stmt)) {


                    if (isset($img_perfil)) {
                        ?>

                        <a href="profile.php?user=<?= $id ?>">
                            <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 class="avatar" alt="">
                        </a>
                        <?php
                    } else {
                        ?>

                        <a href="profile.php?user=<?= $id ?>">
                            <img src="img/default.gif"
                                 class="avatar" alt="">
                        </a>

                        <?php
                    }

                }
            }
            ?>

        </div>


        <div class="col-12 col-md-8">

            <div class="card mb-3 wow fadeIn">
                <div class="card-header font-weight-bold">Deixa um comentário</div>
                <div class="card-body">

                    <form action="scripts/inserir_comentario.php?comentario=<?= $id_g ?>" method="post" id="commentform"
                          class="comment-form">

                        <!-- Comment -->
                        <div class="form-group">

                            <label for="titulo">Título</label>
                            <input id="titulo" name="titulo" type="text" class="form-control"
                                   onkeyup="this.value = this.value.slice(0, 100)">


                            <label for="comment">O teu comentário</label>
                            <textarea id="comment" name="comentario" type="text" class="form-control"
                                      rows="5" onkeyup="this.value = this.value.slice(0, 500)"></textarea>
                        </div>

                        <div style="align-content: end; align-items: end">
                            <button class="buttonCustomise btn btn-primary " type="submit" value="Upload Image"
                                    name="Submit">Comentar
                            </button>
                        </div>
                    </form>
                </div><!-- #respond -->
            </div>

        </div>
    </div>


    <h2><i class="fa fa-commenting-o"></i> Comentários</h2>

        <?php
        if (isset($_GET["msg"])) {
            $msg_show = true;
            switch ($_GET["msg"]) {
                case 0:
                    $message = "Ocorreu um erro ao inserir o comentário, por favor tente novamente...";
                    $class = "alert-warning";
                    break;
                case 1:
                    $message = "comentário inserido com sucesso!";
                    $class = "alert-success";
                    break;
                default:
                    $msg_show = false;
            }

            echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
            if ($msg_show) {
                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
            }
        }
        ?>

    <!------------------COMENTÁRIOS EXISTENTES--------------->

    <?php
    // Create a new DB connection
    $link2 = new_db_connection();


    /* create a prepared statement */
    $stmt2 = mysqli_stmt_init($link2);


    $query2 = "SELECT nome_u, nickname, img_perfil, id_grupocomentarios, titulo_comentarios, mensagem, data_hora
                              FROM utilizadores INNER JOIN grupo_comentarios ON utilizadores.id_utilizadores= grupo_comentarios.utilizadores_id_utilizadores 
                              WHERE grupos_id_grupos=?
                              ORDER BY data_hora DESC";

    if (mysqli_stmt_prepare($stmt2, $query2)) {

        mysqli_stmt_bind_param($stmt2, 'i', $id_g);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_bind_result($stmt2, $nome, $nickname, $img_perfil, $id_c, $titulo, $mensagem, $data);
        while (mysqli_stmt_fetch($stmt2)) {

            ?>
            <div class="row justify-content-center py-5">
                <div class="col-auto">
                    <?php
                    if (isset($img_perfil)) {
                        ?>

                        <a href="profile.php?user=<?= $id ?>">
                            <img src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                 class="avatar" alt="">
                        </a>
                        <?php
                    } else {
                        ?>

                        <a href="profile.php?user=<?= $id ?>">
                            <img src="img/default.gif"
                                 class="avatar" alt="">
                        </a>

                        <?php
                    }
                    ?>

                </div>
                <div class="col-12 col-md-8">

                    <div class="card">
                        <div class="card-header py-2">
                            <span><?= $nome ?></span> comentou a <?=substr($data, 0, 10)?>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($titulo)) {
                                echo "<h5><b>$titulo</b></h5>";
                            } else {
                                echo "";
                            }
                            ?>

                            <p class="mb-0"><?= $mensagem ?></p>


                        </div>
                    </div>

                </div>
            </div>


            <?php
        }
    }

    ?>

    </div>

    <?php
}
?>