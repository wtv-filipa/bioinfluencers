<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Notícias</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral das notícias da BioInfluencers.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Ocorreu um erro ao apagar a notícia, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 1:
                $message = "Notícia apagada com sucesso!";
                $class = "alert-success";
                break;
            case 2:
                $message = "Notícia inserida com sucesso!";
                $class = "alert-success";
                break;
            case 9:
                $message = "Grupo atualizado com sucesso!";
                $class = "alert-success";
                break;
            case 10:
                $message = "Ocorreu um erro ao atualizar o grupo, por favor tente novamente...";
                $class = "alert-warning";
                break;
            default:
                $msg_show = false;
        }

        echo "<div class=\"alert $class alert-dismissible fade show mt-2\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
        if ($msg_show) {
            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
        }
    }
    ?>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
              method="get" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..."
                       aria-label="Search" aria-describedby="basic-addon2" name="p">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <a href="criar_noticia.php" class="mr-4 ml-md-3 my-2 my-md-0 mw-2">Criar notícia <i class="fa fa-plus-square fa-1x" aria-hidden="true"></i></a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th><a href="noticias.php?sort=t">Título</a></th>
                        <th><a href="noticias.php?sort=s">Subtitulo</a></th>
                        <th>Ações</th>

                    </tr>
                    </thead>
                     <?php
                    require_once("connections/connection.php");

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $pagina_atual = filter_input(INPUT_GET,'p', FILTER_SANITIZE_NUMBER_INT);

                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                    $qtn_result_pg = 5;

                    $inicio = ($qtn_result_pg * $pagina) - $qtn_result_pg;

                    $result_temas = "SELECT id_noticias, titulo, subtitulo, texto, data_hora, conteudos_id_conteudos, temas_id_temas
                                    FROM noticias 
                                    ORDER BY id_noticias DESC
                                    LIMIT $inicio, $qtn_result_pg";


                    $resultado_temas = mysqli_query($link, $result_temas);

                     //Prepared Statements
                     if (mysqli_stmt_prepare($stmt, $result_temas)) {

                         mysqli_stmt_execute($stmt);
                         mysqli_stmt_bind_result($stmt, $id_noticias, $titulo, $subtitulo, $texto, $data_hora, $conteudos_id_conteudos, $temas_id_temas);

                         while ($row_temas = mysqli_fetch_assoc($resultado_temas)) {
                             ?>
                             <tbody>
                             <tr>
                                 <td><?= $row_temas['titulo'] ?></td>
                                 <td><?= $row_temas['subtitulo'] ?></td>

                                 <td>
                                     <!-- Button trigger modal -->

                                     <a href="" data-toggle="modal"
                                        data-target="#exampleModalCenter<?= $row_temas['id_noticias'] ?>"><i
                                                 class="fas fa-info-circle"></i></a>

                                     <a href="editar_noticia.php?id=<?= $row_temas['id_noticias'] ?>"><i
                                                 class="fas fa-edit"></i></a>

                                     <a href="" data-toggle="modal"
                                        data-target="#apagar<?= $row_temas['id_noticias'] ?>"><i
                                                 class="fas fa-trash"></i></a>
                                 </td>

                             </tr>
                             </tbody>
                             <!-- Modal para mais infos-->
                             <div class="modal fade" id="exampleModalCenter<?= $row_temas['id_noticias'] ?>"
                                  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">

                                     <div class="modal-content">
                                         <div class="modal-header" style="background-color: #78BE20; color:white">
                                             <h5 class="modal-title" id="exampleModalLabel">Mais info</h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                     aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <h5>Título:</h5>
                                             <p><?= $row_temas['titulo'] ?></p>
                                             <hr style="background-color: #78BE20; opacity: 0.3">
                                             <h5>Subtítulo:</h5>
                                             <p><?= $row_temas['subtitulo'] ?></p>
                                             <hr style="background-color: #78BE20; opacity: 0.3">
                                             <h5>Corpo da notícia:</h5>
                                             <p><?= $row_temas['texto'] ?></p>
                                             <hr style="background-color: #78BE20; opacity: 0.3">
                                             <h5>Data de publicação:</h5>
                                             <p><?= $row_temas['data_hora'] ?></p>
                                             <hr style="background-color: #78BE20; opacity: 0.3">
                                         </div>

                                     </div>
                                 </div>
                             </div>

                             <!--MODAL PARA APAGAR-->
                             <div class="modal fade" id="apagar<?= $row_temas['id_noticias'] ?>" tabindex="-1"
                                  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">

                                     <div class="modal-content">
                                         <div class="modal-header" style="background-color: #78BE20; color:white">
                                             <h5 class="modal-title" id="exampleModalLabel">Apagar</h5>
                                             <button type="button" class="close" data-dismiss="modal"
                                                     aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <p>Tem a certeza que quer apagar a notícia <?= $row_temas['titulo'] ?>?</p>
                                             <a href="scripts/delete_noticias.php?id=<?= $row_temas['id_noticias'] ?>"><input
                                                         type="submit" value="Eliminar" class="buttonCustomise"> </a>
                                             <button type="button" class="buttonCustomise" data-dismiss="modal">
                                                 Cancelar
                                             </button>

                                         </div>

                                     </div>
                                 </div>
                             </div>


                             <?php
                         }
                     }
                    ?>
                    <tfoot>
                    <tr>
                        <?php

                        $result_pg = "SELECT COUNT(id_noticias) AS num_result FROM noticias";
                        $link2 = new_db_connection();

                        $resultado_pg = mysqli_query($link2, $result_pg);

                        $row_pg = mysqli_fetch_assoc($resultado_pg);

                        $quantidade_pg = ceil($row_pg['num_result'] / $qtn_result_pg);


                        $max_links = 5;
                        ?>
                        <th>Título</th>
                        <th>Subtitulo</th>
                        <th>Ações</th>

                    </tr>
                    </tfoot>

                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->




