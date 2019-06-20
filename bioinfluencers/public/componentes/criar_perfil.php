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

    <header id="perfil2">
        <div class="container">

            <div class="topo"><!--espaço-->
            </div>


            <!--DIV QUE CONTÉM A FOTO DE PERFIL-->
            <div class="row text-center topo">
    <?php
    while (mysqli_stmt_fetch($stmt)) {
        ?>

        <form style="display: block; margin: auto" id="form1" class="col-4" action="scripts/upload_imgperfil.php?id=<?=$id?>" method="post" enctype="multipart/form-data">

            <div class="avatar-upload">
                <div class="avatar-edit">
                    <input type="file" id="fileToUpload" name="fileToUpload" accept=".png, .jpg, .jpeg"/>
                    <label class="label fa fa-pencil" for="fileToUpload"></label>
                </div>

                <div class="avatar-preview">
                    <?php
                    //var_dump($img_perfil);
                    if (isset($img_perfil)){
                        ?>
                        <img id="img_perf" class="img_redonda" src="../admin/uploads/img_perfil/<?=$img_perfil?>" alt="your image"/>
                        <?php
                    }else{
                        ?>
                        <img id="img_perf" class="img_redonda" src="img/default.gif" alt="your image"/>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="text-center utilizador topo1">
                <input type="text" class="form-control text-center" id="nome" placeholder="Nome Próprio" name="nome" value="<?= $nome_u?>">

            <h6 class="mt-2">@<?= $nickname ?></h6>
            <p><?= $pontos ?></p>
            </div>

            <textarea type="text" class="form-control" id="descricao" placeholder="Inserir descrição" name="descricao" rows="3"><?= $descricao_u?></textarea>

           <a href="perfil.php?user=<?= $nickname ?>"><button class="buttonCustomise mt-3 mr-3" type="button" value="cancel" name="cancel">Cancelar</button></a>

            <button class="buttonCustomise mt-3 ml-3" type="submit" value="Upload Image" name="Submit"> Editar</button>

        </form>

        <?php
    }
}
        ?>
            </div> <!--Fim da DIV QUE CONTÉM A FOTO DE PERFIL-->



        </div> <!--Fim do container-->
    </header>

    <?php

}
?>