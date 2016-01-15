<?php
if (session_id() == '') {
    session_start();
}
include '../auth.php';
if (isset($_POST['chng'])){
    $deleteusr = filter_input(INPUT_POST, 'chng');
    $delete_user = mysqli_query($db_connection, "DELETE FROM admins WHERE username = '$deleteusr'")
        or die('ERROR '.  mysqli_errno($db_connection));
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
            <?php include_once '../inc/inc_meni.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Administratori</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <form  method="post">
                    <ul id="list">
                        <li><b><span>Ime</span><span>Korisničko ime</span></b></li><br>
                        <?php
                        $query_admin = mysqli_query($db_connection, "SELECT * FROM admins ");

                        while ($izbor_admina = mysqli_fetch_array($query_admin, MYSQLI_BOTH)) {
                            $administrator = $izbor_admina['Ime'];
                            $adminUsername = $izbor_admina['username'];
                            echo '<li><span>' . $administrator . ' </span><span>[' . $adminUsername . ' ]' 
                                    . '</span>';
                                    if ($administrator != "Boksit"){
                                    echo '<button name="chng" type="submit" value="' .$adminUsername .'">Izbriši</button></li><br>';
                                    }
                        }
                        ?>
                        <li><a style="background-color: #FDE8D7; text-decoration: underline;" href="novi_admin.php">Dodaj administratora</a></li>
                    </ul>
                    </form>    
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


