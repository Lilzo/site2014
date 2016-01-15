<?php
if (session_id() == '') {
    session_start();
}
include '../auth.php';
$where = " WHERE 1=1 ";
if (filter_input(INPUT_POST, 'proizvod') != null) {
    $proizvod = filter_input(INPUT_POST, 'proizvod');
    $where .= " AND php_product.ProductID = '$proizvod' ";
}


if (filter_input(INPUT_POST, 'kategorija') != null) {
    $kategorija = filter_input(INPUT_POST, 'kategorija');
    if ($kategorija != 'sve') {
        $where .= "AND CategoryID = '$kategorija'";
    }
}

if (filter_input(INPUT_POST, 'pretrazitekst') != null) {
    $pretrazitekst = filter_input(INPUT_POST, 'pretrazitekst');
    $where = " WHERE php_product.ProductName LIKE '%$pretrazitekst%'";
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
                    <h1>Rezultati pretrage</h1>
                </div>
                <div id="gutter"></div>
                <h3><a href="/cmsys/admin/katalog/">Nazad na pretragu</a></h3><br>
                <div>
                    NAPOMENA:
                    Klikom na opciju izbriši trajno brišete sadržaj iz sistema. Prethodno 
                    nećete biti upozoreni.<br>
                    <table>
                        <?php
                        $select = "SELECT * ";
                        if (isset($proizvod)) {
                            $from = "FROM php_product";
                        } else {
                            $from = "FROM php_product INNER JOIN php_product_categories ON php_product.ProductID = php_product_categories.ProductID";
                        }

//                        if($kategorija && $kategorija != 'sve'){
//                             $from = "FROM php_product INNER JOIN php_product_categories ON php_product.ProductID = php_product_categories.ProductID WHERE CategoryID = '$kategorija'";
//                        }
//                        $from = "FROM php_product ";
                        $upit = $select . $from . $where;
                        if(isset($pretrazitekst)){
                            $upit = "SELECT * FROM php_product WHERE ProductID LIKE '%$pretrazitekst%' OR ProductName LIKE '%$pretrazitekst%'";
                        }
                        //echo $upit;
                        
                        $proizvod_query = mysqli_query($db_connection, $upit) or die(mysqli_error($db_connection));

                        if (!$proizvod_query) {
                            die('<p>Greška prilikom kontaktiranja sadržaja iz baze !!<br />' .
                                    'Error: ' . mysqli_error($db_connection) . '</p>');
                        }
                        $r_br = 1;
                        while ($proizvod_show = mysqli_fetch_array($proizvod_query, MYSQLI_BOTH)) {

                            $id = $proizvod_show['ProductID'];
                            $name = $proizvod_show['ProductName'];
                            $shortdesc = $proizvod_show['ShortDesc'];
                            $longdesc = $proizvod_show['LongDesc'];
                            if (($proizvod_show['IconPath'] == '') || ($proizvod_show['IconPath'] == NULL)) {
                                $iconpath = '/images/nema-slike-thumb.gif';
                            } else {
                                $iconpath = $proizvod_show['IconPath'];
                            }
                            
                            $imgpath = $proizvod_show['ImgPath'];
                            $price = $proizvod_show['Price'];
                            $appprice = $proizvod_show['AppPrice'];
                            $unit = $proizvod_show['Unit'];
                            $atdiscount = $proizvod_show['AtDiscount'];
                            $discoutn = $proizvod_show['Discount'];

                            if ($r_br % 2 == 1)
                                echo "<tr>";
                            echo '<td><div id ="pretraga-katalog-rezultati">';
                            echo $r_br++ . '. <span><b>' . $name . '</b></span>';
                            echo '<p><img src="' . $imgpath . '"/>';
                            echo '<span id ="shrt-desc">' . $shortdesc . '</span></p>';
                            echo"<div> [ <a href='uredi_proizvod.php?id=$id'> Uredi</a> |" .
                            "<a href='izbrisi_proizvod.php?id=$id'> Izbriši</font></a> ]</div>";
                            echo '</div></td>';
                            if ($r_br % 2 == 1)
                                echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
