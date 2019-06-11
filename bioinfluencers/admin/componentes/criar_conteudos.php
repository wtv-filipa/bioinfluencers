<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Conteúdos</h1>
    <p class="mb-4">Aqui é possível gerir e ter uma vista geral dos conteúdos do BioInfluencers.</p>

    <h2 class="text-center pb-2"></h2>
    <div class="row">
        <div class="col-lg-12 mx-auto">

<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "Imagem carregada com sucesso!";
            $class = "alert-success";
            break;
    }


                    echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
                    if ($msg_show) {
                        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                    }
                }

            ?>

        </div>
    <div class="container-fluid">
        <form action="scripts/upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name ="fileToUpload" class="file-upload"/>
            <input type="submit" value="Upload Image" name="Submit">
        </form>
    </div>


</div>
<!-- /.container-fluid -->

