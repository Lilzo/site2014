<?php

//*funkcije
function shapeClanakText($tekst_clanka) {
    if (strstr($tekst_clanka, 'img')) {
        $tekst_clanka = preg_replace("/<img[^>]+\>/i", " ", $tekst_clanka);  // izbacuje img tag iz stringa
    }
    if (strstr($tekst_clanka, "::.")) {
        $tekst_clanka = str_replace("::.", " ", $tekst_clanka);
    }
    $tekst_strip_tags = strip_tags($tekst_clanka, "<h1><h2><h3>");
    return $tekst_strip_tags;
}

function cutText($str, $length, $minword = 3) {
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word) {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length) {
            break;
        }
    }
    return $sub . (($len < strlen($str)) ? '...' : '');
}

//funckija explode
function divideBySearchwords($searchword, $stringToDivide) {

    $array = explode($searchword, $stringToDivide);
    $toShow = "";
    for ($i = 0; $i < count($array); $i++) {
        $highlightSearchword = ($i == (count($array) - 1)) ? "" : $searchword;
        if (strlen($array[0]) > 300) {
            $aray0_strip_tag = strip_tags($array[0]);
            $array0_substr = substr($aray0_strip_tag, (strlen($array[0]) - 300), 300);
            $array0_substr_word = "..." . substr(strstr($array0_substr, " "), 1);
            $array[0] = $array0_substr_word;
        }
        $toShow .= $array[$i] . $highlightSearchword;
    }
    if (strlen($toShow) > 500) {
        $toShow = substr($toShow, 0, 500);
    }
    return $toShow;
}

function rezClanak($upit, $rijeciPretrage) {
    while ($row_pretraga = mysqli_fetch_array($upit, MYSQLI_BOTH)) {
        $clanaktext = shapeClanakText($row_pretraga['clanak_text']);
        $rijeciNiz = explode(" ", $rijeciPretrage);
        foreach ($rijeciNiz as $referer) {
            $t = cutText(divideBySearchwords($referer, $clanaktext), 500);
            $tekst = trim($t);
        }
        $sektor = sektorValues($row_pretraga['sektor']);
        $tab = ($row_pretraga['tab'] == "no_tab") ? "no_tab" : $row_pretraga['tab'];
        $rijeciPretrageLink = str_replace(' ', '_', $rijeciPretrage);
        $link_pretrage = '/' . $sektor . '.php#' . $tab . '?keyword=' . $rijeciPretrageLink . '&shwprt=' . $row_pretraga['clanak_naslov'];
        $naslov_clanka = str_replace("_", " ", $row_pretraga['clanak_naslov']);
        $naslov_clanka_trim = ucfirst(trim(str_replace(range(0, 9), " ", $naslov_clanka)));

        $results_clanci[] = '<a href="' . $link_pretrage . '" >' . $naslov_clanka_trim . '</a>' . '<div id="sb">' . $tekst . '</div>' . '<hr>';
    }
    return $results_clanci;
}
function prikaziClanke($upit, $rijeciPretrage, $brojClanakaPoStrani = 5){
    $nizClanci = rezClanak($upit, $rijeciPretrage);
        $brojClanaka = count($nizClanci);
        if (filter_input(INPUT_GET, 'page') != null) {
            $i = filter_input(INPUT_GET, 'page');
        } else {
            $i = 1;
        }
        if ($brojClanaka > $brojClanakaPoStrani + 1) {

            echo splitArray($nizClanci, $brojClanakaPoStrani, $i); //$i
            echo '<div>' . paging($brojClanaka, $brojClanakaPoStrani, $i) . '</div>';
        } else {
            foreach ($nizClanci as $val) {
                echo '<div>' . $val . '</div>';
            }
        }
}


function rezNovosti($upit) {
    while ($row_pretraga_novosti = mysqli_fetch_array($upit, MYSQLI_BOTH)) {
        $naslov_novosti = $row_pretraga_novosti['Naslov'];
        $results_novosti[] = '<a href="../novosti.php?id=' . $row_pretraga_novosti['ID'] . '" >' . $naslov_novosti . '</a><br>';
    }
    return $results_novosti;
}

function prikaziNovosti($upit) {
    $nizNovosti = rezNovosti($upit);
    //   $brn = count($nizNovosti);
    echo "<div>";
    foreach ($nizNovosti as $va) {
        echo $va;
    }
    echo "</div><hr>";
}

function sektorValues($sektor) {
    switch ($sektor) {
        case "komercijalni_poslovi": $sektor = 'komercijalniposlovi';
            break;
        case "početna": $sektor = 'index';
            break;
        case "komercijalni_poslovi": $sektor = 'komercijalniposlovi';
            break;
        case "saobraćaj": $sektor = 'saobracaj';
            break;
        case "gradnja_el_mašinstvo": $sektor = 'gradjevinarstvo';
            break;
        case "proizvodnja_hrane": $sektor = 'proizvodnjahrane';
            break;
        case "profitni_centri": $sektor = 'profitnicentri';
            break;
    }
    return $sektor;
}

function splitArray($niz, $duzina, $i = 1) {
    $a = $i - 1;
    $nizChunk = array_chunk($niz, $duzina);
    foreach ($nizChunk[$a] as $val) {
        echo $val;
    }
}

function paging($broj, $brojPoStrani, $i = 1) {
    $brojStrana = ceil($broj / $brojPoStrani);
    $keyword = filter_input(INPUT_GET, 'keyword');
    echo '<div id="pagination"> ';
    if ($i > 1) {
        echo '<form method = "get" action = "">
    <input type = "hidden" name="keyword" value="' . $keyword . '">
    <input type = "hidden" name = "page" value = "' . ($i - 1) . '">
    <input type = "submit"  value = "&#8647;">
    </form>';
    }
    echo $i . ' od ' . $brojStrana;
    if ($i < $brojStrana) {
        echo '<form method = "get" action = "">
    <input type = "hidden" name="keyword" value="' . $keyword . '">
    <input type = "hidden" name = "page" value = "' . ($i + 1) . '">
    <input type = "submit"  value = "&#8649;">
    </form>';
    }
    echo '</div>';
}

include('../php_otv_baze.inc');

$rijeciPretrage = preg_replace('/[^A-Za-z0-9šŠđĐžŽčČćĆ\-]/', ' ', filter_input(INPUT_GET, 'keyword'));
if (isset($rijeciPretrage)) {
    $rijeciPretrage = trim($rijeciPretrage);
    $pretraga_upit = "SELECT clanci.clanak_naslov, clanci.clanak_text, clanci.sektor, clanci.tab,
                    MATCH(clanak_naslov, clanak_text, tab) AGAINST ('%$rijeciPretrage%') as score
                    FROM clanci
                    WHERE MATCH(clanak_naslov, clanak_text, tab) AGAINST ('%$rijeciPretrage%')
                    ORDER BY score DESC "; //VijestiText LIKE '%$rijeciPretrage%' AND LIMIT 0,40
    $pretraga_novosti = "SELECT ID, VijestiText, VijestiDatum, Naslov, 
                    MATCH (Naslov, VijestiText) AGAINST ('%$rijeciPretrage%') as score
                    FROM vijesti
                    WHERE MATCH (VijestiText, Naslov) AGAINST ('%$rijeciPretrage')
                    ORDER BY score DESC";
    $vrijednostiPretrage = explode(' ', $rijeciPretrage);
    $vrijednosti[] = $vrijednostiPretrage[0];

    $query_pretraga = mysqli_query($db_connection, $pretraga_upit);
    $query_pretraga_novosti = mysqli_query($db_connection, $pretraga_novosti);

    if (!$query_pretraga) {
        die('<p>Ne mogu da otvorim bazu.<br />' .
                'Error: ' . mysqli_error($db_connection) . '</p>');
    }
    if (!$query_pretraga_novosti) {
        die('Greška pretraga novosti. ERROR: ' . mysqli_error($db_connection));
    }

    $redni_broj = 0;
    $broj_clanaka = mysqli_num_rows($query_pretraga);
    $broj_novosti = mysqli_num_rows($query_pretraga_novosti);
    $broj_rezultata = $broj_clanaka + $broj_novosti;

    /* Forma pretrage na stranici */
    if ($rijeciPretrage) {
        $placeholder = $rijeciPretrage;
        $rez_br_text = '<div id="pretraga-spec">Rezultati pretrage za pojam:
            <span>"' . $rijeciPretrage . '"</span>
            ima ukupno<span>' . $broj_rezultata . '</span> rezultata.
            </div>';
    } else {
        $placeholder = "Pretraga";
        $rez_br_text = "";
    }

    echo '<form id = "pretraga" name = "pretraga" method = "get">
            <input id = "search-input" placeholder ="' . $placeholder . '"type = "text" name = "keyword">
            <input id = "submit-search" type = "submit" value = "Pretraži">
          </form>';
    echo $rez_br_text;

    /* Prikazivanje rezultata */
    /* ako ima i članaka i novosti */
    if (($broj_clanaka != 0) && ($broj_novosti != 0)) {
        if ((filter_input(INPUT_GET, 'page') == null) || (filter_input(INPUT_GET, 'page') == 1)) {
            prikaziNovosti($query_pretraga_novosti);
        }
        prikaziClanke($query_pretraga, $rijeciPretrage,10);
    } /* ako su samo članci */ 
    elseif (($broj_novosti == 0) && ($broj_clanaka != 0)) {
        prikaziClanke($query_pretraga, $rijeciPretrage,10);
    } /* ako su samo novosti */
    elseif (($broj_novosti != 0) && ($broj_clanaka == 0)) {
        prikaziNovosti($query_pretraga_novosti);
    }
}
?>