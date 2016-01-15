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
                    <h1>Uredi administratora</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <?php if (null === filter_input(INPUT_POST, 'chng')): ?>
                        Unesite vaše korisničko ime i lozinku:<br><br>
                        <form  method="post">
                            Username <input type="text" name="usrNewAdmin"><br>
                            Password <input type="password" size="25" name="usrPass"><br>
                            <input  type="submit" value="Prijava">
                        </form>
                        <?php
                    else: {

                      
                        }

                    endif;
                    ?>
                </div>
                <div id="col2">
                </div>
                <div id="col3">
                </div>
                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>



