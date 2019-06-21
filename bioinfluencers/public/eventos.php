<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- metadados -->
    <?php include "helpers/meta.php"; ?>

    <title>Eventos</title>

    <!-- Custom fonts for this template-->
    <?php include "helpers/fonts.php"; ?>

    <!-- Custom styles for this template-->

    <?php include "helpers/css.php"; ?>

</head>


<body>
<header class="sticky-top">

    <?php include "componentes/navbar.php"; ?>

</header>

<main class="container p-0 mb-5">

    <?php include "componentes/eventos.php"; ?>


        <div class="col-12 mt-5">
            <div class="page-header">
                <div class="pull-right form-inline">
                    <div class="btn-group">
                        <button class="btn btn-light" data-calendar-nav="prev"><< Anterior</button>
                        <button class="btn btn-default" data-calendar-nav="today">Hoje</button>
                        <button class="btn btn-light mr-3" data-calendar-nav="next">Próximo >></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary" data-calendar-view="year">Ano</button>
                        <button class="btn btn-outline-secondary active" data-calendar-view="month">Mês</button>
                        <button class="btn btn-outline-secondary" data-calendar-view="week">Semana</button>
                        <button class="btn btn-outline-secondary" data-calendar-view="day">Dia</button>
                    </div>
                </div>
                <h3></h3>
            </div>
            <div id="showEventCalendar"></div>
        </div>
       <!-- <div class="col-12 text-center mt-3 ">
            <h4>Lista de eventos</h4>
            <ul id="eventlist" class="nav nav-list"></ul>
        </div>-->

</main>


<!-- JavaScript-->

<?php include "helpers/js.php"; ?>

</body>

</html>
