<?php

$proizvodID = filter_input(INPUT_POST, 'proizvodID');
$kolicina = filter_input(INPUT_POST, 'kolicina');
$cijena = filter_input(INPUT_POST, 'cijena');
$sesija = session_id();

$add_to_db_query = "INSERT INTO php_session_item 
        (SessionItemID, SessionID, ProductID, Quantity, Price)
        VALUES 
        ('', '$sesija', '$proizvodID', '$kolicina','$cijena')";
$update_db_query = "UPDATE php_session_item SET 
                    ProductID = '$proizvodID',   
                    Quantity = Quantity + '$kolicina',
                    Price = '$cijena'
                    WHERE SessionID = '$sesija' AND ProductID = '$proizvodID'";


$cart_query = "SELECT php_session_item.Price as Price,
                php_product.AppPrice,
                php_product.ProductID,
                php_product.IconPath,
                php_product.ImgPath,
                php_session_item.Quantity,
                php_product.ProductName
                FROM php_session_item INNER JOIN php_product 
                ON php_session_item.ProductID  =php_product.ProductID WHERE SessionID = '$sesija'";
$cart = mysqli_query($db_connection, $cart_query);
$cart_is_empty = (mysqli_num_rows($cart) == '0') ? true : false;

$if_in_db_query = "SELECT * FROM php_session_item WHERE SessionID = '$sesija' AND ProductID = '$proizvodID'";
$if_in_db = mysqli_query($db_connection, $if_in_db_query) or die(mysqli_error($db_connection));
$product_in_cart = (mysqli_num_rows($if_in_db) == '0') ? false : true;

if (($proizvodID != NULL) && ($kolicina != NULL) && ($cijena != NULL)) {
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

if ($cart_is_empty) {
    echo 'Korpa je prazna';
    echo '<form>
            <input type="button" id="submit-proizvod"  value="< Katalog" onClick="location.href=\'/katalog\';return true;">
        </form>';
} else {
    echo '<div id="korpa-hr">
    <div id="naslov">Proizvod</div>
    <div id="kolicina"> Količina </div>
    <div id="cijena">Jed. Cijena</div>
</div>';

    while ($row = mysqli_fetch_array($cart)) {
        $slika = $row['ImgPath'] == '' ? '/images/nema-slike-id.gif' : $row['ImgPath'];
        $filename = $_SERVER['DOCUMENT_ROOT'] . $slika;
        if (!file_exists($filename)) {
            $slika = '/images/nema-slike-id.gif';
        }
        $row_kolicina = $row['Quantity'];
        if ($row['Quantity']== 0){
            $row_kolicina = '-';
        }
        $product_id = $row['ProductID'];
      //  $cijena = ($row['AppPrice'] != '')? $row['AppPrice'] : $row['Price'];
          $cijena = ($row['AppPrice'] != '' || $row['AppPrice'] != '0.00')? '-' : $row['Price'];
        $km = '';
        if (is_numeric($cijena)) {
            $cijena_kolicina = $cijena * $row['Quantity'];
            $km = ' KM';
            $ukupna_cijena [] = $cijena_kolicina;
            $sum_cijena = true;
            $zahtjev = 'Narudžbenica >';
        } else{
            $sum_cijena = false;
            $zahtjev = 'Zahtjev za ponudu >';
        }
             $str_replace_these = array( '-',' ', 'č', 'ć', 'ž', 'š', 'đ');
    $str_replace_with_those = array ('_', '-',  'c', 'c', 'z', 's', 'd');
    $product_name_link = str_replace($str_replace_these, $str_replace_with_those,  strtolower($row['ProductName']));
    
        echo '<div id="korpa">'
        . '<div id="ikonica"><a href="/katalog/proizvod/' .$product_name_link. '"><img class="imagedropshadow" src="' . $slika . '"></a>' . '</div>'
        . '<div id="naslov">' . $row['ProductName'] . '</div>'
        . '<div id="kolicina">' . $row_kolicina . '</div>'
        . '<div id="cijena">' . $cijena . $km . '</div>'
        . '<div id="ukloni">
        <form method="post" action="upis_korpa.php">
            <input type = "hidden" name="del_pro" value="' . $product_id . '">
            <input id="remove-from-cart" type="submit" name="del" value="Ukloni">
        </form>
     </div></div><hr>';
    }
    if ($sum_cijena){
    echo '<div id="korpa-bottom">
    <div id="label-ukupna-cijena" >Ukupna cijena</div>
    <div id="cijena">' . array_sum($ukupna_cijena) . ' KM</div>
</div><hr>';
    }
    echo '<div id="korpa-dugmad">
            <form>
                <input type="button" id="submit-proizvod"  value="< Pretraga proizvoda" onClick="location.href=\'/katalog\';return true;">
            </form>
            <form method="post" action="/katalog/korpa.php#kontakt-info">
                <input id="submit-proizvod" class="right-float" type="submit" name="naruci" value="'.$zahtjev .'">
            </form>
        </div>';
} 
echo '<div id="pozicija">
        <hr>
        <form class="detaljnije_form">
            <input id="back-button" type="button" value="<" onClick="history.go(-1);return true;">
            <input id="nazad-katalog" type="button" value="povratak na prethodnu stranu" onClick="history.go(-1);return true;">
        </form> 
        <hr>
</div>';

?>