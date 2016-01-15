<?php
$proizvod_query ="SELECT * FROM php_product";
$proizvodi = mysqli_query($db_connection, $proizvod_query);
?>
<form action="proizvodi_gro.php" method="post">
        <select name="proizvod">
            <?php
             while($proizvod = mysqli_fetch_array($proizvodi, MYSQLI_BOTH)){
                 $id_pro =  $proizvod['ProductID'];
                 $name_pro = $proizvod['ProductName'];
                 echo '<option value ="' .$id_pro .'">' .$name_pro .'</option>';
            }
            ?>
    </select>
    Pretraži:
    <input type="text" name="pretrazitekst" />
    Datum:
    <input type="text" name="datum" />
    <input type="submit" name="submit" value="Pretraži" />
</form>
