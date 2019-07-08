<header>
    <div class="container">

        <div class="text-center">
            <img width="150px" height="250px" class="img-fluid mt-5" src="img/codigo_evento.png" alt="medalha">

            <p> Utiliza os códigos dos teus amigos para ganhares 10 pontos!</p>
        </div>

        <div class="text-center">
            <h2 class="semibold preto mb-5 mt-4">Insere um código</h2>
            <?php
            if (isset($_GET["msg"])) {
                $msg_show = true;
                switch ($_GET["msg"]) {
                    case 0:
                        $message = "Ocorreu um erro ao inserir o código, por favor tente novamente...";
                        $class = "alert-warning";
                        break;
                    case 1:
                        $message = "Código inserido com sucesso!";
                        $class = "alert-success";
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
            <form method="post" action="scripts/codigo.php" class="mt-5">
                <input style="height: 45px"  class="text-center personalizar" type="text" placeholder="código" name="codigo">
                <div class="text-center mt-4">
                    <button class="buttonCustomise btn btn-primary" type="submit" name="Submit"> submeter
                    </button>
                </div>

            </form>


        </div>

        <div class="text-center mb-5">

            <p class="pt-5">Cada código só pode ser submetido 1 vez.</p>
            <p>Partilha o teu com os teus amigos para ganhares mais pontos!</p>
        </div>

    </div>

</header>