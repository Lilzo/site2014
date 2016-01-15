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
        <script type="text/javascript">
            function Kat(id)
            {
                if (confirm("Da li ste sigurni da želite da izbrišete ovu kategoriju?") === true)
                    window.location = "/cmsys/admin/katalog/kategorije.php?delkat=" + id;
                return false;
            }
        </script>
    </head>
    <body>
        <?php
        if (null !== filter_input(INPUT_GET, 'delkat')) {
            $brisikategoriju = filter_input(INPUT_GET, 'delkat');
            mysqli_query($db_connection, "DELETE FROM php_categories WHERE id='$brisikategoriju'") or die('Greška prilikom brisanja' . mysqli_error($db_connection));
        }

        if (('' !== filter_input(INPUT_GET, 'id_kategorije')) && (null !== filter_input(INPUT_GET, 'tip_kat'))) {
            $tip_kategorije = filter_input(INPUT_GET, 'tip_kat');
            $id_kategorije = filter_input(INPUT_GET, 'id_kategorije');
            $podkategorija = filter_input(INPUT_GET, 'podkategorija');

            mysqli_query($db_connection, "INSERT INTO php_categories SET  CategoryType = '$tip_kategorije', CategoryID = '$id_kategorije', Subcategory  = '$podkategorija'") or die('Dodavanje nije uspjelo: ' . mysqli_error($db_connection));
        }
        if (filter_input(INPUT_GET, 'pun_naziv') != '') {
            $add_id_kategorije = filter_input(INPUT_GET, 'add_id_kategorije');
            $puno_ime = filter_input(INPUT_GET, 'pun_naziv');
            $kat_name = mysqli_query($db_connection, "SELECT * FROM php_category_names WHERE CategoryID = '$add_id_kategorije' OR CategoryName ='$puno_ime' ")or die(mysqli_error($db_connection));
            if (mysqli_num_rows($kat_name) != 0) {
                echo '<script>alert("Unešen postojeći naziv ili id proizvoda (kratki naziv)!");</script>';
            } else {
                mysqli_query($db_connection, "INSERT INTO php_category_names SET CategoryID ='$add_id_kategorije', CategoryName ='$puno_ime'")or die('Dodavanje nije uspjelo2: ' . mysqli_error($db_connection));
            }
        }
//        if (null !== filter_input(INPUT_GET, 'delpod')) {
//            $brisipodkategoriju = filter_input(INPUT_GET, 'delpod');
//            mysqli_query($db_connection, "DELETE FROM clanci_podkategorije WHERE id_podkategorija='$brisipodkategoriju'") or die(mysqli_error($db_connection));
//        }
//        if (null !== filter_input(INPUT_GET, 'newpod')) {
//            $pk = filter_input(INPUT_GET, 'newpod');
//            $novapodkategorija = str_replace(" ", "_", $pk);
//            mysqli_query($db_connection, "INSERT INTO clanci_podkategorije SET id_podkategorija = '$novapodkategorija' ") or die('ERROR: ' . mysqli_error($db_connection));
//        }
        ?>

        <div id="main-div">
            <h2>Administracija</h2>
            <?php include_once '../inc/inc_meni_katalog.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Kategorije</h1>
                </div>
                <div id="gutter"></div>
                <div>
                    <h2>Kategorije:</h2><br>

                    <table id="kategorije">
                        <tr>
                            <th colspan="3">Dodavanje skraćenog i punog naziva kategorije u tabelu php_category_names</th>
                        </tr>
                        <tr>
                            <th>Id kategorije</th>
                            <th>Pun naziv kategorije</th>
                            <th></th>
                        </tr>
                        <tr>
                        <form method="get" id="newkat">
                            <td><input type="text" name="add_id_kategorije"></td>
                            <td><input type="text" name="pun_naziv"></td>
                            <td><button  type="submit">Dodaj</button></td>
                            </tr>
                            <tr>
                                <th colspan="3">Dodavanje po skraćenom imenu nadkategorija, kategorija i podkategorija u tabelu php_categories</th>
                            </tr>
                            <tr>
                                <th>Tip kategorije</th>
                                <th>Kategorija</th>
                                <th>Podkategorija</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="tip_kat"></td>
                                <td><input type="text" name="id_kategorije"></td>
                                <td><input type="text" name="podkategorija"></td>
                        </form>
                        </tr>
                    </table>
                    <?php
                    $query_kategorije = mysqli_query($db_connection, "SELECT * FROM php_categories ORDER BY CategoryType ASC");
                    echo '<table id="kategorije">
                            <th>Tip kategorije</th><th>Kategorija</th><th>Podkategorija</th><th>Izbriši</th><th></th></tr><tr>';
                    while ($izbor_kategorija = mysqli_fetch_array($query_kategorije, MYSQLI_BOTH)) {
                        $id_kat = $izbor_kategorija['id'];
                        $podkategorija = $izbor_kategorija['Subcategory'];
                        $nadkategorija = $izbor_kategorija['CategoryType'];
                        $kategorija = $izbor_kategorija['CategoryID'];

                        echo '<tr><td>' . $nadkategorija . '</td><td>' . $kategorija . '</td><td>' . $podkategorija . '</td><td>'
                        . '<button type="button" onclick="return Kat(\'' . $id_kat . '\');">[izbriši]</button></td></tr>';
                    }
                    echo "</table>";
                    ?>
                </div>



                <?php include_once '../inc/footer.php'; ?>
            </div>
            <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>