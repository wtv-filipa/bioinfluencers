<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Eventos</h1>
    <p class="mb-4">Adicionar novos eventos ou gerir eventos já criados</p>


    <div class="row">
        <div class="col-xl-12">
            <form method="post" action="scripts/inserir_evento.php" enctype="multipart/form-data">

                <div class="row">
                    <?php
                    require_once("connections/connection.php");
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_eventos, nome, data_inicio, data_fim, local, descricao, custos, grupos_id_grupos, responsavel, conteudos_id_conteudos, tema_evento_idtema_evento
                              FROM eventos ";
                    if (mysqli_stmt_prepare($stmt, $query)) {


                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $local, $descricao, $custos, $grupos_id_grupos, $responsavel, $conteudos_id_conteudos, $tema_evento_idtema_evento);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>
                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome do Evento</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Indique o título">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="local">Local</label>
                        <input type="text" class="form-control" id="local" name="local" placeholder="Indique o local">
                    </div>

                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="data_inicio">Data/hora inicio:</label>
                        <input type="datetime-local" class="form-control" id="data_inicio" name="data_inicio"
                               placeholder="Indique a data de início">
                    </div>

                    <div class="col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="data_fim">Data/hora fim:</label>
                        <input type="datetime-local" class="form-control" id="data_fim" name="data_fim"
                               placeholder="Indique a data de fim">
                    </div>


                    <div class="form-group col-12">
                        <label class="text-gray-800" for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao"
                               placeholder="Insira aqui a descrição do evento">
                    </div>


                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="responsavel">Responsável</label>
                        <input type="text" class="form-control" id="responsavel"
                               placeholder="Indique o responsável do evento" name="responsavel">
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="custos">Custos</label>
                        <input type="number" class="form-control" id="custos" placeholder="Indique os custos do evento"
                               name="custos">
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
                            }}
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

                            ?>
                        </select>
                    </div>


                    <div class="col-xl-12">
                        <div class="row">
                            <div class="form-group col-xl-6 col-lg-6 col-sm-6 mt-2">
                                <!--colocar nome do forum-->

                                <label class="text-gray-800" for="nome">Seleciona uma imagem para
                                    upload:</label>

                                <div class="row">
                                    <input type="file" name="fileToUpload" class="file-upload ml-3"/>
                                </div>
                            </div>


                            <div class="form-group col-12 mt-3">
                                <button class="buttonCustomise" type="submit" value="Upload Image" name="Submit">
                                    Criar
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>