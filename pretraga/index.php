<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>	
        <?php $lokacija = filter_input(INPUT_SERVER, 'PHP_SELF'); // $_SERVER['PHP_SELF']; // $_SERVER['REQUEST_URI']; ?>
        <?php include_once "../head_tag.php" ?>
        <?php include_once '../javascript_header.php' ?>
        <?php include_once "../head_tag_slideshow.php" ?>
        <?php include_once "../php_baneri.inc" ?>
    </head> 
    <body class="bodyTag" >
        <script type="text/javascript">
            LeavePageAtTheTop();
        </script> 
        <?php
        include_once'../php_otv_baze.inc';
        include'../php_funkcije.inc';
        ?>
        <?php include_once"../analyticstracking.php" ?>
        <div class="centering">
            <?php include_once"../header_menu.php" ?> 
            <script type="text/javascript">
                preventScroll();
            </script>
            <a id="index-linking" href="/index.php"></a>
            <div id="bcg-header">
                <?php include_once"../header_first_row.php" ?> 
            </div>
            <div class="mainTableDiv">
                <div class="main-left-col">
                    <?php include_once"../lijevo-include.php" ?>
                </div>
                <div class="divCenter">   
                    <div id="h1-single-line">
                        <span class="tacke">::.</span>
                        <h1>Pretraga</h1>
                    </div>
                    <div id="tab-container" class="nadtabcontents">
                        <ul class="tabs">
                            <li><a href="#pretraga">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li> 
                        </ul>
                        <div class="tabcontents"> 
                            <!-------------------------- DIV 1-------------------------------------------->
                            <div id="pretraga" class="tabcontent">
                                <div id="pretraga">
                                    <div id="search-bar">
                                        <?php include_once 'php_pretraga.inc'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-right-col">
                    <?php include_once "../desno-gore.php" ?>
                    <?php include_once "../desno-sredina.php" ?>
                </div>
            </div>
            <?php include_once("../footer.php") ?>
        </div>
        <?php include_once("../backToTopScript.inc") ?>
        <?php mysqli_close($db_connection); ?>
        <script type="text/javascript">
            mouseOverMagnifier();
            mouseLeaveMagnifier();
            lostFocus();

            var split = location.search.replace('?', '').split('=')
            if (split[0] === "keyword") {
                var searchedWords = split[1].split('+');
                $j('#search-bar').highlight(searchedWords);
                console.log(searchedWords);
            }
        </script>
    </body>
</html>