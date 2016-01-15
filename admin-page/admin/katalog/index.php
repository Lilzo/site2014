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
            <?php include_once '../inc/inc_meni_katalog.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Katalog Proizvoda</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Pretraga proizvoda</h2>
                    <?php
                    $izabrana_kategorija = filter_input(INPUT_POST, 'izabrana_kategorija');
                    $izabrani_proizvod = filter_input(INPUT_POST, 'proizvod');

                    $where_pro = " WHERE 1=1";
                    if (isset($izabrana_kategorija) && ($izabrana_kategorija != '')) {
                        $where_pro = " WHERE php_product_categories.CategoryID = '$izabrana_kategorija'";
                    }
                    
                    if ($izabrana_kategorija == 'sve')  {
                        $where_pro = " WHERE 1= 1";
                    }
                    

                    $proizvod_query = "SELECT * FROM php_product";
                    if (($izabrana_kategorija != 'sve') && ($izabrana_kategorija != null)) {
                        $proizvod_query = "SELECT * FROM php_product INNER JOIN php_product_categories ON 
                                        php_product.ProductID = php_product_categories.ProductID" . $where_pro;
                    }
                    //echo $proizvod_query;
                    $proizvodi = mysqli_query($db_connection, $proizvod_query);
                    $query_kat = "SELECT * FROM php_categories";
                    $chose_cat = mysqli_query($db_connection, $query_kat) or die(mysqli_error($db_connection));
                    ?>
                    <p>
                    <form id ="pretraga-proizvoda" name="chose_product" method ="post">
                        <?php
                        //select kategoriju
                        echo '<select id="chose-category" name="izabrana_kategorija" onchange="this.form.submit();" >'
                        . '<option value="sve">Svi proizvodi</option>';
                        while ($kats = mysqli_fetch_array($chose_cat)) {
                            if ($kats['CategoryID'] == $izabrana_kategorija) {
                                echo '<option value="' . $kats['CategoryID'] . '" selected>' . $kats['CategoryName'] . '</option>';
                            } else {
                                echo '<option value="' . $kats['CategoryID'] . '">' . $kats['CategoryName'] . '</option>';
                            }
                        }
                        echo '</select>';
                        ?>
                        <select name="proizvod"  onchange="this.form.submit();">
                            <option value="">Proizvod</option>
                            <?php
                            while ($proizvod = mysqli_fetch_array($proizvodi, MYSQLI_BOTH)) {
                                $id_pro = $proizvod['ProductID'];
                                $name_pro = $proizvod['ProductName'];
                                if ($id_pro == $izabrani_proizvod) {
                                    echo '<option value ="' . $id_pro . '" selected>' . $name_pro . '</option>';
                                } else {
                                    echo '<option value ="' . $id_pro . '">' . $name_pro . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </form>
                    </p>
                    <form action="proizvodi_gro.php" method="post">
                        <p>
                            Pretraži:
                            <input type="hidden" name="kategorija" value="<?= $izabrana_kategorija ?>">
                            <input type="hidden" name="proizvod" value="<?= $izabrani_proizvod ?>">
                            <input type="text" name="pretrazitekst" />
                            <input type="submit" name="submit" value="Pretraži" />
                        </p>
                    </form>

                </div>
                <div id="col1">
                    <h2><a href="novi_proizvod.php">Unos novog proizvoda</a></h2>
                    <h2><a href="proizvod_kategorija.php">Proizvod u kategoriji</a></h2>
                </div>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>