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
                    <h1>Brisanje sadržaja</h1>
                </div>
                <div id="gutter"></div>
                <?php
                $productid = filter_input(INPUT_GET, 'id');
                $del_pro = "DELETE FROM php_product WHERE ProductID ='$productid'";
                $del_prod_cat = "DELETE FROM php_product_categories WHERE ProductID ='$productid'";

                if (mysqli_query($db_connection, $del_prod_cat)) {
                    $er = true;
                } else {
                    die('<p>Greška prilikom brisanja iz kategorije proizvda: ' .
                            mysqli_error($db_connection) . '</p>');
                }
                if ($er) {
                    if (mysqli_query($db_connection, $del_pro)) {
                        echo('<p><b>Proizvod  je uspješno izbrisan.</b></p>');
                    } else {
                        die('<p>Greška prilikom brisanja proizvoda: ' .
                                mysqli_error($db_connection) . '</p>');
                    }
                }
                ?>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
