<?php

function spisak_proizvoda($db_con) {
    $upit = "SELECT * FROM php_product";
    $query = mysqli_query($db_con, $upit);
    while ($products = mysqli_fetch_array($query)) {
        $niz_prod [] = [$products['ProductID'] => $products['ProductName']];
    }
    return $niz_prod;
}

function kategorije($db_con) {
    $upit = "SELECT * FROM php_categories";
    $query = mysqli_query($db_con, $upit);
    while ($kategorije = mysqli_fetch_array($query)) {
        $mc = ($kategorije['ParentCategory'] != '') ? false : true;
        $niz_kategorija[] = ['glavna_kategorija' => $mc, 'id' => $kategorije['CategoryID'], 'name' => $kategorije['CategoryName'], 'parent' => $kategorije['ParentCategory']];
    }
    return $niz_kategorija;
}

function glavne_kategorije($niz) {
    foreach ($niz as $n) {
        if ($n['glavna_kategorija']) {
            $glavne_kategorije[] = $n;
        }
    }
    return $glavne_kategorije;
}

function id_glavnih_kat($niz) {
    foreach ($niz as $n) {
        $niz_id_gl_kat[] = $n['id'];
    }
    return $niz_id_gl_kat;
}

function podkategorije($niz) {
    foreach ($niz as $n) {
        if (!$n['glavna_kategorija']) {
            $podkategorije[] = $n;
        }
    }
    return $podkategorije;
}

function specific_glavna_kategorija($kat, $db_con) {
    $upit = "SELECT ParentCategory FROM php_categories WHERE CategoryID = '$kat'";
    $query = mysqli_query($db_con, $upit);
    while ($row = mysqli_fetch_array($query)) {
        $specific_glavna_kategorija = $row['ParentCategory'];
    }
    return $specific_glavna_kategorija;
}

function kategorije_izabranog_proizvoda($proizvod, $db_con) {
    $upit = "SELECT * FROM php_product_categories WHERE ProductID ='$proizvod'";
    $query = mysqli_query($db_con, $upit);
    while ($row = mysqli_fetch_array($query)) {
        $kategorije[] = $row['CategoryID'];
    }
    if (isset($kategorije)) {
        return $kategorije;
    } else {
        return array();
    }
}

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

function izbrisati_proizvod_iz_kategorije($proizvod, $kategorija, $db_con) {
    mysqli_query($db_con, "DELETE FROM php_product_categories
            WHERE ProductID = '$proizvod' AND CategoryID = '$kategorija'")
            or die("Error: " . mysqli_error($db_con));
}

function izbrisati_proizvode_glavne_kategorije($proizvod, $kategorija, $db_con) {
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

function delete_last_category($proizvod, $db_con) {
    $upit = "DELETE FROM php_product_categories WHERE ProductID = '$proizvod'";
    mysqli_query($db_con, $upit)
            or die("Error: " . mysqli_error($db_con));
}

function remove_nonexisting_product_from_category($db_con) {

}

if (session_id() == '') {
    session_start();
}
include '../auth.php';

$izabrani_proizvod = filter_input(INPUT_GET, 'proizvod');
if (isset($_POST['checked_cat'])) {
    $checked_category = $_POST['checked_cat'];
}

$niz_kategorija = kategorije($db_connection);
$glavne_kategorije = glavne_kategorije($niz_kategorija);
$niz_id_glavnih_kat = id_glavnih_kat($glavne_kategorije);
$podkategorije = podkategorije($niz_kategorija);
$kategorije_izabranog_proizvoda = kategorije_izabranog_proizvoda($izabrani_proizvod, $db_connection);
$submited = filter_input(INPUT_POST, 'submited');


if (isset($submited)) {
    if (isset($checked_category)) {
        $kategorije_diff_checked_kat = array_diff($kategorije_izabranog_proizvoda, $checked_category);
        $checked_kat_diff_kategorije = array_diff($checked_category, $kategorije_izabranog_proizvoda);
        /* kod za brisanje dečekiranih kategorija */
        if (count($kategorije_diff_checked_kat) != 0) {
            foreach ($kategorije_diff_checked_kat as $kd) {
                $glavna_kategorija = in_array($kd, $niz_id_glavnih_kat);
                if ($glavna_kategorija) {
                    izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $kd, $db_connection);
                    izbrisati_proizvode_glavne_kategorije($izabrani_proizvod, $kd, $db_connection);
                } else {
                    izbrisati_proizvod_iz_kategorije($izabrani_proizvod, $kd, $db_connection);
                }
            }
//            header("Refresh:0");
        }
        /* kod za dodavanje čekiranih kategorija */

        if (count($checked_kat_diff_kategorije) != 0) {
            foreach ($checked_kat_diff_kategorije as $cd) {
                $glavna_kategorija = in_array($cd, $niz_id_glavnih_kat);
                if ($glavna_kategorija) {
                    dodati_proizvod_u_kategoriju($izabrani_proizvod, $cd, $db_connection);
                } else {
                    $id_glavna_kategorija = specific_glavna_kategorija($cd, $db_connection);
                    dodati_proizvod_u_kategoriju($izabrani_proizvod, $id_glavna_kategorija, $db_connection);
                    dodati_proizvod_u_kategoriju($izabrani_proizvod, $cd, $db_connection);
                }
            }
//            header("Refresh:0");
        }
    } else {
        delete_last_category($izabrani_proizvod, $db_connection);
    }
    $kategorije_izabranog_proizvoda = kategorije_izabranog_proizvoda($izabrani_proizvod, $db_connection);
    brisanje_nekompletnih_parova($db_connection);
    remove_nonexisting_product_from_category($db_connection);
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
spisak_proizvoda($db_connection);
?>
                    <form method="get">
                        <select name="proizvod" onchange="this.form.submit()">
                            <option value="">Proizvod</option>
<?php
$niz_proizvoda = spisak_proizvoda($db_connection);
foreach ($niz_proizvoda as $niz) {
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
foreach ($glavne_kategorije as $g) {
    $ime = $g['name'];
    $id = $g['id'];
    if (!isset($kategorije_izabranog_proizvoda_submit)) {
        $arr_kat = $kategorije_izabranog_proizvoda;
    } else {
        $arr_kat = $kategorije_izabranog_proizvoda_submit;
    }
    $ch = (in_array($id, $arr_kat)) ? ' checked ' : '';
    echo '<input type="checkbox"' . $ch . 'onclick="this.form.submit()" name="checked_cat[]"  value="' . $id . '"><b>' . $ime . '</b></input><br>';

    foreach ($podkategorije as $p) {
        $ime_nadkat = $p['parent'];
        $ime_podkat = $p['name'];
        $id_podkat = $p['id'];

        if ($id == $ime_nadkat) {
            $c = (in_array($id_podkat, $arr_kat)) ? ' checked ' : '';
            echo '<input style="margin-left:10px;"' . $c . 'type="checkbox" onclick="this.form.submit()" name="checked_cat[]"  value="' . $id_podkat . '">' . $ime_podkat . '</input><br>';
        }
    }
}
echo ' <input type="hidden" name="proizvod" value="' . $izabrani_proizvod . '">';
?>   
                        <input type="hidden" name="submited" value="ok">
                    </form>
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
