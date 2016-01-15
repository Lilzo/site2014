<?php

if (isset($_GET['sveVijesti']) && ($_GET['sveVijesti'] == 'ok')) {
    $sveNovosti = 50;
    if (isset($_GET['br'])) {
        if ($_GET['br'] < 250) {
            $sveNovosti += $_GET['br'];
        } else {
            $sveNovosti = 250;
        }
    }
} else {
    $sveNovosti = 5;
}

function citava_rijec($str, $wordCount) {
    return implode(
            '', array_slice(
                    preg_split(
                            '/([\s,\.;\?\!]+)/', $str, $wordCount * 2 + 1, PREG_SPLIT_DELIM_CAPTURE
                    ), 0, $wordCount * 2 - 1
            )
    );
}

$novosti_upit = "SELECT ID, LEFT(vijestitext,650), naslov, AID," .
        "DATE_FORMAT(vijestidatum, '%d.%m.%Y.') as formated_date " .
        "FROM vijesti  WHERE (naslov LIKE '%201%' OR naslov LIKE '%2009%') ORDER BY ID DESC LIMIT 0,{$sveNovosti}";



$novosti_query = mysqli_query($db_connection, $novosti_upit);

if (!$novosti_query) {
    echo('</table>');
    die('<p>Ne mogu prikazati novosti!<br />' .
            'Error: ' . mysql_error() . '</p>');
}

while ($joke = mysqli_fetch_array($novosti_query, MYSQLI_BOTH)) {

    $id = $joke['ID'];
    $newstext = $joke['LEFT(vijestitext,650)'];
    $prikazati_broj_rijeci = 70;

    //$newstext= truncate($newstext,"$prikazati_broj_rijeci");
    $newstext = citava_rijec($newstext, "$prikazati_broj_rijeci");

    if (str_word_count("$newstext") > $prikazati_broj_rijeci) {
        $newstext .= "...";
    }
    $naslov = $joke['naslov'];
    $jdate = $joke['formated_date'];

    echo("<h2>$naslov</h2>");
    echo("$newstext<br><a id=\"opsirnije\" href=\"?id=$id\"> opširnije</a></p><hr>");
}

echo("<a href=\"/novosti.php?sveVijesti=ok&br=$sveNovosti\">Starije vijesti </p>");
?>