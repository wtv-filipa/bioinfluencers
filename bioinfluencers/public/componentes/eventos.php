<div class="row no-gutters">
    <h3 class="mx-auto mt-5"><i class="fa fa-calendar-o  mr-2" aria-hidden="true"></i>Próximos eventos</h3>

</div>

<div class="events w-75 mx-auto">
    <?php
    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_eventos, nome, data_inicio, data_fim, hora_inicio, hora_fim, local, descricao, conteudos_id_conteudos, id_conteudos, filename
              FROM eventos
              INNER JOIN conteudos
              ON eventos.conteudos_id_conteudos = conteudos.id_conteudos
              ORDER BY data_inicio DESC";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_e, $nome, $data_inicio, $data_fim, $hora_inicio, $hora_fim, $local, $descricao, $conteudos_id_cont, $id_conteudos, $filename);
        while (mysqli_stmt_fetch($stmt)) {
            ?>
            <div class="event-card">
                <a href="evento_indv.php">
                    <img src="../admin/uploads/eventos/<?= $filename ?>" alt=""/>
                </a>
                <div class="description">
                    <h4 class="mt-2"><span style="font-weight: bold;"><?= $data_inicio ?>| </span><?= $nome ?></h4>
                    <p class="location mb-0"><?= $local ?></p>
                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><?= substr($hora_inicio, 0, 5) ?>h - <?= substr($hora_fim, 0, 5) ?>h
                    <div class="controls">
                        <a href="#">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-share" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <?php
        }
    }

    if(isset($tipo)) {
        if($tipo == 1 || $tipo == 3) {
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




