
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
                                        <a href='scripts/delete_comentario.php?id_f=<?= $id_f?>&id_c=<?=$id_c?>'><i class="fas fa-trash"></i></a>

                                        <i class="fas fa-comment-dots"></i></td>
                                </tr>

                                </tbody>
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


