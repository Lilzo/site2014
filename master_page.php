<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>	
	<HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <?php $lokacija = filter_input(INPUT_SERVER, 'PHP_SELF'); // $_SERVER['PHP_SELF']; // $_SERVER['REQUEST_URI']; ?>
        <?php include_once "head_tag.php" ?>
        <?php include_once 'javascript_header.php' ?>
        <?php include_once "head_tag_slideshow.php" ?>
        <?php include_once "php_baneri.inc" ?>
        <?php include_once 'katalog/validation-scripts.php' ?>
        <?php
        if ($lokacija == "/rudarstvo.php" || $lokacija == "/saobracaj.php" || $lokacija == "/drvoprerada.php" || $lokacija == "/komercijalniposlovi.php" || $lokacija == "/gradjevinarstvo.php") {
            include_once"mini_slide.inc";
        }
        ?>
    </head> 
    <body class="bodyTag" >
        <script type="text/javascript">
            LeavePageAtTheTop();
        </script> 
        <?php
        include_once'php_otv_baze.inc';
        include'php_funkcije.inc';
        ?>
        <?php include_once("analyticstracking.php") ?>
        <div class="centering">
            <?php include_once"header_menu.php" ?> 
            <script type="text/javascript">
                preventScroll();
            </script>
            <a id="index-linking" href="/index.php"></a>
            <div id="bcg-header">
                <?php include_once"header_first_row.php" ?> 
            </div>
            <div class="mainTableDiv">
                <div class="main-left-col">
                    <?php include_once"lijevo-include.php" ?>
                </div>
                <?php include_once $include_div; ?>
                <div class="main-right-col">
                    <?php include_once "desno-gore.php" ?>
                    <?php include_once"desno-sredina.php" ?>
                </div>
            </div>
            <?php include_once"footer.php" ?>
            <script type="text/javascript">
                mouseOverMagnifier();
                mouseLeaveMagnifier();
                lostFocus();
                // skroll nakon pretrage
                if (typeof GetURLParameter('keyword') !== 'undefined')
                {
                    var searchedElementHash = '#' + GetURLParameter('shwprt');
                    var searchedWords = GetURLParameter('keyword').split('_');
                    //  console.log(searchedWords);

                    var divPonudaHeight = $j('#ponuda').outerHeight();
                    var divOSektoruHeight = $j('#o_sektoru').outerHeight() + divPonudaHeight;
                    var divReferenceHeight = $j('#reference').outerHeight() + divOSektoruHeight;
                    var divDownloadHeight = $j('#download').outerHeight() + divReferenceHeight;
                    //o nama

                    var divONamaHeight = $j('#o_nama').outerHeight();
                    var divPolitikaKvalitetaHeight = $j('#politika-kvaliteta').outerHeight() + divONamaHeight;
                    var divSertifikatiHeight = $j('#sertifikati').outerHeight() + divPolitikaKvalitetaHeight;
                    var divPriznanjaHeight = $j('#priznanja').outerHeight() + divSertifikatiHeight;
                    var divInformisanjeHeight = $j('#informisanje').outerHeight() + divPriznanjaHeight;

                    console.log(divONamaHeight);
                    console.log(divPolitikaKvalitetaHeight);
                    console.log(divSertifikatiHeight);
                    console.log(divPriznanjaHeight);
                    console.log(divInformisanjeHeight);
                    //  console.log(divKulturaHeight);

                    if (fullHashtag.length > 12) {
                        ScrollToSearchedItem();
                        $j(hashtag).highlight(searchedWords);
                    }
                }
                $j(document).ready(function () {
                    LeavePageAtTheTop();
                }); 
                $j(document).on('click', 'ul li a', function () {
                    LeavePageAtTheTop();
                });
            </script>
        </div>
        <?php include_once("backToTopScript.inc") ?>
        <?php mysqli_close($db_connection); ?>
    </body>
</html>