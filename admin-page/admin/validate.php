<?php
if(session_id() == '') {
    session_start();
}
$hostname = 'localhost';
$database = 'boksit_database';
$db_user = 'boksitad_boksit';
$db_pass = 'Boksit#2007';

$user_name = $_POST['user_name'];
$password = $_POST['password'];

//connect to the DB and select the "dictator" database
$db_connection = mysqli_connect("$hostname","$db_user","$db_pass") or die('Could not connect: ' . mysqli_connect_error());;
mysqli_set_charset($db_connection,"utf8");


//set up the query
$validate_query = "SELECT * FROM admins WHERE username='$user_name' AND password='$password'";

$db = mysqli_select_db($db_connection, "$database")
	    or die("Ne mogu da izaberem bazu.");

//run the query and get the number of affected rows
$result = mysqli_query($db_connection, $validate_query) or die ("Greška: " .mysqli_error($db_connection));
$affected_rows = mysqli_num_rows($result);

//if theres exactly one result, the user is validated. Otherwise, hes invalid
if ($affected_rows == 1) {

    //add the user to our session variables
    $_SESSION['username'] = $user_name;
  //  echo $_SESSION['username'];
    header("Location: /cmsys/admin/index.php");
    print 'odobreno';
} else {
    print 'pristup nije dozvoljen !!!';
}
?>


