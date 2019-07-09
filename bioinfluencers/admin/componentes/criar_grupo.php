<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Grupo</h1>
    <p class="mb-4">Aqui é possível ter uma vista geral de todos os grupos que existem, bem como as categorias
        disponíveis e todos os comentários publicados. O administrador pode adicionar novos grupos, categorias e apagar
        comentários.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 3:
                $message = "Ocorreu um erro ao inserir o grupo, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 4:
                $message = "Ocorreu um erro ao inserir o seu ficheiro, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 5:
                $message = "O ficheiro inserido não é uma imagem.";
                $class = "alert-warning";
                break;
            case 6:
                $message = "O ficheiro inserido já existe.";
                $class = "alert-warning";
                break;
            case 7:
                $message = "O ficheiro inserido é demasiado grande.";
                $class = "alert-warning";
                break;
            case 8:
                $message = "Apenas ficheiros JPG, JPEG, PNG e GIF são aceites";
                $class = "alert-warning";
                break;
            default:
                $msg_show = false;
        }

        echo "<div class=\"alert $class alert-dismissible fade show mt-2\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
        if ($msg_show) {
            echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
        }
    }
    ?>



    <div class="row">
        <div class="col-xl-12">
            <form method="post" action="scripts/inserir_grupo.php" enctype="multipart/form-data">

                <div class="row">
                    <?php
                    require_once("connections/connection.php");
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_grupos, nome_grupos, descricao_g, estado, categorias_id_categorias
                              FROM grupos ";
                    if (mysqli_stmt_prepare($stmt, $query)) {


                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_grupos, $nome_grupos, $descricao, $estado, $ref_categorias);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>
                    <!--colocar nome do forum-->
                    <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" placeholder="Indique o nome do grupo"
                               name="nome">
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="cat">Categoria</label>
                        <select class="form-control" id="cat" name="categoria">
                            <?php
                            $stmt = mysqli_stmt_init($link);

                            $query = "SELECT id_categorias, nome_categoria FROM categorias";

                            if (mysqli_stmt_prepare($stmt, $query)) {

                                /* execute the prepared statement */
                                if (mysqli_stmt_execute($stmt)) {
                                    /* bind result variables */
                                    mysqli_stmt_bind_result($stmt, $id_categorias, $nome_cat);

                                    /* fetch values */
                                    while (mysqli_stmt_fetch($stmt)) {
                                        if ($ref_categorias == $id_categorias) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo "\n\t\t<option value=\"$id_categorias\" $selected>$nome_cat</option>";
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

                    <div class="form-group col-12">
                        <label class="text-gray-800" for="des">Descrição</label>
                        <textarea type="text" class="form-control" id="des"
                                  placeholder="Insira o texto relativo ao grupo" name="descricao"></textarea>
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
                    <?php
                }

                    mysqli_stmt_close($stmt);
                    mysqli_close($link);

                    }
                    ?>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


