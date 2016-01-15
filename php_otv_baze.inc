<?php

$hostname = 'localhost';
$database = 'boksit_database';
//	$database = 'db_boksitad';
$username = 'boksitad_boksit';
$password = 'Boksit#2007';
$db_connection = mysqli_connect("$hostname", "$username", "$password")
        or die('Could not connect: ' . mysqli_connect_error($db_connection));
mysqli_set_charset($db_connection, "utf8");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$db = mysqli_select_db($db_connection, "$database")
        or die("Ne mogu da izaberem bazu.");
//mysqli_set_charset($db_connection,"utf8");
?>