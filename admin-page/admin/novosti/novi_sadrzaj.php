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
                    <h1>Nova vijest</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2><a href="/cmsys/admin/sadrzaj/novi_sadrzaj.php">Unos nove vijesti</a></h2>
                    <?php
                    $submited = filter_input(INPUT_POST, 'submit');
                    if (isset($submited)):
                        // novi sadrzaj je dodat
                        // koristenjem donje forme
                        $author_id = filter_input(INPUT_POST, 'aid');
                        $naslov_clanka = filter_input(INPUT_POST, 'naslov');
                        $text_clanka = filter_input(INPUT_POST, 'textclanka');

                        if ($author_id == '') {
                            die('<p>Morate izabrati izvor(autor) ' .
                                    'za ovaj sadrzaj. Kliknite na "Back" ' .
                                    'i pokusajte ponovo.</p>');
                        }

                        $novi_clanak_upit = "INSERT INTO vijesti SET
                        ID = '',
                        Naslov ='$naslov_clanka',
                        VijestiText='$text_clanka',
                        VijestiDatum = now(),
                        AID = '$author_id'";
                        if (mysqli_query($db_connection, $novi_clanak_upit)) {
                            echo('<p>Novi sadržaj uspješno dodat !</p>');
                        } else {
                            die('<p>Greška prilikom dodavanja novog sadržaja: ' .
                                    mysqli_error($db_connection) . '</p>');
                        }

                        $jid = mysql_insert_id();
                        ?>

                        <p>Sadržaj uspješno dodat.</p>

                        <hr>
                        <br>
                        <p><a href="<?= $_SERVER['PHP_SELF'] ?>">
                                <b> Unos novog sadržaja</b></a></p>
                        <p><a href="pretraga.php">Nazad na pretragu sadržaja</a></p>

                        <?php
                    else: // Dozvoli da korisnik unese novi sadrzaj
                        $unos = true;
                        $autori = mysqli_query($db_connection, 'SELECT ID, Ime FROM Autori');
                       ?>

                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <h3>Naslov</h3>
                            <input type="text" name="naslov" size="50">
                            <h3>Sadržaj</h3>
                            <textarea id="vijestitext" name="textclanka" rows="25" cols="40" style="width: 100%" wrap></textarea>     
                </div>
                <div id="col1">
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
                    <p><input type="submit" name="submit" value="Pošalji" /></p>
                    </form>
                        <?php endif; ?>
                </div>
                 <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
