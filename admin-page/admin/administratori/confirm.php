<?php

if (session_id() == '') {
    session_start();
}
include '../auth.php';

if (null != filter_input(INPUT_POST, 'newUsr') || null != filter_input(INPUT_POST, 'newUsrPass')) {
    $newUsr = filter_input(INPUT_POST, 'newUsr');
    $newName = filter_input(INPUT_POST, 'newName');
    $newMail = filter_input(INPUT_POST, 'newMail');
    $newUsrPass = filter_input(INPUT_POST, 'newUsrPass');

    $addNewUsr = "INSERT INTO admins SET Ime = '$newName', Email = '$newMail', username = '$newUsr', password = '$newUsrPass' ";
    $query_addusr = mysqli_query($db_connection, $addNewUsr) or die('ERROR: ' . mysqli_error($db_connection));
    unset($_POST['newUsr']);
    unset($_POST['newName']);
    unset($_POST['newMail']);
    unset($_POST['newUsrPass']);
}

header('Location: index.php ');
?>