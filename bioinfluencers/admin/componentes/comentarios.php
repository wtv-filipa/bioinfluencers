<?php
if (isset($_GET["id_g"])) {
    $id_g = $_GET["id_g"];

// We need the function!
    require_once("connections/connection.php");

// Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_grupos, nome_grupos, descricao_g
          FROM grupos";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_g, $nome_g, $descricao);


        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <!-- Begin Page Content -->
            <!-- tabela que mostra os fóruns disponíveis -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Grupo: <?= $nome_g ?></h1>
            <p class="mb-4">Descrição: <?= $descricao ?> </p>
            <?php
        }
    }
    ?>
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

                    // Create a new DB connection
                    $link2 = new_db_connection();

                    /* create a prepared statement */
                    $stmt2 = mysqli_stmt_init($link2);

                    $query2 = "SELECT id_grupocomentarios, titulo_comentarios, mensagem, data_hora, utilizadores_id_utilizadores, grupos_id_grupos, respostas, id_utilizadores, nome
                                  FROM grupo_comentarios
                                  INNER JOIN utilizadores
                                  ON grupo_comentarios.utilizadores_id_utilizadores = utilizadores.id_utilizadores
                                  WHERE grupos_id_grupos = ?";


                    if (mysqli_stmt_prepare($stmt2, $query2)) {
                        mysqli_stmt_bind_param($stmt2, 'i', $id_g);

                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2, $id_c, $titulo_c, $mensagem, $data_hora, $uti_id, $id_grupos, $respostas, $id_u, $nome);


                        while (mysqli_stmt_fetch($stmt2)) {

                            ?>
                            <tbody>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $titulo_c ?></td>
                                <td><?= $mensagem ?></td>
                                <td><?= $data_hora ?></td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#apagar<?= $id_g ?><?= $id_c ?>"><i
                                                class="fas fa-trash"></i></a>

                            </tr>

                            </tbody>
                            <!--MODAL PARA APAGAR-->
                            <div class="modal fade" id="apagar<?= $id_g ?><?= $id_c ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <?php

                                    $link3 = new_db_connection();
                                    $stmt3 = mysqli_stmt_init($link3);

                                    $query3 = "SELECT id_grupocomentarios, titulo_comentarios, mensagem, data_hora, utilizadores_id_utilizadores, grupos_id_grupos, respostas, id_utilizadores, nome
                                  FROM grupo_comentarios
                                  INNER JOIN utilizadores
                                  ON grupo_comentarios.utilizadores_id_utilizadores = utilizadores.id_utilizadores
                                  WHERE id_grupocomentarios = ?";


                                    if (mysqli_stmt_prepare($stmt3, $query3)) {

                                        mysqli_stmt_bind_param($stmt3, 'i', $id_c);
                                        /* execute the prepared statement */
                                        mysqli_stmt_execute($stmt3);
                                        /* bind result variables */
                                        mysqli_stmt_bind_result($stmt3, $id_c, $titulo_c, $mensagem, $data_hora, $uti_id, $id_grupos, $respostas, $id_u, $nome);

                                        /* resultados da store */
                                        mysqli_stmt_store_result($stmt3);
                                        while (mysqli_stmt_fetch($stmt3)) {
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
                                            <p>Tem a certeza que quer apagar o comentário <?= $mensagem ?>?</p>
                                            <a href="scripts/delete_comentario.php?id_f=<?= $id_g ?>&id_c=<?= $id_c ?>"><input
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
    <?php
}