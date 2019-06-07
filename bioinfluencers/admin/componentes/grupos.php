<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Grupos</h1>
    <p class="mb-4">Aqui é possível ter uma vista geral de todos os grupos que existem, bem como as categorias disponíveis e todos os comentários publicados. O administrador pode adicionar novos fóruns, categorias e apagar comentários.</p>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary textCustom">Grupos</h6>
        </div>
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


