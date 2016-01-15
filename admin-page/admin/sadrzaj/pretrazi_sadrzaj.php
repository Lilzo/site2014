<?php
$autori_query ="SELECT ID, Ime FROM Autori";
$autori = mysqli_query($db_connection, $autori_query);
$kategorije_clanaka_query ="SELECT id_clanci_kategorije FROM clanci_kategorije";
$kategorije_clanaka = mysqli_query($db_connection, $kategorije_clanaka_query);
$podkategorije_clanaka_query ="SELECT * FROM clanci_podkategorije";
$podkategorije_clanaka = mysqli_query($db_connection, $podkategorije_clanaka_query);
?>
<form action="pr_sad_naslovi.php" method="post">
    Autori:
    <select name="aid" size="1">
        <option selected value="">Svi autori</option>
        <?php
        while ($autor = mysqli_fetch_array($autori, MYSQLI_BOTH)) {
            $aid = $autor['ID'];
            $aime = $autor['Ime'];
            echo("<option value='$aid'>$aime</option>\n");
        }
        ?>
    </select>
        <select name="kategorija">
        <option value=""> Kategorija:</option>
            <?php
             while($kategorija_clanka = mysqli_fetch_array($kategorije_clanaka, MYSQLI_BOTH)){
                 $kat_cla=  $kategorija_clanka['id_clanci_kategorije'];
                 echo '<option value ="' .$kat_cla .'">' .$kat_cla .'</option>';
            }
            ?>
    </select>
    <select name="podkategorija">
        <option value=""> Podkategorija:</option>
       <?php
        while($podkategorija_clanka = mysqli_fetch_array($podkategorije_clanaka, MYSQLI_BOTH)){
            $podkat_cla=  $podkategorija_clanka['id_podkategorija'];
            $nas_podkat = str_replace("_", " ", $podkat_cla);
            echo '<option value ="' .$podkat_cla .'">' .$nas_podkat .'</option>';
       }
       ?>
    </select>
        <br><br>
    Pretraži:
    <input type="text" name="pretrazitekst" />
    <input type="submit" name="submit" value="Pretraži" />
</form>
