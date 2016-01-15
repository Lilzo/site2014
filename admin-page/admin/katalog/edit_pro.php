<?php
$submited = filter_input(INPUT_POST, 'submit');
if (isset($submited)) {

    $er = false;
    // Sadrzaj ce biti azuriran slijedecim detaljima
    $id = ltrim(rtrim(filter_input(INPUT_POST, 'idp')));
    $name = ltrim(rtrim(filter_input(INPUT_POST, 'np')));
    $shortopis = filter_input(INPUT_POST, 'shdesc');
    $opis = filter_input(INPUT_POST, 'longdesc');
    $icn = ltrim(rtrim(filter_input(INPUT_POST, 'icn')));
    $img = ltrim(rtrim(filter_input(INPUT_POST, 'imgp')));
    $cijena = filter_input(INPUT_POST, 'pr');
    $okvirna = filter_input(INPUT_POST, 'appr');
    $jedinica = ltrim(rtrim(filter_input(INPUT_POST, 'unit')));
    $napopustu = ltrim(rtrim(filter_input(INPUT_POST, 'appr')));
    $popust = filter_input(INPUT_POST, 'disc');

    $update_product_query = "UPDATE php_product SET  
    ProductID = '$id',
    ProductName = '$name',   
    ShortDesc = '$shortopis',
    LongDesc = '$opis',
    IconPath ='$icn',
    ImgPath = '$img',
    Price ='$cijena',
    AppPrice = '$okvirna',
    Unit ='$jedinica',
    AtDiscount = '$napopustu',
    Discount = '$popust'
    WHERE ProductID='$id'";

    if (mysqli_query($db_connection, $update_product_query)) {
        echo('<p><b>Proizvod je uspješno ažuriran.</b></p>');
        $er = true;
    } else {
        die('<p>Greška prilikom ažuriranja sadržaja: ' .
                mysqli_error($db_connection) . '</p>');
    }

    $iizabrane_kategorije = filter_input(INPUT_POST, 'kategorija');
    $product_cat = filter_input(INPUT_POST, 'prokat');
   
} else {
    // Dozvoli korisniku azuriranje sadrzaja
    // koristeci sadrzaj ID=$id
    echo '<p><a href="index.php">Nazad na pretragu sadržaja</a></p>';

    $id = filter_input(INPUT_GET, 'id');
    $izbor_proizvoda = mysqli_query($db_connection, "SELECT * FROM php_product WHERE ProductID ='$id'");
    if (!$izbor_proizvoda) {
        die('<p>Greška pri uspostavljanju veze sa bazom podataka: ' .
                mysqli_error($db_connection) . '</p>');
    }

    $show_proizvod = mysqli_fetch_array($izbor_proizvoda, MYSQLI_BOTH);
    $id_proizvoda = $show_proizvod['ProductID'];
    $product_name = $show_proizvod['ProductName'];
    $short_desc = $show_proizvod['ShortDesc'];
    $long_desc = $show_proizvod['LongDesc'];
    $icon_path = $show_proizvod['IconPath'];
    $img_path = $show_proizvod['ImgPath'];
    $price = $show_proizvod['Price'];
    $app_price = $show_proizvod['AppPrice'];
    $unit = $show_proizvod['Unit'];
    $atdiscount = $show_proizvod['AtDiscount'];
    $discount = $show_proizvod['Discount'];

    // Prikazi listu kategorija za
    // box and checkboxes.
    $server_php_self = filter_input(INPUT_SERVER, 'PHP_SELF');
    ?>
    <form action="<?= $server_php_self ?>" method="post" id="edit">
        <div id="col1">
            <p>
            <h3>ID Proizvoda:</h3>
            <input id="id" type="text" name="idp" size="30" value="<?= $id_proizvoda ?>">
            </p>
            <p>
            <h3>Ime proizvoda:</h3>
            <input type="text" name="np" size="50" value="<?= $product_name ?>">
            </p>
            <p>
            <h3>Kratki opis:</h3>
            <input type="text" name="shdesc" size="50" value="<?= $short_desc ?>">
            </p>
            <p>
            <h3>Detaljan opis:</h3>
            <textarea id="desc"  type="text" name="longdesc" rows="20" cols="40"><?= $long_desc ?></textarea> 
            </p>
        </div>
        <div id="col1">
            <p>
            <h3>Putanja ikonice:</h3>
            Npr: /images/katalog/betonska-galanterija/betonski-stub.gif
            <input type="text" name="icn" size="50" value="<?= $icon_path ?>">
            </p>
            <p>
            <h3>Putanja slike:</h3>
             Npr: /images/katalog/betonska-galanterija/betonski-stub.gif
            <input type="text" name="imgp" size="50" value="<?= $img_path ?>">
            </p>
            <p>
            <h3>Jedinica mjere:</h3>
            <input type="text" name="unit" size="15" value="<?= $unit ?>">
            </p>
            <p>
            <h3>Tačna cijena:</h3>
            Ako se ne zna tačna cijena, popuniti polje Okvirna cijena.<br>
            <input type="text" name="pr" size="15" value="<?= $price ?>">
            </p>
            <p>
            <h3>Okvirna cijena:</h3>
            Npr. Po dogovoru, 5-100 km...<br>
            <input type="text" name="appr" size="80" value="<?= $app_price ?>">
            </p>
            <p>
            <h3>Na popustu:</h3>
            Čekirati ako je proizvod na popustu<br>
            <?php
            //dovde
            echo '<input type="checkbox" name="atdis" value="t"';
            echo (!empty($atdiscount)) ? "checked" : '';
            echo '">';
            ?>
            </p>
            <p>
            <h3>Popust:</h3>
            Ako je popust u procentima obavezno staviti znak % ,<br>
            a ako je cijena sa popustom upisati samo brojeve. <br>
            <input type="text" name="disc" size="10" value="<?= $discount ?>">
            </p>

            <input type="hidden" name="id" value="<?= $id ?>" />
            <p> 
                <input type="submit" name="submit" value="AŽURIRAJ SADRŽAJ" />
            </p>
        </div>
    </form>
<?php } ?>