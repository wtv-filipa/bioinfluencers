<?php

require_once ("connections/connection.php");

$link= new_db_connection();
$stmt= mysqli_stmt_init($link);

$sqlEvents= "SELECT id_eventos, nome, data_inicio, data_fim, hora_inicio, hora_fim FROM eventos";

if (mysqli_stmt_prepare($stmt, $sqlEvents)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_eventos, $nome, $data_inicio, $data_fim, $hora_inicio, $hora_fim);

    $calendar = array();

    while (mysqli_stmt_fetch($stmt)) {
        // convert  date to milliseconds
        $start = strtotime($data_inicio) * 1000;
        $end = strtotime($data_fim) * 1000;

        $calendar[] = array(
            'id' =>$id_eventos,
            'title' => $nome,
            'url' => "#",
            "class" => 'event-important',
            'start' => "$start",
            'end' => "$end"
        );
    }
    $calendarData = array(
        "success" => 1,
        "result"=>$calendar);
    echo json_encode($calendarData);
    exit;
}
?>