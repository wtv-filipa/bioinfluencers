<?php
/* Database connection start */
$servername = "labmm.clients.ua.pt";
$username = "deca_18L4_20_web";
$password = "Hbsf3u";
$dbname = "deca_18L4_20";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>