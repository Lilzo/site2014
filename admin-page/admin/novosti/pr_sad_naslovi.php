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
if (isset($_POST['pretrazitekst'])) {
    $pretrazitekst = $_POST['pretrazitekst'];
    if ($pretrazitekst != '') { //  search text je postavljen
        $where .= " AND (Naslov LIKE '%$pretrazitekst%' OR VijestiText LIKE '%$pretrazitekst%' )";
        //    . "AND ";
    }
}
if (isset($_GET['id'])) {
    $id_news_delete = $_GET['id'];
    $remove_news = mysqli_query($db_connection, "DELETE FROM vijesti WHERE ID = '$id_news_delete'");
    $erased = true;
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
				 <?php
                if (isset($erased) && $erased) {
                    echo '<div><h2>Željena vijest je izbrisana!</h2></div><br>';
                }
                ?>
                <div id="gutter"></div>
                <div>
                    NAPOMENA:
                    Klikom na opciju izbriši trajno brišete sadržaj iz sistema. Prethodno 
                    nećete biti upozoreni.<br>
                    <table>
                    <?php
                    $select = "SELECT * ";
                    $from = "FROM vijesti ";
                    $upit = $select . $from . $where;

                    $clanci_query = mysqli_query($db_connection, $upit);

                    if (!$clanci_query) {
                        echo('</table>');
                        die('<p>Greška prilikom kontaktiranja sadržaja iz baze !!<br />' .
                                'Error: ' . mysqli_error($db_connection) . '</p>');
                    }
                    $r_br =1;
                    while ($clanak_show = mysqli_fetch_array($clanci_query, MYSQLI_BOTH)) {

                        $id = $clanak_show['ID'];
                        $html_clanak = $clanak_show['VijestiText'];
                        $tekst_clanka = substr(htmlspecialchars($html_clanak), 0, 600);
                        $naslov_clanka = str_replace("_"," ",$clanak_show['Naslov']);
                        $datum = $clanak_show['VijestiDatum'];

                        if (strlen($tekst_clanka) == 600)
                            $tekst_clanka .= "...";
                        
                        if($r_br % 2 == 1) echo "<tr>";
                        echo '<td><div id ="pretraga-rezultati">';
                        echo $r_br++ .'. <span>' . $naslov_clanka . '</span>' .' [ Datum: '.$datum .' ]';
                        echo '<p>' . $tekst_clanka . '</p>';
                        echo"<div> [ <a href='uredi_sadrzaj.php?id=$id'> Uredi</a> |" .
                         "<a href='pr_sad_naslovi.php?id=$id'> Izbriši</font></a> ]</div>";
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
