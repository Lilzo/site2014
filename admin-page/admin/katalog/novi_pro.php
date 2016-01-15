<?php
$submited = filter_input(INPUT_POST, 'submit');
if (isset($submited)) {

    $er = false;
    // Sadrzaj ce biti azuriran slijedecim detaljima
    $id = str_replace(' ', '_', ltrim(rtrim(strtolower(filter_input(INPUT_POST, 'idp')))));
    $name =  ltrim(rtrim(filter_input(INPUT_POST, 'np')));
    $shortopis = filter_input(INPUT_POST, 'shdesc');
    $opis = filter_input(INPUT_POST, 'longdesc');
    $icn = ltrim(rtrim(filter_input(INPUT_POST, 'icn')));
    $img = ltrim(rtrim(filter_input(INPUT_POST, 'imgp')));
    $cijena = filter_input(INPUT_POST, 'pri');
    $okvirna = filter_input(INPUT_POST, 'appr');
    $jedinica = filter_input(INPUT_POST, 'unit');
    $napopustu = filter_input(INPUT_POST, 'atdis');
    $popust = filter_input(INPUT_POST, 'disc');


    $add_product_query = "INSERT INTO php_product 
        (ProductID, ProductName, ShortDesc, LongDesc, IconPath, 
        ImgPath, Price, AppPrice, Unit, AtDiscount, Discount)
        VALUES 
        ('$id', '$name', '$shortopis', '$opis','$icn',
        '$img', '$cijena', '$okvirna', '$jedinica', '$napopustu','$popust')";
    if (mysqli_query($db_connection, $add_product_query)) {
        echo('<p><b>Baza je uspješno ažurirana.</b></p>');
        $er = true;
    } else {
        die('<p>Greška prilikom ažuriranja sadržaja: ' .
                mysqli_error($db_connection) . '</p>');
    }
    
} else {
    // Dozvoli korisniku azuriranje sadrzaja
    // koristeci sadrzaj ID=$id
    echo '<p><a href="index.php">Nazad na pretragu sadržaja</a></p>';

    

    // Prikazi listu kategorija za
    // box and checkboxes.
  
    $server_php_self = filter_input(INPUT_SERVER, 'PHP_SELF');
    ?>
    <form action="<?= $server_php_self ?>" method="post" id="edit">
        <div id="col1">
            <p>
            <h3>ID proizvoda:</h3>
            <input type="text" name="idp" size="30">
            </p>
            <p>
            <h3>Ime proizvoda:</h3>
            <input type="text" name="np" size="30">
            </p>
            <p>
            <h3>Kratki opis:</h3>
            <input type="text" name="shdesc" size="50">
            </p>
            <p>
            <h3>Detaljan opis:</h3>
            <textarea id="desc"  type="text" name="longdesc" rows="20" cols="40"></textarea> 
            </p>   
        </div>
        <div id="col1">
            <p>
            <h3>Putanja ikonice:</h3>
             Npr: /images/katalog/betonska-galanterija/betonski-stub.gif
            <input type="text" name="icn" size="50">
            </p>
            <p>
            <h3>Putanja slike:</h3>
             Npr: /images/katalog/betonska-galanterija/betonski-stub.gif
            <input type="text" name="imgp" size="50">
            </p>
            <p>
            <h3>Jedinica mjere:</h3>
            <input type="text" name="unit" size="15">
            </p>
            <p>
            <h3>Tačna cijena:</h3>
            Ako se ne zna tačna cijena, popuniti polje Okvirna cijena.<br>
            <input type="text" name="pri" size="15">
            </p>
            <p>
            <h3>Okvirna cijena:</h3>
            Npr. Po dogovoru, 5-100 km...<br>
            <input type="text" name="appr" size="85">
            </p>
            <p>
            <h3>Na popustu:</h3>
            Čekirati ako je proizvod na popustu<br>
            <input type="checkbox" name="atdis" value="t">
            </p>
            <p>
            <h3>Popust:</h3>
            Ako je popust u procentima obavezno staviti znak % ,<br>
            a ako je cijena sa popustom upisati samo brojeve. <br>
            <input type="text" name="disc" size="10">
            </p>
            <input type="submit" name="submit" value="DODAJ SADRŽAJ" />
            </p>
        </div>
    </form>
<?php } ?>