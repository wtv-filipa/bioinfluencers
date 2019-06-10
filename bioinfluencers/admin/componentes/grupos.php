<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Grupos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos grupos do BioInfluencers.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="p">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Comentários</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <?php
                    require_once "connections/connection.php";

                    $link= new_db_connection(); //Create a new DB connection
                    $stmt = mysqli_stmt_init($link); //create a prepared statement

                    $query = "SELECT id_foruns, nome_forum, descricao, estado, categorias_id_categorias, id_categorias, nome_categoria FROM foruns INNER JOIN categorias ON foruns.categorias_id_categorias= categorias.id_categorias"; // Define the query

                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                        mysqli_stmt_bind_result($stmt, $id_f, $nome, $descricao, $estado, $categorias_id, $id_cat, $nome_cat); // Bind results

                        while (mysqli_stmt_fetch($stmt)) {
                            ?>
                    <tbody>
                    <tr>
                        <td><?= $nome ?></td>
                        <td><?=$nome_cat ?></td>
                        <td><?=$estado ?></td>
                        <td> <a href="comentarios.php?id_f=<?= $id_f ?>">ver comentários</a></td>
                        <td>
                            <a href='editar_grupo.php?id=<?=$id_f?>'><i class="fas fa-edit"></i></a>
                            <a href='scripts/delete_grupo.php?id_f=<?=$id_f?>'><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>

                    <?php
                        }
                    }
                    ?>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Comentários</th>
                        <th>Ação</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


