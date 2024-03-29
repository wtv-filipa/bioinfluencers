

<?php
if (isset($_GET["msg"])) {
    $msg_show = true;
    switch ($_GET["msg"]) {
        case 0:
            $message = "Evento criado com sucesso!";
            $class = "alert-success";
            break;
        default:
            $msg_show = false;
    }

    echo "<div class=\"alert $class alert-dismissible fade show mt-5\" role=\"alert\">" . $message . "
                          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                          </button>
                        </div>";
    if ($msg_show) {
        echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
    }
}
?>
<div class="row no-gutters"  data-aos="fade-up" >

    <h3 class="mx-auto mt-5"><i class="fa fa-calendar-o  mr-2" aria-hidden="true"></i>Próximos eventos</h3>

</div>

<div class="events w-75 mx-auto">
    <?php
    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_eventos, nome, data_inicio, data_fim, local, descricao, conteudos_id_conteudos, id_conteudos, filename
              FROM eventos
              INNER JOIN conteudos
              ON eventos.conteudos_id_conteudos = conteudos.id_conteudos
              ORDER BY data_inicio DESC LIMIT 4";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_e, $nome, $data_inicio, $data_fim, $local, $descricao, $conteudos_id_cont, $id_conteudos, $filename);
        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="event-card"  data-aos="fade-up" >
                <a href="evento_indv.php?id_e=<?= $id_e ?>">
                    <img class="img-fluid lala" src="../admin/uploads/eventos/<?= $filename ?>" alt=""/>
                </a>
                <div class="description">
                    <a href="evento_indv.php?id_e=<?= $id_e ?>"><h4 class="mt-2" style="text-decoration: none !important;"><span
                                    style="font-weight: bold;"><?= substr($data_inicio, 8,2 ) ?>/<?= substr($data_inicio, 5,2 ) ?>  |   </span><?= $nome ?></h4></a>
                    <p class="location mb-0"><?= $local ?></p>
                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><?= substr($data_inicio, 10, 6) ?>h
                    - <?= substr($data_fim, 10, 6) ?>h
                    <div class="controls w-50 mx-auto">

                        <a href="evento_indv.php?id_e=<?= $id_e ?>"><button style="font-size: 1.3rem; color: black; width: 100%" class="buttonCustomise1 btn btn-default "><i class="fa fa-plus-circle" aria-hidden="true"></i> <span style="font-size: 1.1rem">Ver mais</span></button></a>
                    </div>
                </div>
            </div>

            <?php
        }
    }

    if (isset($tipo)) {
        if ($tipo == 1 || $tipo == 3) {
            ?>
            <a href="criar_evento.php" class="float">
                <i class="fa fa-calendar-plus-o my-float"></i>
            </a>
            <div class="label-container">
                <div class="label-text">Criar evento</div>
                <i class="fa fa-play label-arrow"></i>
            </div>

            <?php
        }
    }
    ?>




