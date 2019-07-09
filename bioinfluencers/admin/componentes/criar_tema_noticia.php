<!-- tabela que mostra os fóruns disponíveis -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Temas das notícias</h1>
    <p class="mb-4">Aqui é possível criar todas os temas das notícias.</p>

    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {

            case 3:
                $message = "Ocorreu um erro ao inserir o tema, por favor tente novamente...";
                $class = "alert-warning";
                break;
            case 4:
                $message = "Campos do fomulário por preencher.";
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

            <form method="post" action="scripts/inserir_temas_noticias.php">

                <div class="row">

                    <!--colocar nome da categoria-->
                    <div class="form-group  col-xl-6 col-lg-6 col-sm-6">
                        <label class="text-gray-800" for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome"
                               placeholder="Indique o nome do tema">
                    </div>

                    <div class="form-group col-12">
                        <button type="submit" class="buttonCustomise"> Criar</button
                    </div>

            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
