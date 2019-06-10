<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
    <p class="mb-4">Aqui é possível gerir todas as categorias dos grupos.</p>

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
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de criação</th>
                        <th>Descrição</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>Data de criação</th>
                        <th>Descrição</th>
                        <th>Ação</th
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    require_once "connections/connection.php";

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT id_categorias, nome_categoria, data_criacao, descricao_c 
                              FROM categorias";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_categoria,$nome_categoria, $data_criacao, $descricao);
                    while (mysqli_stmt_fetch($stmt)) {

                        ?>

                        <tr>
                         <td><?= $nome_categoria?></td>
                         <td><?= $data_criacao?></td>
                         <td><?= $descricao?></td>
                         <td>
                             <a href="editar_categorias.php?id=<?=$id_categoria?>">
                                 <i class="fas fa-edit"></i></a>

                             <a href="scripts/apagar_categorias.php?id=<?=$id_categoria?>">
                                 <i class="fas fa-trash"></i>
                             </a>
                         </td>

                        </tr>

                    <?php
                    }

                    }

                    ?>

                     <!--<tr>
                         <td>beatas</td>
                         <td>2019/04/13</td>
                         <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                         <td>
                             <i class="fas fa-trash"></i>

                             <i class="fas fa-edit"></i></td>
                     </tr>

                     <tr>
                         <td>poluição</td>
                         <td>2019/03/30</td>
                         <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                         <td>
                             <i class="fas fa-trash"></i>

                             <i class="fas fa-edit"></i></td>
                     </tr>

                     <tr>
                         <td>florestas</td>
                         <td>2019/04/3</td>
                         <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                         <td>
                             <i class="fas fa-trash"></i>

                             <i class="fas fa-edit"></i></td>
                     </tr>
                     <tr>
                         <td>plástico</td>
                         <td>2019/04/30</td>
                         <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                         <td>
                             <i class="fas fa-trash"></i>

                             <i class="fas fa-edit"></i></td>
                     </tr>

                     <tr>
                         <td>reciclar</td>
                         <td>2019/04/30</td>
                         <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </td>
                         <td>
                             <i class="fas fa-trash"></i>

                             <i class="fas fa-edit"></i></td>
                     </tr>-->


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->