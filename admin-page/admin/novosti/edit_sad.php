<?php
$submited = filter_input(INPUT_POST, 'submit');
if (isset($submited)) {
    // Sadrzaj ce biti azuriran slijedecim detaljima
    $id = filter_input(INPUT_POST, 'id');
    $aid = filter_input(INPUT_POST, 'aid');

    $naslov_clanka = filter_input(INPUT_POST, 'naslov');
    $tekst_clanka = filter_input(INPUT_POST, 'textclanka');
    //$tekst_clanka = mysql_real_escape_string($tekst_clanka);
   $datum = filter_input(INPUT_POST,'datum');
    $update_query = "UPDATE vijesti SET  
          Naslov='$naslov_clanka',
          VijestiText ='$tekst_clanka',   
          AID='$aid',
          VijestiDatum = '$datum'
          WHERE ID='$id'";

    if (mysqli_query($db_connection, $update_query)) {
        echo('<p><b>Sadržaj je uspješno ažuriran.</b></p>');
    } else {
        die('<p>Greška prilikom ažuriranja sadržaja: ' .
                mysqli_error($db_connection) . '</p>');
    }
} else { // Dozvoli korisniku azuriranje sadrzaja
    // koristeci sadrzaj ID=$id
    echo '<p><a href="pretraga.php">Nazad na pretragu sadržaja</a></p>';


    $id = filter_input(INPUT_GET, 'id');
    $izbor_clanaka = mysqli_query($db_connection, "SELECT * FROM vijesti WHERE ID ='$id'");
    if (!$izbor_clanaka) {
        die('<p>Greška pri uspostavljanju veze sa bazom podataka: ' .
                mysqli_error($db_connection) . '</p>');
    }

    $izbor_clanka = mysqli_fetch_array($izbor_clanaka, MYSQLI_BOTH);

    $tekst_clanka = htmlspecialchars($izbor_clanka['VijestiText']);
    $naslov_clanka = htmlspecialchars($izbor_clanka['Naslov']);
    $datum = $izbor_clanka['VijestiDatum'];

    $authid = $izbor_clanka['AID'];
    // Prikazi listu podkategorija i kategorija za
    // za the select box and checkboxes.
    $authors = mysqli_query($db_connection, 'SELECT ID, Ime FROM autori');
    $server_php_self = filter_input(INPUT_SERVER, 'PHP_SELF');
    ?>
    <div id="col1">
        <form action="<?= $server_php_self ?>" method="post">
            <p>
            <h3>Naslov:</h3>
            <input type="text" name="naslov"  size="85" value="<?php echo $naslov_clanka ?>">
            </p>
            <p>
            <h3>Datum:</h3>
            <input type="text" name="datum" size="85" value="<?= $datum ?>">
            </p>
            <p>
            <h3>Tekst članka</h3>
            <textarea name="textclanka" rows="33" cols="65"><?= $tekst_clanka ?></textarea>
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
    <input type="hidden" name="id" value="<?= $id ?>" />
    <p> 
        <input type="submit" name="submit" value="AŽURIRAJ SADRŽAJ" />
    </p>
    </div>
    </form>
<?php } ?>