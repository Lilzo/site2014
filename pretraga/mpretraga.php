<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>	
    <HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <?php $lokacija = filter_input(INPUT_SERVER, 'PHP_SELF'); // $_SERVER['PHP_SELF']; // $_SERVER['REQUEST_URI']; ?>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <!--
        <meta http-equiv="Content-Type" content="text/html; charset=Windows-1250"> 
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
            -->
        <link rel="shortcut icon" href="img/icons/boksit-icon.ico">
        <title>Kompanija "Boksit"</title>
        <link rel="stylesheet" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/css/global.css' ?>">
        <link href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/css/m.css.css' ?>" rel="stylesheet" type="text/css"/>
        <!-- AKO JE INTERNET EXPLORER -->
        <!--[if lt IE 9]>
                <link rel="stylesheet" href="/css/ie.css" type="text/css" />
        <![endif]-->
        <!-- translate google tool -->
        <meta name="google-translate-customization" content="98d995f72449977c-059db502e3efd4be-gdbddb2c147bfc763-11"></meta>
        <script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="/js/global-functions.js"></script>
        <script type="text/javascript" src="/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/js/jquery.collapsible.js"></script>
        <script type="text/javascript" src="/js/jquery.easytabs.js"></script>
        <script type="text/javascript" src="/js/jquery.hashchange.min.js"></script><!--dozvoljava promjenu taba iz glavnog menija -->
        <!------------------------------ validacija------------------------------------>
        <script src="/js/validation/jquery.validate.js" type="text/javascript"></script>
        <script type="text/javascript">
var fullHashtag = window.location.hash;
if (fullHashtag !== '') { //ako je definisan hash
    hashtag = fullHashtag.split("?")[0]; //ako se iza hashtaga nalaze varijable, ukloniće ih
                                        //da ne dodje do zabune pri izboru taba
   if((hashtag === '#o_sektoru')
           ||(hashtag === '#ponuda')
           ||(hashtag === '#downloads')
           ||(hashtag === '#kontakt')
           ||(hashtag === '#reference')
           ||(hashtag === '#one_tab')
           ||(hashtag === '#email')
           ||(hashtag === '#kontakt')
           ||(hashtag === '#predsjednik')
           ||(hashtag === '#o_nama')
           ||(hashtag === '#sertifikati')
           ||(hashtag === '#priznanja')
           ||(hashtag === '#politikia-kvaliteta')
           ||(hashtag === '#informisanje')
           ||(hashtag === '#kultura')
            ) 
    { 
        var glavniTabVarijabla = hashtag;

    } 
    else {
         var glavniTabVarijabla = ':first-child';//ako je hash tag različit od postojećih tabova
    }

}
else {
    var glavniTabVarijabla = ':first-child';
}
glavniTab(glavniTabVarijabla);//poziva se funkcija koja odredjuje glavni tab
</script>

        <?php // include_once 'katalog/validation-scripts.php' ?>
        <!--/*resposnive*/-->
        <script src="../js/responsive-menu/modernizr.custom.js" type="text/javascript"></script>
         <!--<link rel="stylesheet" href="/js/responsive-menu/component.css"/>/-->
        <!--/*resposnive side menu*/-->
        <script src="../js/sidr/jquery.sidr.min.js" type="text/javascript"></script>
        <!--<script src="js/sidr/component.json" type="text/javascript"></script>-->
        <link href="../js/sidr/jquery.sidr.dark.css" rel="stylesheet" type="text/css"/>
        <style>
            .sidr ul.submenu {
                display:none;
            }
            #sidr {
                display: none;
            }
        </style>

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
            <?php include_once"../mobile/m_header_menu.php" ?> 
            <script type="text/javascript">
                preventScroll();
            </script>
            <a id="index-linking" href="/index.php"></a>
            <div class="header-logo"> 
            </div>
            <div class="mainTableDiv">
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
            </div>
            <?php //include_once("../footer.php") ?>
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