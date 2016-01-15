<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>	
        <?php $lokacija = filter_input(INPUT_SERVER, 'PHP_SELF'); // $_SERVER['PHP_SELF']; // $_SERVER['REQUEST_URI']; ?>
        <?php include_once "head_tag.php" ?>
        <?php include_once 'javascript_header.php' ?>
        <?php include_once "head_tag_slideshow.php" ?>
        <?php include_once "php_baneri.inc" ?>
        <?php
        if ($lokacija == "/rudarstvo.php" || $lokacija == "/saobracaj.php") {
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
                <div class="divCenter">  
                    <div id="tab-container" class="nadtabcontents">	
                        <ul class="tabs" >	 
                            <li><a href="#ponuda">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                        </ul>
                        <div class="tabcontents">
                            <!-------------------------- DIV 1-------------------------------------------->
                            <div id="ponuda" class="tabcontent">
                                Stranica koju tražite ne postoji ili je premještena.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-right-col">
                    <?php include_once "desno-gore.php" ?>
                    <?php include_once"desno-sredina.php" ?>
                </div>
            </div>
            <?php include_once"footer.php" ?>
            <script type="text/javascript">
                $j("#img-srch").mouseover(function() {
                    $j("#search-block").css("visibility", "visible").animate({
                        left: "-162px",
                        width: "162px"
                    }, 300);
                    $j("#search-block").delay(400).focus();
                });

                $j("#img-srch").mouseleave(function() {
                    setTimeout(function() {
                        $j("#search-block").animate({
                            left: "0px",
                            width: "0px"
                        }, 1300);
                    }, 7000),
                            setTimeout(function() {
                                $j("#search-block").css("visibility", "hidden")
                            }, 8300)
                });

                $j("#search-block").blur(function() {
                    $j("#search-block").animate({
                        left: "0px",
                        width: "0px"
                    }, 300);
                    setTimeout(function() {
                        $j("#search-block").css("visibility", "hidden")
                    }, 300)
                });
            </script>
            <script type="text/javascript">
                // skroll nakon pretrage
                if (typeof GetURLParameter('keyword') != 'undefined')
                {

                    var searchedElementHash = '#' + GetURLParameter('shwprt');
                    var searchedWords = GetURLParameter('keyword').split('_');
                    //  console.log(searchedWords);

                    var divPonudaHeight = $j('#ponuda').outerHeight();
                    var divOSektoruHeight = $j('#o_sektoru').outerHeight() + divPonudaHeight;
                    var divReferenceHeight = $j('#reference').outerHeight() + divOSektoruHeight;
                    var divDownloadHeight = $j('#download').outerHeight() + divReferenceHeight;

                    if (fullHashtag.length > 12) {
                        ScrollToSearchedItem();
                        $j(hashtag).highlight(searchedWords);
                    }
                }
            </script>
        </div>
        <?php include_once("backToTopScript.inc") ?>
        <?php mysqli_close($db_connection); ?>
    </body>
</html>



