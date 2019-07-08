<body class="body_criar_publicacao">
<div class="row no-gutters"><h3 class="mx-auto mt-5">

        <i class="fa fa-pencil-square-o  mr-2" aria-hidden="true"></i>
        Criar uma nova publicação</h3>

</div>

<div class="events w-75 mx-auto">


    <!--Card-->
    <div class="card mdb-color lighten-4 text-center z-depth-2 light-version py-4 px-5">

        <?php
        if (isset($_GET["msg"])) {
            $msg_show = true;
            switch ($_GET["msg"]) {
                case 0:
                    $message = "Ocorreu um erro ao carregar a publicação, por favor tente novamente...";
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

        <form class="md-form inserir_dados mb-3"  action="scripts/criar_publicacao.php" enctype="multipart/form-data" method="post">

            <input type="file" name="fileToUpload" class="file-upload botao_upload mb-3">
            <div class="alert alert-warning" role="alert">
                Insira uma imagem até 5MB.
            </div>

            <div class="form-group text-left mt-4">
                <label for="comment">O que queres publicar?</label>
                <textarea class="form-control" rows="5" id="comment" name="comentar"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-success publicar_btn" value="Upload Image">PUBLICAR</button>
            </div>
        </form>
    </div>
</div>

<!--/.Card-->
</body>
