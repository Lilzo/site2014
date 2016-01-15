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
                    <h1>Sadržaj</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Pretraga sadržaja</h2>
                    <?php include 'pretrazi_sadrzaj.php' ?>
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


