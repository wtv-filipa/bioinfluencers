<body class="body_criar_evento">
<div class="row no-gutters"><h3 class="mx-auto mt-5">

        <i class="fa fa-calendar-plus-o  mr-2" aria-hidden="true"></i>
        Criar um evento</h3>

</div>

<div class="events w-75 mx-auto">


    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <?php
        if (isset($_GET["msg"])) {
            $msg_show = true;
            switch ($_GET["msg"]) {
                case 0:
                    $message = "Ocorreu um erro ao carregar o evento/ ficheiro, por favor tente novamente...";
                    $class = "alert-warning";
                    break;
                case 1:
                    $message = "O ficheiro não é uma imagem.";
                    $class = "alert-warning";
                    break;
                case 2:
                    $message = "O ficheiro já existe.";
                    $class = "alert-warning";
                    break;
                case 3:
                    $message = "O ficheiro é demasiado grande.";
                    $class = "alert-warning";
                    break;
                case 4:
                    $message = "Apenas são aceites ficheiros JPG, JPEG, PNG e GIF.";
                    $class = "alert-warning";
                    break;
                default:
                    $msg_show = false;
            }

            echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
            if ($msg_show) {
                echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
            }
        }
        ?>

        <form class="md-form inserir_dados" class="mb-3" action="scripts/criar_evento.php" enctype="multipart/form-data" method="post">
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
            <input type="file" name="fileToUpload" class="file-upload mb-3"/>

            <div class="alert alert-warning" role="alert">
                Insira uma imagem até 5MB.
            </div>


                <div class="form-group text-left">
                    <label for="nomeEvento">Nome do evento:</label>
                    <input type="text" id="nomeEvento" name="nomeEvento" class="form-control">
                </div>

            <div class="form-group text-left mt-4">
                <label for="local">Local:</label>
                <input type="text" id="local" name="local" class="form-control">
            </div>

                <div class="form-group text-left mt-4">
                    <label for="dataInicio">Data/hora inicio:</label>
                    <input type="datetime-local" id="dataInicio" name="dataInicio" class="form-control">
                </div>

                <div class="form-group text-left mt-4">
                    <label for="dataFim">Data/hora fim:</label>
                    <input type="datetime-local" id="dataFim" name="dataFim" class="form-control">
                </div>




                <div class="form-group text-left mt-4">
                    <label for="descricao">Descrição do evento:</label>
                    <textarea type="text" id="descricao" name="descricao" class="form-control"></textarea>
                </div>


                <div class="form-group text-left mt-4">
                    <label for="organizador">Organizador:</label>
                    <input type="text" id="organizador" name="organizador" class="form-control">
                </div>


            <div class="form-group text-left mt-4">
                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" class="form-control" placeholder="€">
            </div>

            <div class="form-group text-left mt-4">
                <label for="cat">Tema do evento</label>
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
            <div class="form-group text-left mt-4">
                <label for="grup">Grupo</label>
                <select class="form-control" id="grup" name="grupo">
                    <?php
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_grupos, nome_grupos FROM grupos WHERE nome_grupos LIKE 'Evento%'";

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

            <div>
                    <button type="submit" class="btn btn-success publicar_btn">CRIAR</button>
                </div>

        </form>
    </div>
</div>

<!--/.Card-->
</body>
