<?php

function dodati_proizvod_u_kategoriju($proizvod, $kategorija, $db_con) {
    $check_prod_cat_in_db = mysqli_query($db_con, "SELECT * FROM php_product_categories WHERE ProductID = '$proizvod' and CategoryID = '$kategorija'");
    if (mysqli_num_rows($check_prod_cat_in_db) == NULL) {
        mysqli_query($db_con, "INSERT INTO php_product_categories (ProductCategoryID, ProductID, CategoryID)
            VALUES ('', '$proizvod', '$kategorija')") or die("Error: " . mysqli_error($db_con));
        return true;
    } else {
        return false;
    }
}

function nadkat_exists($kategorija, $db_con) {
    $q_nadkat = mysqli_query($db_con, "SELECT ParentCategory FROM php_categories WHERE CategoryID = '$kategorija'");
    while ($row = mysqli_fetch_array($q_nadkat)) {
        $nadkat = $row['ParentCategory'];
    }
    return $nadkat;
}

function nadkat_true($kategorija, $db_con) {
    $q_nadkat = mysqli_query($db_con, "SELECT CategoryID FROM php_categories WHERE ParentCategory = '$kategorija'");
    if ($q_nadkat) {
        if (mysqli_num_rows($q_nadkat) != 0) {
            return true;
        }
    }
}

function izbrisati_proizvod_iz_kategorije($proizvod, $kategorija, $db_con) {
    mysqli_query($db_con, "DELETE FROM php_product_categories
            WHERE ProductID = '$proizvod' AND CategoryID = '$kategorija'")
            or die("Error: " . mysqli_error($db_con));
}

function izbrisati_proizvod_podkategorije($proizvod, $kategorija, $db_con) {
    $upit = "DELETE pc FROM php_product_categories pc
                INNER JOIN php_categories c
                ON pc.CategoryID = c.CategoryID
                WHERE pc.ProductID = '$proizvod' 
                AND c.ParentCategory = '$kategorija'  ";
    mysqli_query($db_con, $upit)
            or die("Error: " . mysqli_error($db_con));
}

function brisanje_nekompletnih_parova($db_con) {
    $upit = "DELETE FROM php_product_categories WHERE ProductID = '' OR CategoryID = ''";
    mysqli_query($db_con, $upit)
            or die("Error: " . mysqli_error($db_con));
}

if (session_id() == '') {
    session_start();
}
include '../auth.php';
$izabrani_proizvod = filter_input(INPUT_GET, 'proizvod');

$kategorije = mysqli_query($db_connection, "SELECT * FROM php_categories");
$kategorije2 = mysqli_query($db_connection, "SELECT * FROM php_categories");
$proizvod_je_izabran = false;
if ($izabrani_proizvod != null) {
    $proizvod_je_izabran = true;
}
$submited = filter_input(INPUT_GET, 'submited');
$unos_uspjesan = false;
$added_subkat = false;

if (isset($submited)) {
    while ($kn = mysqli_fetch_array($kategorije2)) {
        $niz_kategorija[] = $kn['CategoryID'];
    }

    if (isset($_GET['input_kat'])) {
        $izabrane_kategorije = $_GET['input_kat'];

        foreach ($izabrane_kategorije as $kat) {
            $nkat = nadkat_exists($kat, $db_connection);
            $n_main_kat [] = $nkat;
        }

        $kats_to_add = array_filter(array_unique(array_merge($izabrane_kategorije, $n_main_kat)));
        $to_delete = array_diff($niz_kategorija, $kats_to_add);
    } else {
        $to_delete = $niz_kategorija;
    }

    if (isset($kats_to_add)) {
        foreach ($kats_to_add as $ktd) {
            dodati_proizvod_u_kategoriju($izabrani_proizvod, $ktd, $db_connection);
        }
    }

    foreach ($to_delete as $td) {
        if (!$added_subkat) {
            if (nadkat_true($td, $db_connection)) {
                $niz_nadkat_delete[] = $td;
            } else {
                izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $td, $db_connection);
            }
        }
    }

    if (isset($niz_nadkat_delete) && ($niz_nadkat_delete != null)) {
        foreach ((array_unique($niz_nadkat_delete)) as $nnd) {
            izbrisati_proizvod_podkategorije($izabrani_proizvod, $nnd, $db_connection);
            izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $nnd, $db_connection);
        }
    }
    $sub_message = true;
    brisanje_nekompletnih_parova($db_connection);
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
                    echo 'Prilikom brisanja proizvoda iz kategorije potrebno je prvo dečekirati podkategoriju!<br>';
                    if ($izabrani_proizvod != null) {
                        $kat_iz_pro = mysqli_query($db_connection, "SELECT * FROM php_product_categories 
                                                WHERE  ProductID = '$izabrani_proizvod'");
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
                            $b = '&nbsp;&nbsp;&nbsp;';
                            $bc = '';
                            $ch = "";
                            if ($num_kat != 0) {
                                foreach ($niz_kategorija_izab_proizvoda as $v) {
                                    if ($v == $val) {
                                        $ch = "checked";
                                        echo '<input type="hidden">';
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
                            echo '<input type="hidden"> ';
                            echo '<input type="checkbox"  onclick="this.form.submit()" ' . $ch . ' name="input_kat[]" value="' . $val . '">' . $b . $key . $bc . '<br>';
                            unset($val);
                        }
                        echo ' <input type="hidden" name="proizvod" value="' . $izabrani_proizvod . '">';
                        echo ' <input type="hidden" name="submited" value="ok"><br>';
                        echo '</form>';
                    }
                    if (isset($sub_message)) {
                        echo 'Uspješno ste dodali/promjenili kategorije proizvoda!<br>';
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
