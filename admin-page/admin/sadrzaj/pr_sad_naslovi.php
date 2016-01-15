<?php
if (session_id() == '') {
    session_start();
}
include '../auth.php';
?>
<?php
$aid = filter_input(INPUT_POST, 'aid');
if ($aid != '') { // Autor je selektovan
    $where .= " AND AID='$aid'";
}

$where = "WHERE 1=1";
$kategorija = filter_input(INPUT_POST, 'kategorija');
if ($kategorija != '') {
    $where .= " AND sektor = '$kategorija' ";
}

$podkategorija = filter_input(INPUT_POST, 'podkategorija');
if ($podkategorija != '') {
    $where .= " AND tab = '$podkategorija' ";
}

$pretrazitekst = $_POST['pretrazitekst'];
if ($pretrazitekst != '') { //  search text je postavljen
    $tekst_naslov = str_replace(" ", "_", $pretrazitekst);
    $where .= " AND (clanak_naslov LIKE '%$pretrazitekst%' OR clanak_naslov LIKE '%$tekst_naslov%') OR clanak_text LIKE '%$pretrazitekst%' ";
        //    . "AND ";
}
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
                    <h1>Rezultati pretrage</h1>
                </div>
                <div id="gutter"></div>
                <div>
                    NAPOMENA:
                    Klikom na opciju izbriši trajno brišete sadržaj iz sistema. Prethodno 
                    nećete biti upozoreni.<br>
                    <table>
                    <?php
                    $select = "SELECT * ";
                    $from = "FROM clanci ";
                    $upit = $select . $from . $where;

                    $clanci_query = mysqli_query($db_connection, $upit);

                    if (!$clanci_query) {
                        echo('</table>');
                        die('<p>Greška prilikom kontaktiranja sadržaja iz baze !!<br />' .
                                'Error: ' . mysqli_error($db_connection) . '</p>');
                    }
                    $r_br =1;
                    while ($clanak_show = mysqli_fetch_array($clanci_query, MYSQLI_BOTH)) {

                        $id = $clanak_show['id_clanak'];
                        $html_clanak = $clanak_show['clanak_text'];
                        $tekst_clanka = substr(htmlspecialchars($html_clanak), 0, 600);
                        $naslov_clanka = str_replace("_"," ",$clanak_show['clanak_naslov']);
                        $pozicija = $clanak_show['pozicija'];

                        if (strlen($tekst_clanka) == 600)
                            $tekst_clanka .= "...";
                        
                        if($r_br % 2 == 1) echo "<tr>";
                        echo '<td><div id ="pretraga-rezultati">';
                        echo $r_br++ .'. <span>' . $naslov_clanka . '</span>' .' [ Pozicija na strani: '.$pozicija .' ]';
                        echo '<p>' . $tekst_clanka . '</p>';
                        echo"<div> [ <a href='uredi_sadrzaj.php?id=$id'> Uredi</a> |" .
                        "<a href='izbrisi_sadrzaj.php?id=$id'> Izbriši</font></a> ]</div>";
                        echo '</div></td>';
                        if($r_br % 2 == 1) echo "</tr>";
                    }
                    ?>
                    </table>
                </div>
                 <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
