<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
    <p class="mb-4">Aqui é possível gerir todas as categorias dos grupos.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary textCustom">Categorias</h6>
        </div>
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
                    $query = "SELECT id_categorias, nome_categoria, data_criacao, descricao 
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