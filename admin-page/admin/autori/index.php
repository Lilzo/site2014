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
             function Aut(id)
            {
                if (confirm("Da li ste sigurni da želite da izbrišete ovog autora?") == true)
                    window.location = "/cms/admin/autori/index.php?delaut=" + id;
                return false;
            }
        </script>
    </head>
    <body>
        <?php
         if (null !== filter_input(INPUT_GET, 'delaut')) {
            $brisiautora = filter_input(INPUT_GET, 'delaut');
            mysqli_query($db_connection, "DELETE FROM autori WHERE Ime='$brisiautora'") or die(mysqli_error($db_connection));
        }

        if (null !== filter_input(INPUT_GET, 'newaut')) {
            $noviautor = filter_input(INPUT_GET, 'newaut');
            mysqli_query($db_connection, "INSERT INTO autori SET  Ime = '$noviautor' ") or die('ERROR: ' . mysqli_error($db_connection));
        }
        ?>
        <div id="main-div">
            <h2>Administracija</h2>
            <?php include_once '../inc/inc_meni.php'; ?>
            <div id="sample14">
                <!--Administracija -&gt; <a href="/cms2/admin/">Početna</a> -&gt; Sadržaj<br>
            Administracija sadržaja-->
                <div id="header">
                    <h1>Autori</h1>
                </div>
                <div id="gutter"></div>
                <div id="col1">
                    <h2>Autori</h2>
                     <form method="get">
                        Nova kategorija: <input type="text" name="newaut">
                        <button  type="submit">Dodaj</button>
                    </form>
                    <ul id="list">
                     <?php
                        $query_autori = mysqli_query($db_connection, "SELECT * FROM autori ");
                        
                        while ($izbor_autora = mysqli_fetch_array($query_autori, MYSQLI_BOTH)){
                            $autor = $izbor_autora['Ime'];
                        echo '<li><span>' . $autor . '</span><button type="button" onclick="return Aut(\'' . $autor . '\');">[izbriši]</button></li><br>';
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


