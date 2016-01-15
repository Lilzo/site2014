<?php

include_once '../php_session.php';
include_once'php_otv_baze.inc';

$ime = filter_input(INPUT_POST, 'ime');
$prezime = filter_input(INPUT_POST, 'prezime');
$imePrezime = $ime .' ' .$prezime;
$ulica = filter_input(INPUT_POST, 'ulica');
$grad = filter_input(INPUT_POST, 'grad');
$postanski_broj = filter_input(INPUT_POST, 'postanskibroj');
$drzava = filter_input(INPUT_POST, 'drzava');
$adresa = '';
	$adresa .= ($ulica != '' ? $ulica .'; ' : '');
	$adresa .= ($grad != '' ? $grad.'; ' : '');
	$adresa .= ($postanski_broj != '' ? $postanski_broj .'; ' : '');
	$adresa .= ($drzava != '' ? $drzava .'; ' : '');
$adresa = trim($adresa);
	//if ($ulica != '')('<br>' . $ulica . '<br>' . $grad . ' ' . $postanski_broj . '<br>' . $drzava);
$tel1 = filter_input(INPUT_POST, 'tel1');
$tel2 = filter_input(INPUT_POST, 'tel2');
$tel3 = filter_input(INPUT_POST, 'tel3');
$telefon = $tel1 . '/' . $tel2 . '-' . $tel3;
$email = filter_input(INPUT_POST, 'email');
$website = filter_input(INPUT_POST, 'website');
$komentar = filter_input(INPUT_POST, 'komentar');
$sesija = session_id();
$cijena_nar_proiz = ' po dogovoru';

$cart_query = "SELECT php_session_item.Price as Price,
                php_product.ProductID,
                php_product.IconPath,
                php_session_item.Quantity,
                php_product.ProductName
                FROM php_session_item INNER JOIN php_product 
                ON php_session_item.ProductID  =php_product.ProductID WHERE SessionID = '$sesija'";
$cart = mysqli_query($db_connection, $cart_query);


$naruceni_proizvodi = ' ';
while ($row = mysqli_fetch_array($cart)) {
    $iconPath = ($row['IconPath'] == null) ? '/nema-slike-thumb.gif' : $row['IconPath'];
    $product_id = $row['ProductID'];
	$cijena = ($row['AppPrice'] != '' || $row['AppPrice'] != '0.00')? '-' : $row['Price'];
    $km = '';
    if (is_numeric($cijena)) {
        $cijena_kolicina = $cijena * $row['Quantity'];
        $km = ' KM';
        $ukupna_cijena [] = $cijena_kolicina;
        $sum_cijene = true;
    } else {
        $sum_cijene = false;
    }

    $naruceni_proizvodi .= '<tr>'
            . '<td>' . $row['ProductName'] . '</td>'
            . '<td style="text-align:center;">' . $row['Quantity'] . '</td>'
            . '<td>' . $cijena . $km . '</td>     </tr>';
}
if ($sum_cijene) {
    $cijena_nar_proiz = array_sum($ukupna_cijena);
    $naruceni_proizvodi .= ' <th >Ukupna cijena</th>
    <th></th>
    <th>' . $cijena_nar_proiz . ' KM</th>';
} 

$upis_narucioca_db_query = "UPDATE php_session SET 
                    Name = '$imePrezime', 
                    EmailAdress = '$email', 
                    Phone = '$telefon', 
                    Adress ='$adresa', 
                    Comments ='$komentar', 
                    OrderTotal = '$cijena_nar_proiz' 
                    WHERE SessionID = '$sessionid'";
$upis_narucioca_db = mysqli_query($db_connection, $upis_narucioca_db_query) or die(mysqli_error($db_connection));

$message = "<html> 
<head>
    <META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=Utf-8\">
</head>
<body>
    <table style=\"font-family:Geneva, Arial, Helvetica, sans-serif;font-size:10pt \">
        <tr>
            <th>Podaci o naručiocu: </th>
        </tr>";
        if( $ime != '' || $prezime || ''){
$message .= "<tr>
				<td>Ime i prezime:</td>
				<td>" . $ime . " " . $prezime . "</td>
			</tr>";
		}
		if ($telefon != '/-'){ 	
$message .=  "<tr>	
				<td> Telefon:</td>
				<td>" . $telefon . "<td>
			</tr>";
		}
		var_dump($adresa);
		if ($adresa != ''){
$message .=  "<tr>
				<td>Adresa:</td>
				<td>" . $adresa . "</td>
			</tr>";
		}
$message .= "<tr>
            <td> Email:</td>
            <td> " . $email . "<td>
        </tr>";
		if ($website != 'http://'){
$message .=  "<tr>
				<td> Website:</td>
				<td> " . $website . "<td>
			</tr>";
		}
		if ($komentar !=''){
$message .=  "<tr>
				<td> Komentar:</td>
				<td> " . $komentar . "<td>
			</tr>";
		}
$message .=  "  <tr>
            <th>&nbsp;
            </th>
        </tr>
        <tr>
            <th>Podaci o naručenim proizvodima: </th>
        </tr>
        <tr>
            <th> Ime proizvoda</th>
            <th>Količina</th>
            <th>Jedinična cijena </th>
        </tr>
        <tr>"
        .$naruceni_proizvodi
    ."</table><br><br>
</body>
</html>";

$subject = "Narudzba";

$headers = "From: $email \r\n";
$headers .= "Content-type: text/html charset=Windows-1250 \r\n";
//MAIL NA KOJI SE ŠALJE PORUKA
//$nizKontaktEMail = $_SESSION['nizKontaktEMail'];
//$to= implode(", ", $nizKontaktEMail);
$to = 'ozren.srdic@ad-boksit.com';
// Slanje poruke

mail($to, $subject, $message, $headers, $headers);
session_regenerate_id();
mysqli_close($db_connection);
header("location: /katalog/");

?>