<?php
$autori_query ="SELECT ID, Ime FROM Autori";
$autori = mysqli_query($db_connection, $autori_query);
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
    </select><br><br>
  
    Pretraži:
    <input type="text" name="pretrazitekst" />
    Datum:
    <input type="text" name="datum" />
    <input type="submit" name="submit" value="Pretraži" />
</form>
