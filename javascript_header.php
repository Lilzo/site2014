<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/global-functions.js"></script>
<!--VTicker je za novosti sa desne strane--->
<!--[if !IE]><!-->
<script  type="text/javascript" src="/js/jquery.vticker.js"></script>
<!--<![endif]-->
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery.collapsible.js"></script>
<!------------------------------ slider orbit ---------------------------->	
<script type="text/javascript" src="/js/jquery.orbit-1.2.3.js"></script>
<script type="text/javascript" src="/js/jquery.easytabs.js"></script>
<script type="text/javascript" src="/js/jquery.hashchange.min.js"></script><!--dozvoljava promjenu taba iz glavnog menija -->
<!------------------------------ validacija------------------------------------>
<script src="/js/validation/jquery.validate.js" type="text/javascript"></script>
<script language="JavaScript" type="text/JavaScript">
    OrbitCall(); 
    CollapsibleLeftMenu();
</script>
<!--[if !IE]><!-->
<script language="JavaScript" type="text/JavaScript">
VTickerCall();
</script>
<!--<![endif]-->
<!------------TAB-------------->
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
