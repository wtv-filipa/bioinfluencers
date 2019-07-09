<div class="container">

    <?php
if(isset($_GET["id_n"])){
    $id_n = $_GET["id_n"];

require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT id_noticias, titulo, subtitulo, texto, data_hora, conteudos_id_conteudos, temas_id_temas, id_conteudos, filename 
          FROM noticias 
          INNER JOIN conteudos
          ON noticias.conteudos_id_conteudos = conteudos.id_conteudos
          WHERE id_noticias LIKE ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id_n);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_n, $titulo, $subtitulo, $texto, $data_hora, $conteudos_id_cont, $temas_id_temas, $id_conteudos, $filename);


    if (mysqli_stmt_fetch($stmt)) {
        ?>

        <div class="mt-5 mb-5">
            <h2 class="mb-3"><?= $titulo ?></h2>
            <p class="notic_text"><?= $subtitulo ?></p>
        </div>

        <div class="mb-5 text-center">
            <img class="img-fluid foto_arred" src="../admin/uploads/noticias/<?= $filename ?>">
        </div>

        <div class="notic_text mb-5">
            <p><?= $texto ?></p>
        </div>
        <?php
    }
    ?>


    <div>
        <div class="row mb-4">
            <h3>Notícias semelhantes</h3>
        </div>
        <?php
        $link3 = new_db_connection();
        $stmt3 = mysqli_stmt_init($link3);

        $query3 = "SELECT id_noticias, titulo, subtitulo, data_hora, conteudos_id_conteudos, temas_id_temas, id_conteudos, filename
                  FROM noticias 
                  INNER JOIN conteudos
                  ON noticias.conteudos_id_conteudos = conteudos.id_conteudos
                  ORDER BY data_hora DESC
                  LIMIT 4";

        if (mysqli_stmt_prepare($stmt3, $query3)) {

            mysqli_stmt_execute($stmt3);
            mysqli_stmt_bind_result($stmt3, $id_n, $titulo, $subtitulo, $data_hora, $conteudos_id_cont, $temas_id, $id_conteudos, $filename);


                while (mysqli_stmt_fetch($stmt3)) {
                    if($temas_id_temas == $temas_id){
                    ?>
                    <div class="card-content mb-3">
                        <div class="card-photo1" style="background-image: url('../admin/uploads/noticias/<?= $filename ?>')">

                        </div>
                        <div class="card-text">
                            <h2><?= $titulo ?></h2>
                            <p class="esconder"><?= $subtitulo ?></p>
                            <div class="sabermais"><a href="noticia_indv.php?id_n=<?= $id_n ?>">Saber mais</a></div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
            ?>
    </div>
</div>

<?php
}
}