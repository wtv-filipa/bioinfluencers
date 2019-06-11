<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Conteúdos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos conteúdos do BioInfluencers.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action="">
            <div class="input-group mt-3">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar..." aria-label="Search" aria-describedby="basic-addon2" name="p">
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
                        <th>Nome do ficheiro</th>
                        <th>Data</th>
                        <th>Tipo de conteúdo</th>
                        <th>Ação</th>
                    </tr>
                    </thead>

                    <?php
                    require_once("connections/connection.php");

                    $link = new_db_connection();

                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_conteudos, filename, data, nome_tipo
                              FROM conteudos
                              INNER JOIN tipos_conteudos
                              ON conteudos.tipos_conteudos_id_tiposconteudos1 = tipos_conteudos.id_tiposconteudos";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_conteudo,$filename, $data, $nome_tipo);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>
                    <tbody>
                    <tr>
                        <td><?= $filename ?></td>
                        <td><?= $data ?></td>
                        <td><?= $nome_tipo ?></td>
                        <td>
                            <i class="fas fa-trash"></i>
                        </td>
                    </tr><?php
}
}
?>
                    <tfoot>
                    <tr>
                        <th>Nome do ficheiro</th>
                        <th>Data</th>
                        <th>Tipo de conteúdo</th>
                        <th>Ação</th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

