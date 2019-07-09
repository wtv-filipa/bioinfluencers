<?php


if (isset($_GET["id"])){
    $id_evento = $_GET["id"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_eventos, nome, data_inicio, data_fim, local, descricao, custos, grupos_id_grupos, responsavel, conteudos_id_conteudos, tema_evento_idtema_evento
                FROM eventos 
                WHERE id_eventos = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_evento);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_evento, $nome, $data_inicio, $data_fim, $local, $descricao, $custos, $grupos_id_grupos, $responsavel, $conteudos_id_conteudos, $tema_evento_idtema_evento);
        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Editar evento</h1>
                <p class="mb-4">Editar eventos já criados</p>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="scripts/update_evento.php?id=<?= $id_evento?>" enctype="multipart/form-data">

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
                                    <?php

                                    ?>
                                    <input type="datetime-local" class="form-control" id="data_inicio" value="<?=date("Y-m-d\TH:i:s", strtotime($data_inicio))?>" name="data_inicio">
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="data_fim">Data de Fim </label>
                                    <input type="datetime-local" class="form-control" id="data_fim" value="<?=date("Y-m-d\TH:i:s", strtotime($data_fim))?>" name="data_fim">
                                </div>

                                <div class="form-group col-12">
                                    <label class="text-gray-800" for="descricao">Descrição</label>
                                    <textarea type="text" class="form-control" id="descricao"
                                            placeholder="Insira aqui a descrição do evento" name="descricao"><?=$descricao?></textarea>
                                </div>


                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="responsavel">Responsável</label>
                                    <input type="text" class="form-control" id="responsavel"
                                           value="<?=$responsavel?>" placeholder="Indique o responsável do evento" name="responsavel">
                                </div>

                                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="custos">Custos</label>
                                    <input type="number" class="form-control" id="custos"
                                           value="<?=$custos?>" placeholder="Indique os custos do evento" name="custos">
                                </div>

            <div class="form-group col-xl-6 col-lg-6 col-sm-6">
            <label class="text-gray-800" for="cat">Tema notícia</label>
            <select class="form-control" id="cat" name="tema_noticia">
            <?php
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT id_tema_evento, nome_tema_e FROM temas_eventos";

            if (mysqli_stmt_prepare($stmt, $query)) {

                /* execute the prepared statement */
                if (mysqli_stmt_execute($stmt)) {
                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt, $id_temas, $nome_tema);

                    /* fetch values */
                    while (mysqli_stmt_fetch($stmt)) {
                        if ($tema_evento_idtema_evento == $id_temas) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "\n\t\t<option value=\"$id_temas\" $selected>$nome_tema</option>";
                    }
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                /* close statement */
                //mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($link);
            }

            /* close connection */
            //mysqli_close($link);

    ?>
    </select>
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
        <label class="text-gray-800" for="grup">Grupo</label>
        <select class="form-control" id="grup" name="grupo">
            <?php
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT id_grupos, nome_grupos FROM grupos";

            if (mysqli_stmt_prepare($stmt, $query)) {

                /* execute the prepared statement */
                if (mysqli_stmt_execute($stmt)) {
                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt, $id_grupos, $nome_grupos);

                    /* fetch values */
                    while (mysqli_stmt_fetch($stmt)) {
                        if ($grupos_id_grupos == $id_grupos) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        echo "\n\t\t<option value=\"$id_grupos\" $selected>$nome_grupos</option>";
                    }
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

                /* close statement */
                //mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($link);
            }

            /* close connection */
            //mysqli_close($link);
        }}
            ?>
        </select>
    </div>


    <div class="col-xl-12">
        <div class="row">
            <div class="form-group col-12 mt-3">
                <button class="buttonCustomise" type="submit" value="Upload Image" name="Submit">
                   Editar
                </button>
            </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
}
        ?>

