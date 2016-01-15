<?php
if (session_id() == '') {
    session_start();
}
if (empty($_SESSION['username'])) {
    die('Za pristup stranicama morate se ulogovati.
		      	<a href="/cmsys/admin/login.html">log in</a> ili kontaktirajte
		      	<a href="mailto:logos@teol.net">sistem administratora</a>');

    include '/cmsys/admin/login.html';
}
?>
<html>
    <head>
        <title>Administracija</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="css.css" type="text/css" media="screen" />
    </head>
    <body>
        <div id="main-div">
            <h2>Administracija</h2>
            <?php include_once '/inc/inc_meni.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Početna</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2> <a href="/cmsys/admin/sadrzaj/"> Upravljanje sadržajem</a><br></h2>
                </div>
                <div id="col2">
                    <h2><a href="/cmsys/admin/autori/">Autori</a><br></h2>
                </div>
                <div id="col3">
                    <h2> <a href="/cmsys/admin/kategorije/">Kategorije</a><br></h2>
                </div>
                <div id="footer"><a href="/cmsys/admin/administratori/">Administratori sistema</a><br></div>
            </div>
            <?php include_once '/inc/rights.php'; ?>
        </div>
    </body>
</html>
