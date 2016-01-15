<?php

$hostname = 'localhost';
$database = 'boksit_database';
$username = 'boksitad_boksit';
$administrator_passcode = 'Boksit#2007';
$db_connection = mysqli_connect("$hostname", "$username", "$administrator_passcode")
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