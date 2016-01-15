<?php
$show_proizvod_n = str_replace('-', ' ', substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], "proizvod/")+9)); 
$show_proizvod_n = str_replace('_', '-', $show_proizvod_n);
$product_name_query = "SELECT * FROM php_product WHERE ProductName = '$show_proizvod_n'";

$id_prod = mysqli_query($db_connection, $product_name_query);

while ($is = mysqli_fetch_array($id_prod)) {
    $show_proizvod = $is['ProductID'];
}

$query_pro = "SELECT DISTINCT * FROM php_product WHERE php_product.ProductID = '$show_proizvod'";
$query_first = "SELECT ProductName FROM php_product WHERE php_product.ProductID = '$show_proizvod'";
$sukat_que = "SELECT * FROM php_product_categories WHERE ProductID = '$show_proizvod'";

// INNER JOIN  php_product_categories ON  php_product.ProductID = php_product_categories.ProductID
$ime = mysqli_query($db_connection, $query_first);
$prod = mysqli_query($db_connection, $query_pro);
$kat = mysqli_query($db_connection, $sukat_que);
$query_categories_names = mysqli_query($db_connection, "SELECT * FROM php_category_names");

while ($im = mysqli_fetch_array($ime)) {
    $name = strtolower($im['ProductName']);
}
while ($ka = mysqli_fetch_array($kat)) {
    $kategorije[] = $ka['CategoryID'];
}
while($kn = mysqli_fetch_array($query_categories_names)){
    $imena_kategorija[$kn['CategoryID']] = $kn['CategoryName'];
    //$ime_id[$imena['CategoryID']] = $imena['CategoryName'];
}

//$show_proizvod = filter_input(INPUT_GET, 'id');
//$query_pro = "SELECT DISTINCT * FROM php_product WHERE php_product.ProductID = '$show_proizvod'";
//$query_first = "SELECT ProductName, ProductID FROM php_product WHERE php_product.ProductID = '$show_proizvod'";
/*$sukat_que = "SELECT * FROM php_product_categories AS a "
        . "INNER JOIN php_categories as b "
        . "ON a.CategoryID = b.CategoryID "
        . "INNER JOIN php_category_names as c "
        . "ON a.CategoryID = c.CategoryID "
        . "WHERE a.ProductID = '$show_proizvod' GROUP BY a.ProductID";*/
$subkat_que = "SELECT * FROM php_product_categories AS a "
        . "INNER JOIN php_categories as b "
        . "ON a.CategoryID = b.Subcategory "
        . "INNER JOIN php_category_names as c "
        . "ON a.CategoryID = c.CategoryID "
        . "WHERE a.ProductID = '$show_proizvod' GROUP BY a.ProductID";


// INNER JOIN  php_product_categories ON  php_product.ProductID = php_product_categories.ProductID
//$ime = mysqli_query($db_connection, $query_first);
//$prod = mysqli_query($db_connection, $query_pro);
//$kat = mysqli_query($db_connection, $sukat_que);
$podkat = mysqli_query($db_connection, $subkat_que);

while ($im = mysqli_fetch_array($ime)) {
    $name = strtolower($im['ProductName']);
}

while ($ka = mysqli_fetch_array($kat)) {
    $kategorije[] = $ka['CategoryID'];
}


/*while ($ka = mysqli_fetch_array($kat)) {
    $ime_kategorije = $ka['CategoryName'];
    $id_kategorije = $ka['CategoryID'];
}*/
while ($ska = mysqli_fetch_array($podkat)) {
    $ime_podkategorije = $ska['CategoryName'];
    $id_podkategorije = $ska['CategoryID'];
}

function echo_select($array, $imena_niz, $izabrana_kategorija) {
    foreach ($array as $kategorije) {
        for ($i = 0; $i < count($kategorije); $i++) {
            $nbsp = odredjivanje_razmaka_kategorija($i);
            if (!isset($level[$i])) {

//                output_echo_select($level, $kategorije, $izabrana_kategorija, $nbsp, $imena_niz, $i);
                $level[$i] = $kategorije[$i];
                $selected = ($level[$i] == $izabrana_kategorija) ? 'selected' : '';
                if ($level[$i] != '') {
                    echo '<option ' . ' value="' . $level[$i] . '" ' . $selected . '>' . $nbsp . $imena_niz[$level[$i]] . '</option>';
                }
            }
            if ($level[$i] != $kategorije[$i]) {
                $level[$i] = $kategorije[$i];
                $selected = ($level[$i] == $izabrana_kategorija) ? 'selected' : '';
                if ($level[$i] != '') {
                    echo '<option ' . ' value="' . $level[$i] . '" ' . $selected . '>' . $nbsp . $imena_niz[$level[$i]] . '</option>';
                }
            }
        }
    }
}
/*quick links*/
echo '<div id="pozicija">
        <span>Kategorije proizvoda:</span>
        <form method="post" class="detaljnije_form" action="/katalog/">
            <input type="hidden" name="izabrana_kategorija" value="sve">
            <input type="hidden" name="izabrani_proizvod" value="">
            <input type="submit" value="katalog">
        </form>';
        foreach ($kategorije as $ql){
            echo '/
            <form method="post" class="detaljnije_form" action="/katalog/">
                <input type="hidden" name="izabrana_kategorija" value="'.$ql.'">
                <input type="hidden" name="izabrani_proizvod" value="">
                <input type="submit" value="'.strtolower($imena_kategorija[$ql]) .'">
            </form>';
        }
        echo '/<form method="post" class="detaljnije_form" action="/katalog/">
                  <input type="hidden" name="izabrani_proizvod" value="'.$show_proizvod.'">
                <input type="submit" value="'.$name .'">
            </form>';
echo '</div><br>';
/*
echo '<div id="pozicija">&#8594;
    <a href= "/katalog"> katalog</a> 
    &#8594;
    <form method="post" class="detaljnije_form" action="/katalog/">
        <input type="hidden" name="izabrana_kategorija" value="'.$id_kategorije.'">
        <input type="submit" value="'.strtolower($ime_kategorije) .'">
    </form>';
    if(isset($id_podkategorije) && $id_podkategorije != ''){
    echo '    &#8594;
        <form method="post" class="detaljnije_form" action="/katalog/">
            <input type="hidden" name="izabrana_kategorija" value="'.$id_podkategorije.'">
            <input type="submit" value="'.strtolower($ime_podkategorije) .'">
        </form>';
    
    }
    echo '&#8594; 
         <form method="post" class="detaljnije_form" action="/katalog/">
            <input type="hidden" name="izabrani_proizvod" value="'.$product_id.'">
            <input type="submit" value="'.strtolower($name) .'">
        </form>
        </div><br>';*/
// <a href= "/katalog"> '. $name . '</a></div>';
while ($row = mysqli_fetch_array($prod)) {
        
    $slika = $row['ImgPath'] == '' ? '/images/nema-slike-id.gif' : $row['ImgPath'];
    $filename = $_SERVER['DOCUMENT_ROOT'] . $slika;
    if (!file_exists($filename)) {
        $slika = '/images/nema-slike-id.gif';
    }
    $real_price = $row['Price'];
    $proizvod_name = $row['ProductName'];
    $icon = $row['IconPath'];
    $jedinica = $row['Unit'];
    $price = '';
    if ($row['Price'] != '' && $row['Price'] != '0.00') {
        $price = ' ' . $row['Price'] . ' KM';
    }
    $app_price = false;
    if (($row['AppPrice'] != NULL) && ($row['AppPrice'] != '0')) {
        $price = $row['AppPrice'];
        $real_price = $price;
        $app_price = true;
    }
    $at_discount = ($row['AtDiscount'] == NULL) || ($row['AtDiscount'] == '0') ? false : true;
    if (($at_discount) && (strpos($row['Discount'], '%') == false)) {
        $popust = $row['Discount'] . ' KM';
        $real_price = $row['Discount'];
    }
    if (($at_discount) && (strpos($row['Discount'], '%') != false)) {
        $popust = ($price - ($price - ($row['Discount'] / 100))) . ' KM [ % ' . $row['Discount'] . '] ';
        $real_price = $price - ($price - ($row['Discount'] / 100));
    }

    echo '<div id="detaljnije_o_proizvodu">
    <h2>' . $proizvod_name . '</h2>
    <div id= "img_div"> 
        <img class="imagedropshadow" src="' . $slika . '">
    </div>
    <div id="opis">' . $row['LongDesc'];
    if ($jedinica != '') {
        echo '<li>Jedinica mjere: ' . $jedinica . '.</li>';
    }
    if ($at_discount) {
        //echo '<p id="cijena">Cijena: <span id="stara-cijena"> ' . $price . '</span><span id="popust">' . $popust . '</span></p>';
        echo '<li>Cijena: <span id="stara-cijena"> ' . $price . '</span><span id="popust">' . $popust . '</span></li>';
    } else if ($price != '') {
        //echo '<p id="cijena">Cijena ' . $price . '</span></p>';
        echo '<li>Cijena ' . $price . '.</li>';
    }
    echo '</dvi></div></div>';
}
?>
<form action="/katalog/upis_korpa.php"  method="post" id="frm-kolicina">
    <input type="hidden" value="<?= $show_proizvod ?>" name="proizvodID">
    <input type="hidden" value="<?= $proizvod_name ?>" name="proizvod">
    <input type="hidden" value="<?= $real_price ?>" name="cijena">
    <input type="hidden" value="<?= $icon ?>" name="icon">
    <input type="hidden" value="<?= $jedinica ?>" name="jedinicaMjere">
        <div id="kolicina-tekst">
            Količina: 
        </div> 
        <div class="field">
            <input type="text" id="chose-quntity" name="kolicina"> <br>
            <input type="submit" id="submit-proizvod" value="Dodaj u korpu" name="Dodaj u korpu">
        </div>
    <div id="kolicina-tekst"></div><div class="status"></div>
</form>

<div id="pozicija">
    <hr>
    <form class="detaljnije_form">
        <input id="back-button" type="button" value="<" onClick="history.go(-1);return true;">
        <input id="nazad-katalog" type="button" value="povratak na prethondu stranu" onClick="history.go(-1);return true;">
    </form> 
    <hr>
</div>
<!--<form id="signupform" autocomplete="off" method="get" action="">
    <div class="field"><input id="firstname" name="firstname" type="text" value="" /></div>
    <div class="status"></div>
    <input id="signupsubmit" name="signup" type="submit" value="Signup" />
</form>-->