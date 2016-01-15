<?php
$submited = filter_input(INPUT_POST, 'submit');
if (isset($submited)) {
    // Sadrzaj ce biti azuriran slijedecim detaljima
    $id = filter_input(INPUT_POST, 'id');
    $aid = filter_input(INPUT_POST, 'aid');
    $kategorija = filter_input(INPUT_POST, 'kategorija');
    $podkategorija = filter_input(INPUT_POST, 'podkategorija');
    $pozicija = filter_input(INPUT_POST, 'pozicija');
    $nas_cla = filter_input(INPUT_POST, 'naslov');
    $naslov_clanka = str_replace(" ", "_", $nas_cla);
    
    $tekst_clanka = filter_input(INPUT_POST, 'textclanka');
    // $tekst_clanka =$tekst_clanka);
    if ($podkategorija == 'download') {
        $tekst_clanka = str_replace("\n", ';', $tekst_clanka);
        $tekst_clanka = str_replace(": ", ",", $tekst_clanka);
    }

    if (($tekst_clanka != null) || ($tekst_clanka != "") ) {
        $update_query = "UPDATE clanci SET  
          clanak_naslov='$naslov_clanka',
          clanak_text ='$tekst_clanka',   
          author_id='$aid',
          sektor ='$kategorija',
          tab ='$podkategorija',
          pozicija = '$pozicija'
          WHERE id_clanak='$id'";

        if (mysqli_query($db_connection, $update_query)) {
            echo('<p><b>Sadržaj je uspješno ažuriran.</b></p>');
        } else {
            die('<p>Greška prilikom ažuriranja sadržaja: ' .
                    mysqli_error($db_connection) . '</p>');
        }
    }
 else {
    echo "ne može ovako";    
    }
} else { // Dozvoli korisniku azuriranje sadrzaja
    // koristeci sadrzaj ID=$id
    echo '<p><a href="pretraga.php">Nazad na pretragu sadržaja</a></p>';


    $id = filter_input(INPUT_GET, 'id');
    $izbor_proizvoda = mysqli_query($db_connection, "SELECT * FROM clanci WHERE id_clanak ='$id'");
    if (!$izbor_proizvoda) {
        die('<p>Greška pri uspostavljanju veze sa bazom podataka: ' .
                mysqli_error($db_connection) . '</p>');
    }

    $show_proizvod = mysqli_fetch_array($izbor_proizvoda, MYSQLI_BOTH);
    $podkategorija_clanka = $show_proizvod['tab'];
    $tekst_clanka = $show_proizvod['clanak_text'];
    if ($podkategorija_clanka == 'download') {
        $tekst_clanka = str_replace(";", "\n", $tekst_clanka);
        $tekst_clanka = str_replace(",", ": ", $tekst_clanka);
    }
    $naslov_clanka = $show_proizvod['clanak_naslov'];
    $nas_cla = str_replace("_", " ", $naslov_clanka);
    $pozicija_clanka = $show_proizvod['pozicija'];

    $authid = $show_proizvod['author_id'];
    // Prikazi listu podkategorija i kategorija za
    // za the select box and checkboxes.
    $authors = mysqli_query($db_connection, 'SELECT ID, Ime FROM autori');
    $iizabrane_kategorije = mysqli_query($db_connection, 'SELECT * FROM clanci_kategorije');
    $server_php_self = filter_input(INPUT_SERVER, 'PHP_SELF');
    ?>
    <div id="col1">
        <form action="<?= $server_php_self ?>" method="post" id="edit">
            <p>
            <h3>Naslov:</h3>
            <input type="text" name="naslov" size="50" value="<?= $nas_cla ?>">
            </p>
            <p>
            <h3>Pozicija teksta na strani</h3>
            Napomena: sortiranje članaka na strani, od manjeg ka većem (najmanji broj je na vrhu strane).<br>
            <input type="text" name="pozicija" size="5" value="<?= $pozicija_clanka ?>">
            </p>
            <p>
    <?php
    if ($podkategorija_clanka == 'download') {
        echo "Pri unošenju dokumanata iz download sekcije ukucati url lokaciju upisati dvotačku, zatim razmak, pa upisati željeni naziv fajla. "
        . "Za svaki sledeći dokument preći u novi red.";
    }
    ?>
            <h3>Tekst članka</h3>
            <textarea form="edit" name="textclanka" rows="25" cols="40" style="width: 100%" wrap><?php echo $tekst_clanka ?></textarea>
            </p>
    </div>
    <div id="col2">
        <p><h3>Autor:</h3> 
        <select name="aid" size="1">

    <?php
    while ($author = mysqli_fetch_array($authors, MYSQLI_BOTH)) {
        $aid = $author['ID'];
        $aname = htmlspecialchars($author['Ime']);
        if ($aid == $authid) {
            echo("<option selected value='$aid'>$aname</option>\n");
        } else {
            echo("<option value='$aid'>$aname</option>\n");
        }
    }
    ?>
        </select>
    </p>
    <p><h3>Postavi u kategoriju:</h3>
    <?php
    while ($kategorija = mysqli_fetch_array($iizabrane_kategorije, MYSQLI_BOTH)) {
        $kategorija_id = $kategorija['id_clanci_kategorije'];

        // Cekiraj ako je sadrzaj u ovoj kategoriji
        $result = mysqli_query($db_connection, "SELECT * FROM clanci WHERE id_clanak ='$id' AND sektor='$kategorija_id'");
        if (!$result) {
            die('<p>Greška prilikom hvatanja detalja: ' .
                    mysqli_error($db_connection) . '</p>');
        }
        if (mysqli_num_rows($result)) {
            echo("<input type='radio' checked name='kategorija' value='$kategorija_id'/>$kategorija_id<br />\n");
        } else {
            echo("<input type='radio' name='kategorija' value='$kategorija_id'/>$kategorija_id<br />\n");
        }
    }
    ?>
    </p>
    </div>
    <div id="col3">
        <p><h3>Postavi u podkategoriju</h3>
    <?php
    $podkategorije = mysqli_query($db_connection, 'SELECT * FROM clanci_podkategorije');

    while ($podkategorija = mysqli_fetch_array($podkategorije, MYSQLI_BOTH)) {
        $pod_kat = $podkategorija['id_podkategorija'];
        if ($pod_kat == $podkategorija_clanka) {
            echo("<input type='radio' checked name='podkategorija' value='$pod_kat'>$pod_kat<br>\n");
        } else {
            echo("<input type='radio' name='podkategorija' value='$pod_kat'>$pod_kat<br>\n");
        }
    }
    ?>
    </p>
    <input type="hidden" name="id" value="<?= $id ?>" />
    <p> 
        <input type="submit" name="submit" value="AŽURIRAJ SADRŽAJ" />
    </p>
    </div>
    </form>
<?php } ?>