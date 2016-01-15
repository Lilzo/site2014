<?php
function prikazi_odredjeni_broj_rijeci($stringBV, $brojacRijeci) {
    return implode(
            '', array_slice(
                    preg_split(
                            '/([\s,\.;\?\!]+)/', $stringBV, $brojacRijeci * 2 + 1, PREG_SPLIT_DELIM_CAPTURE
                    ), 0, $brojacRijeci * 2 - 1
            )
    );
}
/* Funkcija u kojoj je uredjena forma u kojoj će se prikazivati izabrani proizvodi */
function show_product_form($row) {
    $slika = $row['ImgPath'] == '' ? '/images/nema-slike-id.gif' : $row['ImgPath'];
    $filename = $_SERVER['DOCUMENT_ROOT'] . $slika;
    if (!file_exists($filename)) {
        $slika = '/images/nema-slike-id.gif';
    }
    $price = '';
    if ($row['Price'] != '' && $row['Price'] != '0.00') {
        $price = ' ' . $row['Price'] . ' KM';
    }
    if (($row['AppPrice'] != NULL) && ($row['AppPrice'] != '0')) {
        $price = trim($row['AppPrice']);
    }
    $at_discount = ($row['AtDiscount'] == NULL) || ($row['AtDiscount'] == '0') ? false : true;
    if (($at_discount) && (strpos($row['Discount'], '%') == false)) {
        $popust = $row['Discount'] . ' KM';
    }
    if (($at_discount) && (strpos($row['Discount'], '%') != false)) {
        $popust = ($price - ($price - ($row['Discount'] / 100))) . ' KM [ % ' . $row['Discount'] . '] ';
    }
    
    $str_replace_these = array( '-',' ', 'č', 'ć', 'ž', 'š', 'đ');
    $str_replace_with_those = array ('_', '-',  'c', 'c', 'z', 's', 'd');
    $product_name_link = str_replace($str_replace_these, $str_replace_with_those,  strtolower($row['ProductName']));
    
    echo'<div>' . '<h2><a href="/katalog/proizvod/' .$product_name_link. '">' . $row['ProductName'] . '</a></h2>'
    . '<a href="/katalog/proizvod/' .$product_name_link  . '">'
    . '<img class="imagedropshadow" src="..' . $slika . '"></a>';
//    . '<p Id="opis-proiz">' . $detaljan_opis . '</p>';
    /*Cijena je zakomentarisana- nije više*/
    if ($at_discount) {
        //Cijena:
        echo '<p id="cijena"><span id="stara-cijena"> Cijena:' . $price . '</span><span id="popust">' . $popust . '</span></p>';
    } else if ($price != '') {
        //cijena:
        echo '<p id="cijena"><span id="cijena">Cijena: ' . $price . '</span></p>';
    }
    echo '</div>';
}

/* Funkcija za pagination, preradjena sa strane novosti */

function paging($broj, $brojPoStrani, $kategorija, $prikazana_strana = 1) {
    $broj_strana = ceil($broj / $brojPoStrani);
        echo '<div class="paginations">';
        echo '<form method = "post" action = "">';
            //echo '<a href="#" class="pageing gradient">&#9668;&#9668;</a>';
        if ($broj_strana <6 && $broj_strana >1){
            echo '<form method ="post">';
            for($i = 1; $i<=$broj_strana; $i++){
                if($i == $prikazana_strana){
                    echo '<input class="pageing active" type="submit" name="page" value = "'.$i.'">';
                }else{
                     echo '<input class="pageing gradient" type="submit" name = "page" value="'.$i.'">';
                }
            }
            echo '</form>';
        } else if ($broj_strana>5){
            if($prikazana_strana < 4){
                /*Prikaz prve 3 strane*/
                for($t = 1; $t<6; $t++){
                     if($t == $prikazana_strana){
                         echo '<input class="pageing active" type="submit" name="page" value = "'.$t.'">';
                    }else{
                        echo '<input class="pageing gradient" type="submit" name = "page" value="'.$t.'">';
                    }
                }
                echo '&nbsp;&nbsp;<input class="pageing gradient" type="submit" name = "page" value="'.$broj_strana.'">';
            } else if($prikazana_strana >= 3 && $prikazana_strana <= $broj_strana-3){  
                /*prikaz srednjih strana */
                echo '<input class="pageing gradient" type="submit" name = "page" value="1">&nbsp;&nbsp;';
                for($t = $prikazana_strana-2; $t<=$prikazana_strana+2; $t++){
                     if($t == $prikazana_strana){
                        echo '<input class="pageing active" type="submit" name="page" value = "'.$t.'">';
                    }else{
                        echo '<input class="pageing gradient" type="submit" name = "page" value="'.$t.'">';
                    }
                }
                echo '&nbsp;&nbsp;<input class="pageing gradient" type="submit" name = "page" value="'.$broj_strana.'">';//<a href="#" class="pageing gradient">'.$broj_strana.'</a>';
            } else if($prikazana_strana > $broj_strana - 3){
                /*prikaz zadnje tri strane*/
                echo '<a href="#" class="pageing gradient">1</a>&nbsp;&nbsp;';
                for($t = $broj_strana - 4; $t<=$broj_strana; $t++){
                    if($t == $prikazana_strana){
                       echo '<input class="pageing active" type="submit" name="page" value = "'.$t.'">';
                   }else{
                        echo '<input class="pageing gradient" type="submit" name = "page" value="'.$t.'">';
                   }
                }
            }
        }

        echo '</form>';
        echo '</div>';

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
//odredjuje css klasu
function odredjivanje_klase_kategorija($var) {
    switch ($var) {
        case 0:
            return "category-level1";
            break;
        case 1:
            return "category-level2";
            break;
        case 2:
             return "category-level3";
            break;
    }
}
//prikazuje selektovanu kategoriju
function output_echo_select($level, $kategorija, $izabrana_kategorija, $nbsp, $niz_imena, $i) {

    $selected = ($level[$i] == $izabrana_kategorija) ? 'selected' : '';
    if ($level[$i] != '') {
        echo '<option ' . ' value="' . $level[$i] . '" ' . $selected . '>' . $nbsp . $niz_imena[$level[$i]] . '</option>';
    }
}

function echo_select($array, $imena_niz, $izabrana_kategorija) {
    foreach ($array as $kategorije) {
        for ($i = 0; $i < count($kategorije); $i++) {
            $nbsp = odredjivanje_razmaka_kategorija($i);
            $kalse = odredjivanje_klase_kategorija($i);
            if (!isset($level[$i])) {

                $level[$i] = $kategorije[$i];
                $selected = ($level[$i] == $izabrana_kategorija) ? 'selected' : '';
                if ($level[$i] != '') {
                    echo '<option  class="' .$kalse .'" value="' . $level[$i] . '" ' . $selected . '>' . $nbsp . $imena_niz[$level[$i]] . '</option>';
                }
            }
            if ($level[$i] != $kategorije[$i]) {
                $level[$i] = $kategorije[$i];
                $selected = ($level[$i] == $izabrana_kategorija) ? 'selected' : '';
                if ($level[$i] != '') {
                    echo '<option class="' .$kalse .'" value="' . $level[$i] . '" ' . $selected . '>' . $nbsp . $imena_niz[$level[$i]] . '</option>';
                }
            }
        }
    }
}
/* Dio ispod provjerava da li je izabrana kategorija tj. proizvod, i na osnovu toga odredjuje da*
 * li da prikaže podrazumjevanu katogoriju (rudarstvo) ili izabranu kategoriju odnosno proizvod *
 * i da definiše WHERE za upit za izbor proizvoda ako je izabrana kategorija. Ukoliko je        *
 * izabrana kategorija  "sve" onda WHERE prima drugu vrijednost, i poništava izabrani proizvod. *  
 * Takodje kod ispod omogućava pamćenje izabranog proizvoda i kategorije preko sesije.          */
$trenutna_strana = filter_input(INPUT_POST, 'page');
if (($trenutna_strana == NULL) || ($trenutna_strana == '')) {
    $trenutna_strana = 1;
}
if (isset($_POST['broj_proizvoda'])){
    $broj_proizvoda_po_stranici = $_POST['broj_proizvoda'];
    $_SESSION['broj_proizvoda'] = $broj_proizvoda_po_stranici;
} else if(isset($_SESSION['broj_proizvoda'])){
    $broj_proizvoda_po_stranici = $_SESSION['broj_proizvoda'];
} else {
    $broj_proizvoda_po_stranici = 15;
}
$limit = " LIMIT " . (($trenutna_strana - 1) * $broj_proizvoda_po_stranici) . " , " . $broj_proizvoda_po_stranici;
$izabrani_proizvod = filter_input(INPUT_POST, 'izabrani_proizvod');
$izabrana_kategorija = filter_input(INPUT_POST, 'izabrana_kategorija');
$where_product_chosen = '';

//da ne pamti izabrani proizvod pri promjeni kategorije
if (isset($izabrana_kategorija) && isset($_SESSION['izabrana_kategorija'])){ 
    if ($izabrana_kategorija != $_SESSION['izabrana_kategorija']){
        $izabrani_proizvod = '';
    }
}
//ako je izabrana kategorija da pamti u sesiji, i pri povratku da čita iz sesije
//a ako nije, podrazumjevana je rud_bok
if (isset($izabrana_kategorija)) {
    $_SESSION['izabrana_kategorija'] = $izabrana_kategorija;
}
if (isset($_SESSION['izabrana_kategorija'])) {
    $izabrana_kategorija = $_SESSION['izabrana_kategorija'];
}
if (($izabrana_kategorija == '') && ($izabrana_kategorija == NULL)) {
    $izabrana_kategorija = 'sve';
}

//$where_category pomoću where kaluzule kontoliše izbor proizvoda na osnovu kategorije
//za kategoriju sve prikazuje sve proizvode
$where_category = " WHERE (php_product_categories.CategoryID = '$izabrana_kategorija' "
        . "OR php_categories.CategoryType = '$izabrana_kategorija') ";
if ($izabrana_kategorija == 'sve') {
    $where_category = " WHERE 1= 1";
}
//ako je izabran proizvod da pamti u sesiji, i pri povratku da čita iz sesije

if (isset($izabrani_proizvod)) {
    $_SESSION['izabrani_proizvod'] = $izabrani_proizvod;
}
if (isset($_SESSION['izabrani_proizvod'])) {
    $izabrani_proizvod = $_SESSION['izabrani_proizvod'];
}
//$where_product_chosen pomoću where kaluzule kontoliše izbor proizvoda koji je izabran
if (isset($izabrani_proizvod) && ($izabrani_proizvod != '')) {
    $where_product_chosen = " AND php_product_categories.ProductID = '$izabrani_proizvod'";
}

//$order_by = '';
if (isset($_POST['sortiranje'])){
    $order_by = $_POST['sortiranje'];
    $_SESSION['sortiranje'] = $order_by;
} else if(isset($_SESSION['sortiranje'])){
   $order_by = $_SESSION['sortiranje'] ;
} else{
    $order_by = '' ;
}
    
    switch ($order_by) {
        case "name_asc":
            $sortiranje = " ORDER BY php_product.ProductName ASC ";
            break;
        case "name_desc":
            $sortiranje = " ORDER BY php_product.ProductName DESC ";
            break;
        case "price_asc":
            $sortiranje = " ORDER BY php_product.Price ASC, php_product.AppPrice ASC ";
            break;
        case "price_desc":
            $sortiranje = " ORDER BY php_product.Price DESC, php_product.AppPrice DESC ";
            break;
        default: $sortiranje = ' ORDER BY php_product.ProductID ASC ';
    }
/* Upiti za  prikazivanje proizvoda (query_pro) i za razdvajanje glavnih kategorija od podktagoerija.   *
 * Razdvaja ih tako što upitom query_kat stavlja sve glavne kategorije u asocijativni niz $main_cat     *
 * koji se kasnije u <select> tagu razjedinjuje i na osnovu njega se odrejuju podkategorije. Quuery_pro *
 * prikazuje izabrani proizvode ili ako je odredjeni where product_chosen proizvod, dok query_list_pro  *
 * prikazuje menije iz izabrane kategorije u padajućem meniju. Prikazati proizvode kategorije je novi   *
 * upit koji omogućava da ukoliko je odabran i zapamćen proizvod u sesiji, prilikom promjene kategorije *
 * u neku drugu koja ne sadrži taj proizvod, prikaže samo proizvode iz te kategorije.                   */


$upit_prikazani_proizvodi = "SELECT * FROM  php_product_categories
                            INNER JOIN php_product
                            ON php_product_categories.ProductID = php_product.ProductID 
                            INNER JOIN php_categories
                            ON (php_product_categories.CategoryID = php_categories.CategoryType
                            OR php_product_categories.CategoryID = php_categories.CategoryID
                            OR php_product_categories.CategoryID = php_categories.Subcategory)"
        . $where_category . $where_product_chosen
        . " GROUP BY php_product_categories.ProductID" .$sortiranje . $limit ;

//$upit_prikazati_proizvode_kategorije = "SELECT * FROM php_product INNER JOIN php_product_categories
//            ON php_product.ProductID = php_product_categories.ProductID " . $where_category
//        . " GROUP BY php_product.ProductID" . " ORDER BY php_product_categories.ProductID ASC " . $limit;
$upit_all_prod_show = "SELECT * FROM  php_product_categories
                            INNER JOIN php_product
                            ON php_product_categories.ProductID = php_product.ProductID 
                            INNER JOIN php_categories
                            ON (php_product_categories.CategoryID = php_categories.CategoryType
                            OR php_product_categories.CategoryID = php_categories.CategoryID
                            OR php_product_categories.CategoryID = php_categories.Subcategory)" . $where_category . $where_product_chosen
        . " GROUP BY php_product.ProductID" .$sortiranje;
$query_list_pro = "SELECT * FROM php_product_categories 
                    INNER JOIN php_product
                    ON php_product_categories.ProductID = php_product.ProductID 
                    INNER JOIN php_categories
                            ON (php_product_categories.CategoryID = php_categories.CategoryType
                            OR php_product_categories.CategoryID = php_categories.CategoryID
                            OR php_product_categories.CategoryID = php_categories.Subcategory)"
        . $where_category
        . " GROUP BY php_product_categories.ProductID" .$sortiranje;
$all_products = mysqli_query($db_connection, $upit_all_prod_show);
$products_displayed = mysqli_query($db_connection, $upit_prikazani_proizvodi) or die(mysqli_error($db_connection));
$product_list = mysqli_query($db_connection, $query_list_pro) or die(mysqli_error($db_connection));

$num_prod = mysqli_num_rows($products_displayed);

$imena_kategorija_upit = "SELECT * FROM php_category_names";
$imena_upit = mysqli_query($db_connection, $imena_kategorija_upit);

$kategorije_upit = "SELECT CategoryType, CategoryID, Subcategory 
                    FROM php_categories 
                    GROUP BY CategoryType, CategoryID, Subcategory 
                    ORDER BY CategoryType, CategoryID, Subcategory";
$kategorije_group_by = mysqli_query($db_connection, $kategorije_upit)or die(mysqli_error($db_connection));

while ($kats = mysqli_fetch_array($kategorije_group_by)) {
    $nadkategorija = $kats[0];
    $kategorija = $kats[1];
    $podkategorija = $kats[2];
    $glavne[] = array($nadkategorija, $kategorija, $podkategorija);
}
while ($imena = mysqli_fetch_array($imena_upit)) {
    $ime_id[$imena['CategoryID']] = $imena['CategoryName'];
}

/*var sortiranje*/
 $order_by_values = array('name_asc' =>'Po imenu rastuće',
                        'name_desc' =>'Po imenu opadajuće',
                        'price_asc' =>'Po cijeni rastuće',
                        'price_desc' =>'Po cijeni opadajuće');
 
$num_of_products_values = array('15' =>'15 proizvoda po strani',
                        '30' =>'30 proizvoda po strani',
                        '45' =>'45 proizvoda po strani',
                        '60' =>'60 proizvoda po strani');
?>
<!--Forme za izbor kategorija i proizvoda naknadno je potrebno dodati i autocomplete za pretragu proizvoda-->
<div id="one_row_katalog">
    <div id="forma-proizvodi">
        <form id ="pretraga-proizvoda" name="chose_product" method ="post">
            <?php
            /* Izbor kategorije. Petljama se čita niz $main_cat. Upit koji se nalazi u petlji se    *
             * mijenja u zavisnosti koja glavna kategorija je "na redu", i na osnovu upita traži    *
             * podkategorije. Uloga $selected je već gore objašnjena.                               */
            echo '<select id="izaberi-kategoriju" name="izabrana_kategorija" onchange="this.form.submit();" >'
            . '<option class="category-level1" value="sve">Sve kategorije</option>';
            $selected = '';
            echo_select($glavne, $ime_id, $izabrana_kategorija);
            echo '</select>';
            /* Na ovom mjestu se bira proizvod. Uključen je submit forme na promjenu vrijednosti.   *
             * Ako je izabran proizvod pomoću petlje promjenljive selected u formi se označava      * 
             * izabrani proizvod */
            echo '<select id="izaberi-proizvod" name="izabrani_proizvod" onchange="this.form.submit();" >
                <option value="">Svi proizvodi</option>';
            while ($products = mysqli_fetch_array($product_list)) {
                $selected = ($products['ProductID'] == $izabrani_proizvod) ? 'selected' : '';
                echo '<option value="' . $products['ProductID'] . '" ' . $selected . '>' . $products['ProductName'] . '</option>';
                unset($selected);
            }
            echo '</select>';
            ?>
            <select id="sortiranje" name="sortiranje" onchange="this.form.submit();" >'
                <option value="">Osnovno sortiranje</option>
                <?php 
                foreach ($order_by_values as $value => $description) {
                    $sel_sort = ($order_by == $value) ? 'selected' : '';
                    echo '<option value="'.$value .'"' .$sel_sort.'>'.$description.'</option>';
                }
                ?>
            </select>
            <select id="broj-proizvoda" name="broj_proizvoda" onchange="this.form.submit();" >'
                <?php 
                foreach ($num_of_products_values as $value => $description) {
                    $sel_num_prod= ($broj_proizvoda_po_stranici == $value) ? 'selected' : '';
                    echo '<option value="'.$value .'"' .$sel_num_prod.'>'.$description.'</option>';
                }
                ?>
            </select>
        <!--  <form id = "pretraga" name ="proizvodi" method ="post">
                <input id = "search-proizvod" placeholder ="Ovdje će biti autocomplete" type ="search" name ="keyword">
                <input id = "submit-proizvod" type = "submit" value = "Pretraži">
            </form>
        <form id="pretraga" name="broj_proizvoda" method ="post">
            <select id="chose-category" name="broj_proizvoda" onchange="this.form.submit();" >'
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="45">45</option>
                <option value="60"></option>
            </select>
        </form>-->
        </form>
    </div>
</div>
<?php
/*Pejdžiranje pagination 1*/
echo '<div class="pagination-main">';
    $num_all_pro = mysqli_num_rows($all_products);
    if (ceil($num_all_pro / $broj_proizvoda_po_stranici) != 0) {
        paging($num_all_pro, $broj_proizvoda_po_stranici, $izabrana_kategorija, $trenutna_strana);
    }
echo '<hr></div>';
/* Pomoću koda ispod se ispisuju tri proizvoda u liniji. */
$i = '0';
$num_pro = mysqli_num_rows($products_displayed);
while ($product = mysqli_fetch_array($products_displayed)) {
    $br = $num_pro - $i;
    if (($i % 3 == 0) || ($num_pro == 1)) {
        echo '<div id="one_row_katalog"> ';
    }
    show_product_form($product);
    if (($i % 3 == 2) || ($num_pro == 1) || (($num_pro % 3 != 0) && ($br == 1))) {
        echo '</div><hr> ';
    }
    $i++;
}
/* Pejdžiranje 2 */
echo '<div class="pagination-main">';
    if (ceil($num_all_pro / $broj_proizvoda_po_stranici) != 0) {
        paging($num_all_pro, $broj_proizvoda_po_stranici, $izabrana_kategorija, $trenutna_strana);
    }
echo '</div>';
?>