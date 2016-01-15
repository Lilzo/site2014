<?php

$gradjevinarstvo = array
    (
    "<img src=\"/images/baner/gradjevinarstvo/panorama.gif\">",
    "<img src=\"/images/baner/gradjevinarstvo/gradjevina.gif\">",
    "<img src=\"/images/baner/gradjevinarstvo/masinstvo.gif\">",
    "<img src=\"/images/baner/gradjevinarstvo/elektro.gif\">"
);

$drvoprerada = array
    (
    "<img src=\"/images/baner/drvoprerada/panorama.gif\">",
	"<img src=\"/images/baner/drvoprerada/kreveti.gif\">",
    "<img src=\"/images/baner/drvoprerada/primarna-prerada2.gif\">",
    "<img src=\"/images/baner/drvoprerada/primarna-prerada.gif\">",
    "<img src=\"/images/baner/drvoprerada/masivne-ploce.gif\">",
    "<img src=\"/images/baner/drvoprerada/zvona.gif\">",
	"<img src=\"/images/baner/drvoprerada/proizvodi.gif\">"
);

$komercijalniposlovi = array
    (
    "<img src=\"/images/baner/komercijalni_poslovi/masine1.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/masine2.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/masine3.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/masine4.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/masine5.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/front-page.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/masine9.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/agregati.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/roba.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/gume.gif\">",
    "<img src=\"/images/baner/komercijalni_poslovi/papirna-ambalaza.gif\">"
);

$proizvodnjahrane = array
    (
    "<img src=\"/images/baner/proizvodnja_hrane/panorama.gif\">",
    "<img src=\"/images/baner/proizvodnja_hrane/jaja.gif\">",
    "<img src=\"/images/baner/proizvodnja_hrane/jaja2.gif\">"
);

$rudarstvo = array
    (
    "<img src=\"/images/baner/rudarstvo/rudarstvo_baner.gif\">",
    "<img src=\"/images/baner/rudarstvo/rudarstvo_baner1.gif\">",
    "<img src=\"/images/baner/rudarstvo/rudarstvo_baner2.gif\">",
    "<img src=\"/images/baner/rudarstvo/rudarstvo_baner3.gif\">",
    "<img src=\"/images/baner/rudarstvo/rudarstvo_baner5.gif\">"
);
$saobracaj = array
    (
    "<img src=\"/images/baner/saobracaj/panorama.gif\">",
    "<img src=\"/images/baner/saobracaj/kamioni.gif\">",
    "<img src=\"/images/baner/saobracaj/front.gif\">",
    "<img src=\"/images/baner/saobracaj/autobuska.gif\">",
    "<img src=\"/images/baner/saobracaj/autobus.gif\">",
    "<img src=\"/images/baner/saobracaj/odrzavanje.gif\">",
    "<img src=\"/images/baner/saobracaj/gume.gif\">"
);

$ugostiteljstvo = array
    (
    "<img src=\"/images/baner/ugostiteljstvo/bungalovi-baner.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/fitnes-baner.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/kiperi-baner.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/motel-baner.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/motel2-baner.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/restoran-baner.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/motel-panorama.gif\">",
    "<img src=\"/images/baner/ugostiteljstvo/spomenik-baner.gif\">"
);

$podrazumjevaniBaneri = array
    (
    "<a href=\"/rudarstvo.php\"><img src=\"/images/baner/rudarstvo/rudarstvo_baner.gif\" title=\"Rudarstvo\"></a>",
    "<a href=\"/saobracaj.php\"><img src=\"/images/baner/saobracaj/front.gif\" title=\"Saobraćaj\"></a>",
    "<a href=\"/gradjevinarstvo.php\"><img src=\"/images/baner/gradjevinarstvo/toranj-gradnja.gif\" title=\"Gradnja i elektro-mašinska proizvodnja\"></a>",
    "<a href=\"/ugostiteljstvo.php\"><img src=\"/images/baner/ugostiteljstvo/motel-panorama.gif\"  title=\"Ugostiteljstvo i turizam\"></a>",
    "<a href=\"/komercijalniposlovi.php\"><img src=\"/images/baner/komercijalni_poslovi/front-page.gif\" title=\"Komercijalno-proizvodni poslovi\"></a>",
    "<a href=\"/proizvodnjahrane.php\"><img src=\"/images/baner/proizvodnja_hrane/hrana-front.gif\" title=\"Proizvodnja hrane\"></a>",
    "<a href=\"/drvoprerada.php\"><img src=\"/images/baner/drvoprerada/panorama.gif\" title=\"Drvoprerada\"></a>",
	 "<a href=\"/drvoprerada.php\"><img src=\"/images/baner/drvoprerada/kreveti.gif\" title=\"Drvoprerada\"></a>"
	    
);

switch ($lokacija) {
    case "/drvoprerada.php":
        $baner = $drvoprerada;
        break;
    case "/gradjevinarstvo.php":
        $baner = $gradjevinarstvo;
        break;
    case "/komercijalniposlovi.php":
        $baner = $komercijalniposlovi;
        break;
    case "/proizvodnjahrane.php":
        $baner = $proizvodnjahrane;
        break;
    case "/rudarstvo.php":
        $baner = $rudarstvo;
        break;
    case "/ugostiteljstvo.php":
        $baner = $ugostiteljstvo;
        break;
    case "/saobracaj.php":
        $baner = $saobracaj;
        break;
    default:
        $baner = $podrazumjevaniBaneri;
}
?>