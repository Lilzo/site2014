<?php
include_once 'php_session.php';
include_once'php_otv_baze.inc';

$proizvodID = filter_input(INPUT_POST, 'proizvodID');
$kolicina = filter_input(INPUT_POST, 'kolicina');
$cijena = filter_input(INPUT_POST, 'cijena');
$sesija = session_id();
$submited_delete = filter_input(INPUT_POST, 'del');
$delete_proizvod = filter_input(INPUT_POST, 'del_pro');

$add_to_db_query = "INSERT INTO php_session_item 
        (SessionItemID, SessionID, ProductID, Quantity, Price)
        VALUES 
        ('', '$sesija', '$proizvodID', '$kolicina','$cijena')";
$update_db_query = "UPDATE php_session_item SET 
                    ProductID = '$proizvodID',   
                    Quantity = Quantity + '$kolicina',
                    Price = '$cijena'
                    WHERE SessionID = '$sesija' AND ProductID = '$proizvodID'";
$rem_from_db_query = "DELETE FROM php_session_item WHERE SessionID = '$sesija' AND ProductID = '$delete_proizvod'";

$if_in_db_query = "SELECT * FROM php_session_item WHERE SessionID = '$sesija' AND ProductID = '$proizvodID'";
$if_in_db = mysqli_query($db_connection, $if_in_db_query) or die(mysqli_error($db_connection));
$product_in_cart = (mysqli_num_rows($if_in_db) == '0') ? false : true;

if ($delete_proizvod != NULL) {
    $rem_from_db = mysqli_query($db_connection, $rem_from_db_query) or die(mysqli_error($db_connection));

} else {
    if (($proizvodID != NULL) && ($cijena != NULL)) {     
        if ($product_in_cart) {
            $update_db = mysqli_query($db_connection, $update_db_query) or die(mysqli_error($db_connection));
            unset($proizvodID);
            unset($kolicina);
            unset($cijena);
            unset($sesija);
        } else {
            $add_to_db = mysqli_query($db_connection, $add_to_db_query) or die(mysqli_error($db_connection));
            unset($proizvodID);
            unset($kolicina);
            unset($cijena);
            unset($sesija);
        }
    }
}

$host = filter_input(INPUT_SERVER, 'HTTP_HOST');
$url_korpa = $host . '/katalog/korpa.php';
header("location: /katalog/korpa.php");
?>