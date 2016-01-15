<?php
if (session_id() == '') {
    session_start();
}
include '../auth.php';
?>
<html>
    <head>
        <title>Administracija</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="../css.css" type="text/css" media="screen" />
    </head>
    <body>
        <div id="main-div">
            <h2>Administracija</h2>
             <?php include_once '../inc/inc_meni.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Novi sadržaj</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2><a href="/cmsys/admin/sadrzaj/novi_sadrzaj.php">Unos novog sadržaja</a></h2>
                    <?php
                    $submited = filter_input(INPUT_POST, 'submit');
                    if (isset($submited)):
                        // novi sadrzaj je dodat
                        // koristenjem donje forme
                        $unos= false;
                        $author_id = filter_input(INPUT_POST, 'aid');
                        $nas_cla = filter_input(INPUT_POST, 'naslov');
                        $naslov_clanka = str_replace(" ", "_", $nas_cla);
                        $pozicija_clanka = filter_input(INPUT_POST, 'pozicija');
                        $podkategorija_clanka = filter_input(INPUT_POST, 'podkategorija');
                        $text_clanka = filter_input(INPUT_POST, 'textclanka');
                        if ($podkategorija_clanka == 'download')
                        {
                         $text_clanka = str_replace(PHP_EOL, ";", $text_clanka);
                         $text_clanka = str_replace(": ", ",", $text_clanka);
                        }
                        $kategorija_clanka = filter_input(INPUT_POST, 'kategorija');
                       

                        if ($author_id == '') {
                            die('<p>Morate izabrati izvor(autor) ' .
                                    'za ovaj sadrzaj. Kliknite na "Back" ' .
                                    'i pokusajte ponovo.</p>');
                        }
                        if ($kategorija_clanka == '') {
                            die('<p>Morate izabrati kategroiju ' .
                                    'za ovaj sadrzaj. Kliknite na "Back" ' .
                                    'i pokusajte ponovo.</p>');
                        }
                         if ($podkategorija_clanka == '') {
                            die('<p>Morate izabrati podkategroiju ' .
                                    'za ovaj sadrzaj. Kliknite na "Back" ' .
                                    'i pokusajte ponovo.</p>');
                        }

                        $novi_clanak_upit = "INSERT INTO clanci SET
                        id_clanak = '',
                        clanak_naslov ='$naslov_clanka',
                        clanak_text='$text_clanka',
                        sektor = '$kategorija_clanka',
                        tab = '$podkategorija_clanka',
                        pozicija = '$pozicija_clanka',
                        author_id = '$author_id'";
                        if (mysqli_query($db_connection, $novi_clanak_upit)) {
                            echo('<p>Novi sadržaj uspješno dodat !</p>');
                        } else {
                            die('<p>Greška prilikom dodavanja novog sadržaja: ' .
                                    mysqli_error($db_connection) . '</p>');
                        }

                        $jid = mysql_insert_id();
                        ?>

                        <p>Sadržaj uspješno dodat u kategoriju:  <?= $kategorija_clanka ?>, podkategoriju: <?= $podkategorija_clanka ?> .</p>

                        <hr>
                        <br>
                        <p><a href="<?= $_SERVER['PHP_SELF'] ?>">
                                <b> Unos novog sadržaja</b></a></p>
                        <p><a href="pretraga.php">Nazad na pretragu sadržaja</a></p>

                        <?php
                    else: // Dozvoli da korisnik unese novi sadrzaj
                        $unos = true;
                        $autori = mysqli_query($db_connection, 'SELECT ID, Ime FROM Autori');
                        $kategorije = mysqli_query($db_connection, 'SELECT * FROM clanci_kategorije');
                        $podkategorije = mysqli_query($db_connection, "SELECT * FROM clanci_podkategorije");
                        ?>

                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <h3>Naslov</h3>
                            <input type="text" name="naslov" size="50">
                            <h3>Sadržaj</h3>
                            <textarea id="vijestitext" name="textclanka" rows="25" cols="40" style="width: 100%" wrap></textarea>     
                </div>
                <div id="col2">
                    <p><h3>Pozicija članka</h3>
                    Napomena: Samo brojevi. Manji broj stavlja članak iznad.<br>
                        <input type="text" name="pozicija" size="5">
                    </p>
                    <p><h3>Autor sadržaja:</h3> 
                        <select name="aid" size="1">
                            <option selected value="">Izaberite jednu opciju</option>
                            <option value="">---------</option>
                            <?php
                                while ($autor = mysqli_fetch_array($autori, MYSQLI_BOTH)) {
                                    $aid = $autor['ID'];
                                    $aime = $autor['Ime'];
                                    echo("<option value='$aid'>$aime</option>\n");
                                }
                            ?>
                        </select>
                    </p>
                    <p><h3>Postavi u kategoriju:</h3>
                        <?php
                            while ($kategorija = mysqli_fetch_array($kategorije, MYSQLI_BOTH)) {
                                $cid = $kategorija['id_clanci_kategorije'];
                                $cime = str_replace("_", " ", $cid);
                                echo("<input type='radio' name='kategorija' value='$cid' />$cime<br />\n");
                            }
                        ?>
                    </p>
                </div>
                <div id="col3">
                    <p><h3>Postavi u podkategoriju:</h3>
                        <?php
                            while ($podkategorija = mysqli_fetch_array($podkategorije, MYSQLI_BOTH)) {
                                $pod_kat = $podkategorija['id_podkategorija'];
                                $pods_kat = str_replace("_", " ", $pod_kat);
                                echo("<input type='radio' name='podkategorija' value='$pod_kat' />$pods_kat<br />\n");
                            }
                        ?>
                    </p>
                    <p><input type="submit" name="submit" value="Pošalji" /></p>
                    </form>
                        <?php 
                        echo "PAŽNJA!!!<br>Pri unošenju dokumanata iz download sekcije ukucati url lokaciju "
            . "upisati dvotačku, zatim razmak,  pa upisati željeni naziv fajla.Za svaki sledeći dokument preći u novi red.<br>"
                                . "Primjer:<b>/pdf/rudarstvo/letak-kvarcni-pijesak.pdf: Cjenovnik - Kvarcni pijesak</b>";
                        endif; 
                         ?>
                </div>
                 <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
