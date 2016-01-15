<?php
function kategorije_izabranog_proizvoda($proizvod, $db_con) {
    $upit = "SELECT * FROM php_product_categories WHERE ProductID ='$proizvod'";
    $query = mysqli_query($db_con, $upit);
    while ($row = mysqli_fetch_array($query)) {
        $kategorije[] = $row['CategoryID'];
    }

    if (isset($kategorije)) {
        return array_unique($kategorije);
    } else {
        return array();
    }
}

/*function spisak_proizvoda($db_con) {
    $upit = "SELECT * FROM php_product";
    $query = mysqli_query($db_con, $upit) or die(mysqli_error($db_connection));
    while ($products = mysqli_fetch_array($query)) {
        $niz_prod [] = [$products['ProductID'] => $products['ProductName']];
    }
    //return $niz_prod;
}*/

function izbrisati_proizvod_iz_kategorije($proizvod, $kategorija, $db_con) {
    mysqli_query($db_con, "DELETE FROM php_product_categories
            WHERE ProductID = '$proizvod' AND CategoryID = '$kategorija'")
            or die("Error: " . mysqli_error($db_con));
}

function izbrisati_proizvod_iz_zadnje_kategorije($proizvod, $db_con) {
    mysqli_query($db_con, "DELETE FROM php_product_categories
            WHERE ProductID = '$proizvod'")
            or die("Error: " . mysqli_error($db_con));
}

function dodati_proizvod_u_kategoriju($proizvod, $kategorija, $db_con) {
    $check_prod_cat_in_db = mysqli_query($db_con, "SELECT * FROM php_product_categories WHERE ProductID = '$proizvod' and CategoryID = '$kategorija'");
    if (mysqli_num_rows($check_prod_cat_in_db) == NULL) {
        mysqli_query($db_con, "INSERT INTO php_product_categories (ProductCategoryID, ProductID, CategoryID)
            VALUES ('', '$proizvod', '$kategorija')") or die("Error: " . mysqli_error($db_con));
        return true;
    } else {
        return false;
    }
}

function brisanje_nekompletnih_parova($db_con) {
    $upit = "DELETE FROM php_product_categories WHERE ProductID = '' OR CategoryID = ''";
    mysqli_query($db_con, $upit)
            or die("Error: " . mysqli_error($db_con));
}

//NOVI DIO        

function odredjivanje_razmaka_kategorija($var) {
    switch ($var) {
        case 0:
            return '';
            break;
        case 1:
            return '&nbsp;&nbsp;';
            break;
        case 2:
            return '&nbsp;&nbsp&nbsp;&nbsp;&nbsp;';
            break;
    }
}

function stil_prikaza_kategorija($niz_imena, $levl, $i) {
    switch ($i) {
        case 0:
            return '<span style="text-transform: uppercase;font-weight:bold;">' . $niz_imena[$levl[$i]] . '</span>';
            break;
        case 1:
            return '<span style="font-weight:bold; padding-left:10px;padding">' . $niz_imena[$levl[$i]] . '</span>';
            break;
        case 2:
            return '<span style="padding-left:20px;">' . $niz_imena[$levl[$i]] . '</span>';
            break;
    }
}

function echo_select($array, $imena_niz, $niz_kategorija) {
    foreach ($array as $kategorije) {
        for ($i = 0; $i < count($kategorije); $i++) {
            if (!isset($level[$i])) {
                $level[$i] = $kategorije[$i];
                if($niz_kategorija == ''){
                    $niz_kategorija = array ();
                }
                $selected = (in_array($level[$i], $niz_kategorija)) ? ' checked' : '';
                if ($level[$i] != '') {
                    $prikaz_imena = stil_prikaza_kategorija($imena_niz, $level, $i);
                    echo '<input type="checkbox"' . 'onclick="this.form.submit()" name="checked_cat[]"  value="' . $level[$i] . '" ' . $selected . '>' . $prikaz_imena . '</input><br>';
                }
            }
            if ($level[$i] != $kategorije[$i]) {
                $level[$i] = $kategorije[$i];
                if($niz_kategorija == ''){
                    $niz_kategorija = array ();
                }
                $selected = (in_array($level[$i], $niz_kategorija)) ? 'checked' : '';
                if ($level[$i] != '') {
                    $prikaz_imena = stil_prikaza_kategorija($imena_niz, $level, $i);
                    echo '<input type="checkbox"' . 'onclick="this.form.submit()" name="checked_cat[]"  value="' . $level[$i] . '" ' . $selected . '>' . $prikaz_imena . '</input><br>';
                }
            }
        }
    }
}