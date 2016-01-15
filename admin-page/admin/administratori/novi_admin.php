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
                    <h1>Novi administrator</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <?php if (null === filter_input(INPUT_POST, 'usrNewAdmin') || null === filter_input(INPUT_POST, 'usrPass')): ?>
                        Unesite vaše korisničko ime i lozinku:<br><br>
                        <form  method="post">
                            Username <input type="text" name="usrNewAdmin"><br>
                            Password <input type="password" size="25" name="usrPass"><br>
                            <input  type="submit" value="Prijava">
                        </form>
                        <?php
                    else: {
                            $username = filter_input(INPUT_POST, 'usrNewAdmin');
                            $usrPass = filter_input(INPUT_POST, 'usrPass');
                            $validate_admin = "SELECT * FROM Admins WHERE username='$username' AND password='$usrPass'";
                            $val_query = mysqli_query($db_connection, $validate_admin);
                            $num_res = mysqli_num_rows($val_query);
                            if ($num_res === 1):
                                ?>
                        <form action="confirm.php" method = "post">
                        <table>
                            <tr>
                                <td>Ime:</td>
                                <td><input style="width:100%" type = "text" name = "newName"></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td> <input style="width:100%" type = "text" name = "newMail"></td>
                            </tr>
                            <tr>
                                <td>Username:</td>
                                <td><input style="width:100%" type = "text" name = "newUsr"></td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td><input style="width:100%" type = "password" size = "25" name = "newUsrPass"></td>
                            </tr>
                            </table>
                                <input type = "submit" value = "potvrda">
                        </form> 
                                <?php
                            else: {
                                unset($_POST['usrNewAdmin']);
                                unset($_POST['usrPass']);
                                ?>
                                <span id="alert">Unešeni podaci nisu ispravni, probajte ponovo:</span><br><br>
                                <form  method="post">
                                    Username <input type="text" name="usrNewAdmin"><br>
                                    Password <input type="password" size="25" name="usrPass"><br>
                                    <input  type="submit" value="Prijava">
                                </form>
                                <?php
                            }
                            endif;
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



