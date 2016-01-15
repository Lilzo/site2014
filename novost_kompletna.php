<?php
// Get the joke text from the database
$id = ''; 
if(isset($_GET['id']))
{
	$id = $_GET['id'];
}

$procitano = mysqli_query($db_connection,"UPDATE vijesti SET procitano=procitano+1 WHERE ID='$id'");
$vijest  = mysqli_query ($db_connection,"SELECT vijestitext, naslov, procitano," .
                       "DATE_FORMAT(vijestidatum, '%d.%m.%Y.') as formated_date " .
                        "FROM vijesti WHERE ID='$id'");

$vijest = mysqli_fetch_array($vijest, MYSQLI_BOTH);
$newstext = $vijest['vijestitext'];
$Naslov = $vijest['naslov'];
$datum = $vijest['formated_date'];
//$datum = $date['FormatedDate'];
$Procitano = $vijest['procitano'];

// If no page specified, default to the
// first page ($page = 0)
if (!isset($_GET['page'])) $page = 0;
else $page = $_GET['page'];

// Split the text into an array of pages
$textarray=preg_split('|\[PAGEBREAK]|',$newstext);

// Izabri stranu koju zelimo
$newstext=$textarray[$page];

$PHP_SELF = $_SERVER['PHP_SELF'];

	if ($page != 0) 
	{
	  $prevpage = $page - 1;
	  echo("<p><a href=\"$PHP_SELF?id=$id&page=$prevpage\">".
		   'Prethodna stranica</a></p>');
	}

	echo( "<h2>$Naslov</h2><br>" );
	echo("$newstext\n");
	echo("<hr>\n");	
	if ((isset($_SERVER['HTTP_REFERER'])) && ($_SERVER['HTTP_REFERER'] == "/novosti/index.php"))
	{
		echo ("<a onclick=\"tabs.open('novosti',true);return false;\" >");	
	}
	else
	{
		echo ("<a href=\"javascript:history.back(1)\">");
	}
	echo ("<- Povratak na prethodnu stranu</a> </font><br>\n");

	if ($page < count($textarray) - 1) 
	{
	  $nextpage = $page + 1;
	  echo("<p><a href=\"$PHP_SELF?id=$id&page=$nextpage\">".
		   'Slijedeca stranica</a></p>');
	}
?>

