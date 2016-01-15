<?php

if (session_id() == '') {
    session_start();
}

if (!isset($_REQUEST['logmeout'])) {
    echo "<center>Potvrdite odjavu sa sistema?</center><br />";
    echo "<center><a href=logout.php?logmeout>DA</a> | <a href=javascript:history.back()>NE</a>";
} else {


    session_destroy();
    if( !isset($_SESSION['username']) ) {
        echo "Odjavljeni ste sa sistema!";
        include 'login.html';
    }
}
?>
