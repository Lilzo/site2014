<?php
if(session_id() == '') {
    session_start();
}

include '../php_otv_baze.inc';

if (empty($_SESSION['username'])) {
    die('Za pristup stranicama morate se ulogovati.
		      	<a href="/cmsys/admin/login.html">log in</a> ili kontaktirajte
		      	<a href="mailto:logos@teol.net">sistem administratora</a>');

    include '/cmsys/admin/login.html';
}
?>



