<?php


if (isset($_GET["id"])){
    $id_evento = $_GET["id"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_eventos, nome, data_inicio, data_fim, hora_inicio, hora_fim, local, descricao, custos, responsavel 
                FROM eventos 
                WHERE id_eventos = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_evento);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_evento, $nome, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $descricao, $custos, $responsavel);
        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Editar evento</h1>
                <p class="mb-4">Editar eventos já criados</p>
                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="scripts/update_evento.php?id=<?= $id_evento?>">

                            <div class="row">

                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" placeholder="Indique o título" name="nome" value="<?=$nome?>">
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="local">Local</label>
                                    <input type="text" class="form-control" id="local" placeholder="Indique o local" name="local" value="<?=$local?>">
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="data_inicio">Data de Início </label>
                                    <input type="date" class="form-control" id="data_inicio"
                                           value="<?=$data_inicio?>" placeholder="Indique a data de início" name="data_inicio">
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="data_fim">Data de Fim </label>
                                    <input type="date" class="form-control" id="data_fim"
                                           value="<?=$data_fim?>" placeholder="Indique a data de fim" name="data_fim">
                                </div>
                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="data_inicio">Hora de Início </label>
                                    <input type="time" class="form-control" id="hora_inicio"
                                           value="<?=$hora_inicio?>" placeholder="Indique a hora de início" name="hora_inicio">
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="data_fim">Hora de Fim </label>
                                    <input type="time" class="form-control" id="hora_fim"
                                           value="<?=$hora_fim?>" placeholder="Indique a hora de fim" name="hora_fim">
                                </div>

                                <!--upload de imagem
                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="img2">Imagem</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="img2" class="file-upload"/>
                                    </div>
                                </div>-->


                                <div class="form-group col-12">
                                    <label class="text-gray-800" for="descricao">Descrição</label>
                                    <input type="text" class="form-control" id="descricao"
                                           value="<?=$descricao?>" placeholder="Insira aqui a descrição do evento" name="descricao"></textarea>
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="responsavel">Responsável</label>
                                    <input type="text" class="form-control" id="responsavel"
                                           value="<?=$responsavel?>" placeholder="Indique o responsável do evento" name="responsavel">
                                </div>

                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="custos">Custos</label>
                                    <input type="text" class="form-control" id="custos"
                                           value="<?=$custos?>" placeholder="Indique os custos do evento" name="custos">
                                </div>

                                <div class="form-group col-3">
                                    <button class="buttonCustomise"> Editar </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        }
    }
}
        ?>

