<div class="poglavlja">
    <a href="/novosti.php">
        <div>
            <h3>NOVOSTI </h3>
            <img class="ikonica" src="/img/icons/news_round2.png" title="Novosti" alt="Novosti"> 
        </div>
    </a>
    <div id="news-container"> 
        <ul>
            <?php
            function brze_vijesti($stringBV, $brojacRijeci) {
                return implode(
                        '', array_slice(
                                preg_split(
                                        '/([\s,\.;\?\!]+)/', $stringBV, $brojacRijeci * 2 + 1, PREG_SPLIT_DELIM_CAPTURE
                                ), 0, $brojacRijeci * 2 - 1
                        )
                );
            }

	$brzeVijestiQuery  = "SELECT ID, LEFT(vijestitext,500), naslov, AID," .
                 "DATE_FORMAT(vijestidatum, '%d.%m.%Y.') as formated_date " .
                 "FROM vijesti  WHERE (naslov LIKE '%201%' OR naslov LIKE '%2009%') ORDER BY ID DESC LIMIT 0,5";

            $brzeVijesti = mysqli_query($db_connection, $brzeVijestiQuery) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error(), E_USER_ERROR);

            while ($jokeBV = mysqli_fetch_array($brzeVijesti, MYSQLI_BOTH)) {
                $id = $jokeBV['ID'];
                $ntBV = strip_tags($jokeBV['LEFT(vijestitext,500)']);

                $brojPrikazanihRijeci = 18;
                $newstextBV = brze_vijesti($ntBV, $brojPrikazanihRijeci);  //get snippet funkcija za prikazivanje odredjenog broja riječi stringa
                $newstextBV.= "..."; //dodavanje tačaka na kraju stringa 	

                $naslovBV = $jokeBV['naslov'];
                echo"<li><hr><span id=\"naslov-poglavlje\">
                    <a href=\"/novosti.php?id=$id\">"
                . $naslovBV
                . "</a></span><span id=\"novosti-poglavlje\">"
                . $newstextBV
                . "<a id=\"opsirnije\" style=\"float:right\" href=\"/novosti.php?id=$id\">
                      opširnije</a></span></li>";
            }
            ?>
        </ul>
    </div>
    <hr>
</div>
