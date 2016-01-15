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
            <?php include_once '../inc/inc_meni.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Početna</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Pretraga sadržaja</h2>
                    <?php
                    $id = $_GET['id'];
                    $ok = mysqli_query($db_connection, "DELETE FROM clanci WHERE id_clanak='$id'");
                    if ($ok) {
                        echo('<p><b>Sadržaj uspješno izbrisan!</b></p>');
                    } else {
                        echo('<p><b>Greška prilikom brisanja sadržaja iz baze!</b><br />' .
                        'Error: ' . mysqli_error($db_connection) . '</p>');
                    }
                    ?>
                    <a href="/cmsys/admin/sadrzaj/">Povratak na sadržaj</p>
                </div>
                <div id="col2">
                    <h2><a href="novi_sadrzaj.php">Unos novog sadržaja</a></h2>
                </div>
                <div id="col3">
                </div>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>
