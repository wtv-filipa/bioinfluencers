<?php


include_once("connections/db_connect.php");
$sqlEvents = "SELECT id_eventos, nome, data_inicio, data_fim FROM eventos";
$resultset = mysqli_query($conn, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	// convert  date to milliseconds
	$start = strtotime($rows['data_inicio']) * 1000;
	$end = strtotime($rows['data_fim']) * 1000;
	$calendar[] = array(
        'id' =>$rows['id_eventos'],
        'title' => $rows['nome'],
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
?>