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
                if (confirm("Da li ste sigurni da želite da izbrišete ovu kategoriju?") == true)
                    window.location = "/cmsys/admin/kategorije/index.php?delkat=" + id;
                return false;
            }
             function PodKat(id)
            {
                if (confirm("Da li ste sigurni da želite da izbrišete ovu kategoriju?") == true)
                    window.location = "/cmsys/admin/kategorije/index.php?delpod=" + id;
                return false;
            }
        </script>
    </head>
    <body>
        <?php
        if (null !== filter_input(INPUT_GET, 'delkat')) {
            $brisikategoriju = filter_input(INPUT_GET, 'delkat');
            mysqli_query($db_connection, "DELETE FROM clanci_kategorije WHERE id_clanci_kategorije='$brisikategoriju'") or die(mysqli_error($db_connection));
        }

        if (null !== filter_input(INPUT_GET, 'newkat')) {
            $nk = filter_input(INPUT_GET, 'newkat');
            $novakategorija = str_replace(" ", "_", $nk);
            mysqli_query($db_connection, "INSERT INTO clanci_kategorije SET  id_clanci_kategorije = '$novakategorija' ") or die('ERROR: ' . mysqli_error($db_connection));
        }
        if (null !== filter_input(INPUT_GET, 'delpod')) {
            $brisipodkategoriju = filter_input(INPUT_GET, 'delpod');
            mysqli_query($db_connection, "DELETE FROM clanci_podkategorije WHERE id_podkategorija='$brisipodkategoriju'") or die(mysqli_error($db_connection));
        }
        if (null !== filter_input(INPUT_GET, 'newpod')) {
            $pk = filter_input(INPUT_GET, 'newpod');
            $novapodkategorija = str_replace(" ", "_", $pk);
            mysqli_query($db_connection, "INSERT INTO clanci_podkategorije SET id_podkategorija = '$novapodkategorija' ") or die('ERROR: ' . mysqli_error($db_connection));
        }
        ?>

        <div id="main-div">
            <h2>Administracija</h2>
            <?php include_once '../inc/inc_meni.php'; ?>
            <div id="sample14">
                <div id="header">
                    <h1>Kategorije</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Kategorije:</h2>
                    <form method="get">
                        Nova kategorija: <input type="text" name="newkat">
                        <button  type="submit">Dodaj</button>
                    </form>
                    <ul id="list">
                        <?php
                        $query_kategorije = mysqli_query($db_connection, "SELECT * FROM clanci_kategorije ");

                        while ($izbor_kategorija = mysqli_fetch_array($query_kategorije, MYSQLI_BOTH)) {
                            $kat = $izbor_kategorija['id_clanci_kategorije'];
                            $kat_tek = str_replace("_", " ", $kat);
                            echo '<li><span>' . $kat_tek
                            . '</span><button type="button" onclick="return Kat(\'' . $kat . '\');">[izbriši]</button></li><br>';
                        }
                        ?>
                    </ul>
                </div>
                <div id="col1">
                    <h2>Podkategorije:</h2>
                    <form method="get">
                        Nova podkategorija: <input type="text" name="newpod">
                        <button  type="submit">Dodaj</button>
                    </form>
                    <ul id="list">
                        <?php
                        $query_podkategorije = mysqli_query($db_connection, "SELECT * FROM clanci_podkategorije ");

                        while ($izbor_podkategorija = mysqli_fetch_array($query_podkategorije, MYSQLI_BOTH)) {
                            $podkat = $izbor_podkategorija['id_podkategorija'];
                            $podkat_tek = str_replace("_", " ", $podkat);
                            echo '<li><span>' . $podkat_tek
                            . '</span><button type="button" onclick="return PodKat(\'' . $podkat . '\');">[izbriši]</button></li><br>';
                        }
                        ?>
                    </ul>
                </div>
                 <?php include_once '../inc/footer.php'; ?>
            </div>
           <?php include_once '../inc/rights.php'; ?>
        </div>
    </body>
</html>