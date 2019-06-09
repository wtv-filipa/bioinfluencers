<?php
if (isset($_GET["id"])){
    $id_categoria = $_GET["id"];

    // We need the function!
    require_once("connections/connection.php");

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_categorias, nome_categoria, data_criacao, descricao_c 
                FROM categorias 
                WHERE id_categorias = ?";


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $id_categoria);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_categoria, $nome_categoria, $data_criacao, $descricao);
        while (mysqli_stmt_fetch($stmt)) {

            ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Editar categorias</h1>
                <p class="mb-4">Aqui é possível editar todas as categorias do fórum.</p>

                <div class="row">
                    <div class="col-xl-12">

                        <form method="post" action="scripts/update_categoria.php?id=<?= $id_categoria?>">

                            <div class="row">

                                <!--colocar nome da categoria-->
                                <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                                    <label class="text-gray-800" for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" value="<?= $nome_categoria?>" placeholder="Indique o nome da categoria">
                                </div>

                                <!--colocar descrição-->
                                <div class="form-group col-12">
                                    <label class="text-gray-800" for="des">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" value="<?=$descricao?>" placeholder="Insira o texto relativo à categoria">
                                </div>

                                <div class="form-group col-3">
                                    <button type="submit" class="buttonCustomise"> Editar </button>
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

