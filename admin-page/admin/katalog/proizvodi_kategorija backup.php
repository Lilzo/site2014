<?php
if (session_id() == '') {
    session_start();
}
include '../auth.php';
$izabrani_proizvod = filter_input(INPUT_GET, 'proizvod');
$kategorije = mysqli_query($db_connection, "SELECT * FROM php_categories");

$proizvod_je_izabran = false;
if ($izabrani_proizvod != null) {
    $proizvod_je_izabran = true;
}
$submited = filter_input(INPUT_GET, 'submited');
$unos_uspjesan = false;

if (isset($submited)) {
    $izabrane_kategorije = $_GET['input_kat'];

    function dodati_proizvod_u_kategoriju($proizvod, $kategorija, $db_con) {
        $check_prod_cat_in_db = mysqli_query($db_con, "SELECT * FROM php_product_categories WHERE ProductID = '$proizvod' and CategoryID = '$kategorija'");
        if (mysqli_num_rows($check_prod_cat_in_db) == NULL) {
            mysqli_query($db_con, "INSERT INTO php_product_categories (ProductCategoryID, ProductID, CategoryID)
            VALUES ('', '$proizvod', '$kategorija')") or die("Error: " . mysqli_error($db_con));
        }
    }

    function podkategorije($glavna_kategorija, $db_con) {
        $q_podkat = mysqli_query($db_con, "SELECT CategoryID FROM php_categories WHERE ParentCategory = '$glavna_kategorija'");
        while ($pk = mysqli_fetch_array($q_podkat)) {
            $podkategorije_izabranog_proizvoda[] = $pk['CategoryID'];
        }
        return $podkategorije_izabranog_proizvoda;
    }

    function nadkategorije($kategorija, $db_con) {
        $q_nadkat = mysqli_query($db_con, "SELECT ParentCategory FROM php_categories WHERE CategoryID = '$kategorija'");
        while ($nk = mysqli_fetch_array($q_nadkat)) {
            $nadkategorija_izabranog_proizvoda[] = $nk['ParentCategory'];
        }
        return $nadkategorija_izabranog_proizvoda;
    }

    function izbrisati_proizvod_iz_kategorije($proizvod, $kategorija, $db_con) {
        mysqli_query($db_con, "DELETE FROM php_product_categories
            WHERE ProductID = '$proizvod' AND CategoryID = '$kategorija'")
                or die("Error: " . mysqli_error($db_con));
    }
    

      
    foreach ($izabrane_kategorije as $kat => $val) {
        if ($val == '0') {
            izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $kat, $db_connection);
        } else {
            dodati_proizvod_u_kategoriju($izabrani_proizvod, $kat, $db_connection);
        }
    }

//    foreach ($kategorije_za_brisati as $kzb) {
//      izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $kat, $db_connection);
//    }
//    if (isset($kategorije_za_dodati)) {
//        
//    }

    unset($_GET['input_kat']);
    $sub_message = true;
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
            <?php include_once '../inc/inc_meni_katalog.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Proizvodi i kategorije</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Kategorije </h2>
                    <br>
                    <?php
                    $proizvod_query = "SELECT * FROM php_product";
                    $proizvodi = mysqli_query($db_connection, $proizvod_query);
                    ?>
                    <form method="get">
                        <select name="proizvod" onchange="this.form.submit()">
                            <option value="">Proizvod</option>
                            <?php
                            while ($prod = mysqli_fetch_array($proizvodi, MYSQLI_BOTH)) {
                                $id_pro = $prod['ProductID'];
                                $name_pro = $prod['ProductName'];
                                $sel = '';
                                if (($proizvod_je_izabran) && ($izabrani_proizvod == $id_pro)) {
                                    $sel = "selected ";
                                }
                                echo '<option value ="' . $id_pro . '"' . $sel . '>' . $name_pro . '</option>';
                            }
                            ?>
                        </select>
                    </form> 
                    <br>
                    <?php
                    if (isset($sub_message)) {
                        echo 'Uspješno ste dodali/promjenili kategorije proizvoda!<br>';
                    }
                    if ($izabrani_proizvod != null) {
                        $kat_iz_pro = mysqli_query($db_connection, "SELECT * FROM php_product_categories WHERE  ProductID = '$izabrani_proizvod'");
                        $num_kat = mysqli_num_rows($kat_iz_pro);

                        while ($kp = mysqli_fetch_array($kat_iz_pro)) {
                            $niz_kategorija_izab_proizvoda[] = $kp['CategoryID'];
                        }

                        while ($k = mysqli_fetch_array($kategorije)) {
                            if (($k['ParentCategory'] == '') || ($k['ParentCategory'] == NULL)) {
                                $niz_glavnih_kategorija [] = array($k['CategoryID'] => $k['CategoryName']);
                            }
                        }

                        foreach ($niz_glavnih_kategorija as $glavne_kategorije) {
                            foreach ($glavne_kategorije as $key => $value) {
                                $niz_svih_kategorija [$key] = $value;
                                $query_sub_kat = "SELECT * FROM php_categories WHERE ParentCategory = '$key'";
                                $show_sub_cat = mysqli_query($db_connection, $query_sub_kat) or die(mysqli_error($db_connection));
                                while ($podkat = mysqli_fetch_array($show_sub_cat)) {
                                    $niz_svih_kategorija [$podkat['CategoryID']] = $podkat['CategoryName'];
                                }
                            }
                        }

                        echo '<br><form id="submit_kat >';
                        foreach ($niz_svih_kategorija as $val => $key) {
                            $b = '';
                            $bc = '';
                            $ch = "";
                            if ($num_kat != 0) {
                                foreach ($niz_kategorija_izab_proizvoda as $v) {
                                    if ($v == $val) {
                                        $ch = "checked";
                                        echo '<input type="hidden" name="kats[]"  value="' . $val . '">';
                                    }
                                }
                            }
                            foreach ($niz_glavnih_kategorija as $niz_gk) {
                                foreach ($niz_gk as $m => $k) {
                                    if ($m == $val) {
                                        $b = '<b>';
                                        $bc = '</b>';
                                    }
                                }
                            }
                            echo '<input type="hidden" name="input_kat[' . $val . ']" value="0"> ';
                            echo '<input type="checkbox"  onclick="this.form.submit()" ' . $ch . ' name="input_kat[' . $val . ']" value="' . $val . '">' . $b . $key . $bc . '<br>';
                            unset($val);
                        }
                        echo ' <input type="hidden" name="proizvod" value="' . $izabrani_proizvod . '">';
                        echo ' <input type="hidden" name="submited" value="ok"><br>';
                        echo '</form>';
                    }
                    ?>
                </div>
                <div id="col1">
                    <h2><a href="novi_proizvod.php">Novi proizvod</a></h2>
                    <h2><a href="kategorije.php">Kategorije</a></h2>
                </div>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
