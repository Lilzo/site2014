<?php
header("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
//header('Expires: 0'); // Proxies.

require_once './include/Mobile_Detect.php';
$detect = new Mobile_Detect;

//$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
//$scriptVersion = $detect->getScriptVersion();
if(!$detect->isMobile() && !$detect->isTablet()){
    header("Location: http://ad-boksit.local:81/$_SERVER[REQUEST_URI]");
    die();
}
?>
<?php include_once 'php_session.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>	
        <HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
            <?php $lokacija = filter_input(INPUT_SERVER, 'PHP_SELF'); // $_SERVER['PHP_SELF']; // $_SERVER['REQUEST_URI']; ?>
            <meta http-equiv="Content-type" content="text/html; charset=utf-8">
            <meta http-equiv="Content-Type" content="text/html; charset=Windows-1250"> 
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
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
            <!------------TAB-------------->
            <script type="text/javascript">
               
            </script>
            <?php // include_once 'katalog/validation-scripts.php' ?>
            <!--/*resposnive*/-->
            <script src="js/responsive-menu/modernizr.custom.js" type="text/javascript"></script>
             <!--<link rel="stylesheet" href="/js/responsive-menu/component.css"/>/-->
            <!--/*resposnive side menu*/-->
            <script src="js/sidr/jquery.sidr.min.js" type="text/javascript"></script>
            <!--<script src="js/sidr/component.json" type="text/javascript"></script>-->
            <link href="js/sidr/jquery.sidr.dark.css" rel="stylesheet" type="text/css"/>
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
        include_once'php_otv_baze.inc';
        include'php_funkcije.inc';
        ?>
        <?php include_once("analyticstracking.php") ?>
        <div class="centering">
            <?php include_once"header_menu.php" ?> 
            <div class="header-logo"> 
            </div>
            <div class="mainTableDiv">
                 <div id="google_translate_element"></div>
            <script type="text/javascript">
                    function googleTranslateElementInit() {
                      new google.translate.TranslateElement({pageLanguage: 'sr', includedLanguages: 'bg,cs,da,de,en,es,fr,hu,it,nl,pl,pt,ro,ru,sl,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                    }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>      
                <?php include_once $include_div; ?>
            </div>
            <!-- responsive menu-->
            <script src="js/responsive-menu/jquery.dlmenu.js" type="text/javascript"></script>
            <script type="text/javascript">
                $j(function () {
                    $j('#dl-menu').dlmenu();
                });
                preventScroll();
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
        <?php  include_once("backToTopScript.inc") ?>
        <?php mysqli_close($db_connection); ?>
    </body>
</html>