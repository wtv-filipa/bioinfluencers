<?php
if (isset($_GET["id"])){
    $id_forum= $_GET["id"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_foruns, nome_forum, descricao, categorias_id_categorias
                                                  FROM foruns  WHERE id_foruns=?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_forum);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_forum, $nome_forum, $descricao, $id_cat);
        while (mysqli_stmt_fetch($stmt)) {
                                        ?>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">Fórum</h1>
                <p class="mb-4">Aqui é possível ter uma vista geral de todos os fóruns que existem, bem como as categorias disponíveis e todos os comentários publicados. O administrador pode adicionar novos grupos, categorias e apagar comentários.</p>
                <div class="row">
                    <div class="col-xl-12">


                        <!--FORM-->

                        <form method="post" action="scripts/update_grupo.php?id=<?=$id_forum?>">
                            <div class="row">
                                <!--upload de imagem de capa da notícia
                                <div class="form-group col-12">
                                    <label class="text-gray-800" for="img1">Imagem principal</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" id="img1" class="file-upload" />
                                    </div>
                                </div>
                -->

                                <!--colocar nome do forum-->
                                <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" placeholder="Indique o nome do grupo" name="nome" value="<?= $nome_forum?>">
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

                                    <input type="text" class="form-control" id="des"
                                           placeholder="Insira o texto relativo ao grupo" name="descricao" value="<?= $descricao?>">

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


