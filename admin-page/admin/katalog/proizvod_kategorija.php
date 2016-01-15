<?php
if (session_id() == '') {
    session_start();
}
include '../auth.php';
include_once 'proizvod_kategorija_funkcije.php';

$izabrani_proizvod = filter_input(INPUT_GET, 'proizvod');
$kategorije_izabranog_proizvoda = kategorije_izabranog_proizvoda($izabrani_proizvod, $db_connection);
////$kategorije_iz_baze_i_selektovane = $kategorije_izabranog_proizvoda;
$submited = filter_input(INPUT_POST, 'submited');

if (!isset($_SESSION['cekirane_kategorije']) || ($_SESSION['cekirane_kategorije'] == false)) {
    $checked_category = $kategorije_izabranog_proizvoda;
    if (empty($kategorije_izabranog_proizvoda)) {
        $checked_category = array();
    }
}

//$checked_category = array();
if (isset($_POST['checked_cat'])) {
    $checked_category = $_POST['checked_cat'];
    $_SESSION['cekirane_kategorije'] = true;
} else {
    $_SESSION['cekirane_kategorije'] = false;
}

if (isset($submited)) {
    if (!($_SESSION['cekirane_kategorije']) && empty($_POST['checked_cat'])) {
        izbrisati_proizvod_iz_zadnje_kategorije($izabrani_proizvod, $db_connection);
        $_SESSION['cekirane_kategorije'] == false;
        $checked_category = array();
    } else {
        foreach ($checked_category as $chekd_cat) {
            dodati_proizvod_u_kategoriju($izabrani_proizvod, $chekd_cat, $db_connection);
        }
        $unchecked_category = array_diff($kategorije_izabranog_proizvoda, $checked_category);
        foreach ($unchecked_category as $unch) {
            izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $unch, $db_connection);
        }
    }
    $_SESSION['cekirane_kategorije'] == false;
}

$imena_kategorija_upit = "SELECT * FROM php_category_names";
$kategorije_upit = "SELECT CategoryType, CategoryID, Subcategory 
                    FROM php_categories 
                    GROUP BY CategoryType, CategoryID, Subcategory 
                    ORDER BY CategoryType, CategoryID, Subcategory";

$kategorije_group_by = mysqli_query($db_connection, $kategorije_upit)or die(mysqli_error($db_connection));
$imena_upit = mysqli_query($db_connection, $imena_kategorija_upit);

while ($kats = mysqli_fetch_array($kategorije_group_by)) {
    $nadkategorija = $kats[0];
    $kategorija = $kats[1];
    $podkategorija = $kats[2];
    $glavne[] = array($nadkategorija, $kategorija, $podkategorija);
}
while ($imena = mysqli_fetch_array($imena_upit)) {
    $ime_id[$imena['CategoryID']] = $imena['CategoryName'];
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
            <?php
            include_once '../inc/inc_meni_katalog.php';
            ?>
            <div id="sample14">
                <div id="header">
                    <h1>Proizvodi i kategorije</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Kategorije </h2>
                    <br>
					<?php
					  $upit_proizvodi = "SELECT * FROM php_product";
						 $query_prod_sql = mysqli_query($db_connection, $upit_proizvodi) or die(mysqli_error($db_connection));
						 while ($products = mysqli_fetch_array($query_prod_sql)) {
							$niz_prod[]= array($products['ProductID'] => $products['ProductName']);
						}
						?>
                    <form id ="pretraga-proizvoda" name="chose_product" method ="get">
                        <select name="proizvod" onchange="this.form.submit()">
                            <option value="">Proizvod</option>
                            <?php
                            //$niz_proizvoda = niz_prod;
                            foreach ($niz_prod as $niz) {
                                foreach ($niz as $id => $name) {
                                    $selected = ($id == $izabrani_proizvod) ? 'selected' : '';
                                    echo '<option value = "' . $id . '"' . $selected . ' >' . $name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </form> 
                    <br>
                    <form method="post" action="proizvod_kategorija.php?proizvod=<?= $izabrani_proizvod ?>" id="submit_kat">
                        <?php
//                        $merged_array = array_merge($checked_category, $kategorije_izabranog_proizvoda);
//                        if (empty($checked_category)) {
//                            $checked_category = array();
//                        }
                        @echo_select($glavne, $ime_id, $checked_category);
                        ?>
                        <input type="hidden" name="submited" value="ok">
                    </form>
                </div>
                <div id="col1">
                    <h2><a href="novi_proizvod.php">Novi proizvod</a></h2>
                    <h2><a href="kategorije.php">Kategorije</a></h2><br>
                    <h3>Nekategorisani proizvodi</h3>
                    <?php
                    $proizvodi_nekategorisani = mysqli_query($db_connection, "SELECT * FROM php_product as a "
                            . "WHERE a.ProductID  NOT IN (SELECT ProductID FROM php_product_categories) ")or die(mysqli_error($db_connection));
                    while ($row = mysqli_fetch_array($proizvodi_nekategorisani)) {
                        $nekategorisani_proizvodi [] = $row['ProductName'];
                    }
                    foreach ($nekategorisani_proizvodi as $value) {
                        echo $value . '<br>';
                    }
                    ?>
                </div>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
