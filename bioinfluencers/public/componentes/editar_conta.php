<?php
if (isset($_GET["edit"])) {
    $nickname = $_GET["edit"];
    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    //ir buscar os dados
    $query = "SELECT id_utilizadores, nome_u, nickname, email, data_nascimento, descricao_u, pontos, data_criacao, tipos_id_tipos, codigo_utilizador, img_perfil, active, nome_tipo
                              FROM utilizadores
                               INNER JOIN tipos_utilizador
                              ON utilizadores.tipos_id_tipos = tipos_utilizador.id_tipos
                              WHERE nickname LIKE ?";
    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $nickname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $nome_u, $nickname, $email, $data_nasc, $descricao_u, $pontos, $data_criacao, $tipo_id_tipo, $codigo_utilizador, $img_perfil, $active, $nome_tipo);
        ?>
        <div class="container mt-5">
        <h1>Editar Perfil</h1>
        <hr>
        <?php
        while (mysqli_stmt_fetch($stmt)) {
            ?>

            <div class="row">
            <!-- left column -->

            <div class="col-md-3">

                <div class="text-center">
                    <form class="form-horizontal" role="form" method="post" action="upload.php?id=<?= $id ?>"
                          enctype="multipart/form-data">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="hidden" name="edit" value="<?= $nickname ?>">
                                <input style="display: none" type="file" id="fileToUpload" name="fileToUpload"
                                       accept=".png, .jpg, .jpeg"/>
                                <label class="label fa fa-pencil" for="fileToUpload"></label>
                            </div>
                            <br/>
                            <div class="avatar-preview">
                                <?php
                                //var_dump($img_perfil);
                                if (isset($img_perfil)) {
                                    ?>
                                    <img id="img_perf" class="img_redonda"
                                         src="../admin/uploads/img_perfil/<?= $img_perfil ?>"
                                         alt="your image"/>
                                    <?php
                                } else {
                                    ?>
                                    <img id="img_perf" class="img_redonda" src="img/default.gif" alt="your image"/>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>

                        <div class="alert alert-warning mt-3" role="alert">
                            Insira uma imagem até 5MB.
                        </div>

                        <!----------------------MODAL DE CROP--------------->
                        <div id="uploadimageModal" class="modal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Upload & Crop Image</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8 text-center">
                                                <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                            </div>
                                            <div class="col-md-4" style="padding-top:30px;">
                                                <br/>
                                                <br/>
                                                <br/>
                                                <button class="buttonCustomise btn btn-primary crop_image" type="submit"
                                                        value="Upload Image" name="Submit"> Editar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-----------------------------fim modal------------>
                    </form>
                </div>
            </div>


            <!-- edit form column -->
            <div class="col-md-9 personal-info">
            <?php
            if (isset($_GET["msg"])) {
                $msg_show = true;
                switch ($_GET["msg"]) {
                    case 0:
                        $message = "Perfil atualizado com sucesso!";
                        $class = "alert-success";
                        break;
                    case 1:
                        $message = "Alguma coisa correu mal, por favor tente novamente...";
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
            <h3>Informação pessoal</h3>
            <form id="form1" class="form-horizontal" role="form" method="post"
                  action="scripts/editar_perfil.php?id=<?= $id ?>">
                <!--nome proprio-->
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="nome">Nome:</label>
                    <div class="col-lg-8">
                        <input id="nome" name="nome" class="form-control" type="text" value="<?= $nome_u ?>">
                    </div>
                </div>


                <!--email-->
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="email">Email:</label>
                    <div class="col-lg-8">
                        <input id="email" name="email" class="form-control" type="text" value="<?= $email ?>">
                    </div>
                </div>

                <!--data de nascimento-->
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="data_nasc">Data de nascimento</label>
                    <div class="col-lg-8">
                        <input type="date" class="form-control" id="data_nasc" name="data_nasc"
                               placeholder="data de nascimento" value="<?= $data_nasc ?>">
                    </div>
                </div>

                <!--descrição-->
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="descricao">Descrição</label>
                    <div class="col-lg-8">
                        <textarea type="text" class="form-control" id="descricao"
                                  placeholder="Inserir descrição" name="descricao"><?= $descricao_u ?></textarea>
                    </div>
                </div>

                <input type="hidden" name="edit" value="<?= $nickname ?>">
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <button class="buttonCustomise btn btn-primary" type="submit" value="Upload Image" name="Submit"> Editar  </button>
                        <span></span>
                        <button type="reset" class="btn btn-default" value="Cancel">Cancelar</button>
                    </div>
                </div>
            </form>
            <?php
        }
    }

    ?>
    </div>

    </div>
    </div>
    <hr>
    <?php
}
?>