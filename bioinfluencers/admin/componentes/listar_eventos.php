

<div class="container-fluid">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary textCustom">Eventos do BioInfluencers</h6>
    </div>
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
                    <td><?= $data_inicio. " às ". $data_fim?></td>
                    <td><?= $hora_inicio. " a ". $hora_fim?></td>
                    <td><?= $responsavel?></td>

                    <td>

                        <a href='editar_evento.php?id=<?=$id_evento?>'><i class="fas fa-edit"></i></a>
                        <a href="scripts/delete_evento.php?id=<?=$id_evento?>">
                            <i class="fas fa-trash"></i>
                        </a>

                        <!-- Button trigger modal -->
                        <a data-toggle="modal" data-target="#mymodal">
                            <i class="fas fa-info-circle"></i>
                        </a>

                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #7FC53C">
                                <h5 class="modal-title" style="color:white" id="exampleModalLongTitle">Mais info</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
               <div class="modal-body">
                    <h5>Nome:</h5>
                    <p><?=$nome?></p>
                    <hr style="background-color: #7FC53C; opacity: 0.5">
                    <h5>Data de início:</h5>
                    <p><?=$data_inicio?> </p>
                    <hr style="background-color:#7FC53C; opacity: 0.5">
                    <h5>Data do fim: </h5>
                    <p><?=$data_fim?></p>
                    <hr style="background-color: #7FC53C; opacity: 0.5">
                   <h5>Hora do início </h5>
                   <p><?=$hora_inicio?></p>
                   <hr style="background-color: #7FC53C; opacity: 0.5">
                   <h5>Hora do fim </h5>
                   <p><?=$hora_fim?></p>
                   <hr style="background-color: #7FC53C; opacity: 0.5">
                   <h5>Local: </h5>
                   <p><?=$local?></p>
                   <hr style="background-color: #7FC53C; opacity: 0.5">
                   <h5>Descrição: </h5>
                   <p><?=$descricao?></p>
                   <hr style="background-color: #7FC53C; opacity: 0.5">
                   <h5>Custos:</h5>
                   <p><?=$custos?></p>
                   <hr style="background-color: #7FC53C; opacity: 0.5">
                   <h5>Responsável: </h5>
                   <p><?=$responsavel?></p>
                   <hr style="background-color: #7FC53C; opacity: 0.5">

                </div>
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