<?php
if (session_id() == '') {
    session_start();

    $_SESSION['session'] = session_id();
    // $_SESSION['session'];

    $hostname = 'localhost';
    $database = 'boksit_test';
    $username = 'boksitad_boksit';
    $administrator_passcode = 'Boksit#2007';

    $db_connection = mysqli_connect("$hostname", "$username", "$administrator_passcode")
            or die('Could not connect: ' . mysqli_connect_error($db_connection));
    mysqli_set_charset($db_connection, "utf8");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $db = mysqli_select_db($db_connection, "$database")
            or die("Ne mogu da izaberem bazu.");

    $_SESSION['id'] = session_id();
    $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR');

    $sessionid = session_id();
    $browser = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
    if (filter_input(INPUT_SERVER, 'HTTP_REFERER') != NULL) {
        $refSource = filter_input(INPUT_SERVER, 'HTTP_REFERER');
    } else {
        $refSource = "Direktno";
    }
    $session_query = "INSERT INTO php_session
        (SessionID, IPAdress, SessionStarted, SessionEnded, RefSource, OSnBrowser)
        VALUES  ('{$sessionid}','{$ip}',NOW(),'','{$refSource}','{$browser}')";
    // echo $session_query;
    $check_session_written = mysqli_query($db_connection, "SELECT * FROM php_session WHERE SessionID ='session_id()'");
    $upisSesije = mysqli_query($db_connection, $session_query);

    mysqli_close($db_connection);
}
?>
