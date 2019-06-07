<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Fórum</h1>
    <p class="mb-4">Aqui é possível ter uma vista geral de todos os fóruns que existem, bem como as categorias disponíveis e todos os comentários publicados. O administrador pode adicionar novos grupos, categorias e apagar comentários.</p>

    <div class="row">
        <div class="col-xl-12">
            <form method="post" action="scripts/inserir_grupo.php">

                <div class="row">

                <!--colocar nome do forum-->
                <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Indique o nome do grupo">
                </div>

                <!--colocar categoria do fórum-->
                <div class="form-group col-xl-6 col-lg-6 col-sm-6">
                    <label class="text-gray-800" for="cat">Categoria</label>
                    <select class="form-control" id="cat">
                        <?php
                        $stmt = mysqli_stmt_init($link);

                        $query = "SELECT id_categorias, nome_categoria FROM categorias";

                        if (mysqli_stmt_prepare($stmt, $query)) {

                            /* execute the prepared statement */
                            if (mysqli_stmt_execute($stmt)) {
                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt, $id_cat, $nome_cat);

                                /* fetch values */
                                while (mysqli_stmt_fetch($stmt)) {
                                    if ($ref_id_roles == $id_roles) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "\n\t\t<option value=\"$id_r\" $selected>$role_des</option>";
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

                <!--colocar descrição do forum-->
                    <div class="form-group col-12">
                        <label class="text-gray-800" for="des">Descrição</label>
                        <textarea type="text" class="form-control" id="des" placeholder="Insira o texto relativo ao grupo"></textarea>
                    </div>

                    <div class="form-group col-3">
                        <button class="buttonCustomise"> Criar </button

            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


