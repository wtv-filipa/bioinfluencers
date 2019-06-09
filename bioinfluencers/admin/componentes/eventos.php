

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Eventos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos eventos do BioInfluencers.</p>

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
                    <th>Local</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Responsável</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Local</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Responsável</th>
                    <th>Ação</th>
                </tr>
                </tfoot>

                <?php

                require_once "connections/connection.php";

                $link = new_db_connection(); //Create a new DB connection
                $stmt = mysqli_stmt_init($link); //create a prepared statement

                $query = "SELECT id_eventos, nome, data_inicio, data_fim, hora_inicio, hora_fim, local, descricao, custos, responsavel FROM eventos"; // Define the query
                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                mysqli_stmt_execute($stmt); // Execute the prepared statement

                mysqli_stmt_bind_result($stmt, $id_evento, $nome, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $descricao, $custos, $responsavel); // Bind results

                while (mysqli_stmt_fetch($stmt)) {

                ?>
                <tbody>
                <tbody>

                <tr>
                    <td><?= $nome?></td>
                    <td><?= $local?></td>
                    <td><?= $data_inicio. " -> ". $data_fim?></td>
                    <td><?= $hora_inicio. " -> ". $hora_fim?></td>
                    <td><?= $responsavel?></td>

                    <td>
                        <a data-toggle="modal" data-target="#mymodal">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <a href='editar_evento.php?id=<?=$id_evento?>'><i class="fas fa-edit"></i></a>
                        <i class="fas fa-trash"></i>

                        <!-- Button trigger modal -->


                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby=\"exampleModalCenterTitle\"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class=\"modal-content\">
                    <div class=\"modal-header\" style="background-color: #7FC53C">
                    <h5 class="modal-title" style="color:white" id=\"exampleModalLongTitle\">Mais info</h5>
                    <button type="button" class="close\" data-dismiss=\"modal\" aria-label=\"Close\">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--<div class="modal-body">
                    <h5>Título:</h5>
                    <p>$title</p>
                    <hr style="background-color: #7FC53C; opacity: 0.5">
                    <h5>Subtitlo:</h5>
                    <p>$subtitle </p>
                    <hr style="background-color:#7FC53C; opacity: 0.5">
                    <h5>Corpo da notícia: </h5>
                    <p>$text</p>
                    <hr style="background-color: #7FC53C; opacity: 0.5">
                    <h5>Data: </h5>
                    <p> $date </p>
                    <hr style="background-color: #7FC53C; opacity: 0.5">

                </div> -->
        </div>
    </div>
</div>
<?php
}
}

?>
</tbody>
</table>
</div>
</div>


</div>