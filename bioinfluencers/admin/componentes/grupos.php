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
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Comentários</th>
                        <th>Ação</th>
                    </tr>
                    </tfoot>

                    <?php
                    require_once "connections/connection.php";

                    $link= new_db_connection(); //Create a new DB connection
                    $stmt = mysqli_stmt_init($link); //create a prepared statement

                    $query = "SELECT id_foruns, nome_forum, descricao, estado FROM foruns"; // Define the query
                    if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                        mysqli_stmt_execute($stmt); // Execute the prepared statement

                        mysqli_stmt_bind_result($stmt, $id, $nome, $descricao, $estado); // Bind results

                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tbody>
                    <tr>
                        <td>$nome</td>
                        <td></td>
                        <td>$estado</td>
                        <td> <a href=\"comentarios.php\">ver comentários</a></td>
                        <td>
                            <i class=\"fas fa-trash\"></i>
                            <i class=\"fas fa-ban\"></i>
                            <i class=\"fas fa-edit\"></i></td>
                    </tr>
                    </tbody>";


                        }
                    }
                    ?>




                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


