
            <!-- Begin Page Content -->
            <!-- tabela que mostra os fóruns disponíveis -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Comentários</h1>
                <p class="mb-4">Aqui é possível gerir os comentários feitos no BioInfluencers. </p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Autor</th>
                                    <th>Título</th>
                                    <th>Comentário</th>
                                    <th>Data</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <?php
                                if (isset($_GET["id_f"]))
                                    $id_f = $_GET["id_f"];

                                require_once("connections/connection.php");

                                // Create a new DB connection
                                $link = new_db_connection();

                                /* create a prepared statement */
                                $stmt = mysqli_stmt_init($link);

                                $query = "SELECT id_forumcomentarios, titulo_comentarios, mensagem, data_hora, utilizadores_id_utilizadores, ref_id_foruns, respostas, id_utilizadores, nome
                                  FROM forum_comentarios
                                  INNER JOIN utilizadores
                                  ON forum_comentarios.utilizadores_id_utilizadores = utilizadores.id_utilizadores
                                  WHERE ref_id_foruns = ?";


                                if (mysqli_stmt_prepare($stmt, $query)) {
                                mysqli_stmt_bind_param($stmt, 'i', $id_f);

                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $id_c, $titulo_c, $mensagem, $data_hora, $uti_id, $id_foruns, $respostas, $id_u, $nome);


                                while (mysqli_stmt_fetch($stmt)) {

                                ?>
                                <tbody>
                                <tr>
                                    <td><?= $nome ?></td>
                                    <td><?= $titulo_c ?></td>
                                    <td><?= $mensagem ?></td>
                                    <td><?= $data_hora ?></td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#apagar<?= $id_f?><?=$id_c?>"><i class="fas fa-trash"></i></a>

                                </tr>

                                </tbody>
                                    <!--MODAL PARA APAGAR-->
                                    <div class="modal fade" id="apagar<?= $id_f?><?=$id_c?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <?php

                                            $link2 = new_db_connection();
                                            $stmt2 = mysqli_stmt_init($link2);

                                            $query2 = "SELECT id_forumcomentarios, titulo_comentarios, mensagem, data_hora, utilizadores_id_utilizadores, ref_id_foruns, respostas, id_utilizadores, nome
                                  FROM forum_comentarios
                                  INNER JOIN utilizadores
                                  ON forum_comentarios.utilizadores_id_utilizadores = utilizadores.id_utilizadores
                                  WHERE id_forumcomentarios = ?";


                                            if (mysqli_stmt_prepare($stmt2, $query2)) {

                                                mysqli_stmt_bind_param($stmt2, 'i', $id_c);
                                                /* execute the prepared statement */
                                                mysqli_stmt_execute($stmt2);
                                                /* bind result variables */
                                                mysqli_stmt_bind_result($stmt2, $id_c, $titulo_c, $mensagem, $data_hora, $uti_id, $id_foruns, $respostas, $id_u, $nome);

                                                /* resultados da store */
                                                mysqli_stmt_store_result($stmt2);
                                                while (mysqli_stmt_fetch($stmt2)) {
                                                    echo ' ';
                                                }
                                            }
                                            ?>
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #78BE20; color:white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apagar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem a certeza que quer apagar o comentário <?=$mensagem?>?</p>
                                                    <a href="scripts/delete_comentario.php?id_f=<?= $id_f?>&id_c=<?=$id_c?>"><input type = "submit" value = "Eliminar" class="buttonCustomise"> </a>
                                                    <button type="button" class="buttonCustomise" data-dismiss="modal">Cancelar</button>

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
                                    <th>Autor</th>
                                    <th>Título</th>
                                    <th>Comentário</th>
                                    <th>Data</th>
                                    <th>Ação</th>
                                </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
