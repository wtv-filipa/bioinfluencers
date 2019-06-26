<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Temas dos Eventos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos temas dos eventos da BioInfluencers.</p>


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


        <div class="card-body col-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th><a href="noticias.php?sort=t">Tema</a></th>
                    </tr>
                    </thead>
                    <?php
                    require_once("connections/connection.php");
                    if (isset($_GET["p"])) {

                        $pesquisar = "%" . $_GET["p"] . "%";
                    } else {

                        $pesquisar = "%";
                    }


                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);
                    $query = "SELECT id_tema_evento, nome_tema_e FROM temas_eventos WHERE nome_tema_e LIKE ?";

                    if (isset($_GET["sort"])) {
                        if ($_GET["sort"] == "t") {
                            $ordem_listagem = "titulo";
                        } else {
                            if ($_GET["sort"] == "s") {
                                $ordem_listagem = "subtitulo";
                            }
                        }

                        $query .= " ORDER BY " . $ordem_listagem . " ASC ";
                    }



                    if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $pesquisar);

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id,$tema_evento);
                    while (mysqli_stmt_fetch($stmt)) {

                        ?>
                        <tbody>
                        <tr>

                            <td><?=$tema_evento?></td>

                        <?php
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
/* close statement */
mysqli_stmt_close($stmt);

/* close connection */
mysqli_close($link);
}
?>
<!-- /.container-fluid -->
