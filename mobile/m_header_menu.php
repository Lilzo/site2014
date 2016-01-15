<div id="dl-menu" class="dl-menuwrapper dl-trigger">
     <div id="search-bar-header">

         <?php if (filter_input(INPUT_GET, 'keyword') != NULL)
                $placeholder = filter_input(INPUT_GET, 'keyword');
                else
                    $placeholder = "Pretraga";
            ?>
        <form name="pretraga" action="../pretraga/mpretraga.php" method="get" id="search-bar-form">
            <input type="text" placeholder="<?= $placeholder ?>" name="keyword">
            <!--<input type="submit" value="pretraga" id="pretraga" >-->
        </form>      
     </div>
            <div id="translate-bar-header">
                <?php  include_once("../google_website_translator.inc"); ?>
            </div>
    <!--<div id="translate-bar-header">
            <div id="google-translate">
                <?php//  include_once("google_website_translator.inc"); ?>
            </div>
    </div>-->
     <button id="simple-menu" href="#sidr">Toggle menu</button>
     <span id="menu-caption">Kompanija "Boksit" a.d. Milići</span>
     <button class="dl-trigger">Open Menu</button>
     <button class="menu-button-search inactive-search">Search</button>
     <button class="menu-button-translate inactive-translate">Translate</button>
    <ul class="dl-menu">
        <li>
            <a href="/o_nama.php">O nama</a>
            <ul class="dl-submenu">
                <li><a href="#">Politika kvaliteta</a></li>
                <li><a href="/o_nama.php#politika-kvaliteta">Politika kvaliteta</a></li>
                <li><a href="/o_nama.php#sertifikati">Sertifikati</a></li>
                <li><a href="/o_nama.php#priznanja">Priznanja</a></li>
                <li><a href="/o_nama.php#informisanje">Informisanje</a></li>
                <li><a href="/o_nama.php#kultura">Kultura</a></li>
            </ul>
        </li>
        <li><a href="/profitnicentri.php">Profitni centri</a>
            <ul class="dl-submenu">
                <li><a href="/rudarstvo.php#o_sektoru">Rudarstvo</a></li>
                <li><a href="/saobracaj.php#o_sektoru">Saobraćaj</a></li>	
                <li><a href="/gradjevinarstvo.php#o_sektoru">Gradnja i elektro-mašinstvo</a></li>
                <li><a href="/ugostiteljstvo.php#o_sektoru">Ugostiteljstvo i turizam</a></li>	
                <li><a href="/komercijalniposlovi.php#o_sektoru">Komercijalno-proiz. poslovi</a></li>
                <li><a href="/proizvodnjahrane.php#o_sektoru">Proizvodnja hrane</a></li>
                <li><a href="/drvoprerada.php#o_sektoru">Drvoprerada</a></li>
            </ul>
        </li>
        <li><a href="/novosti.php">Novosti</a></li>
        <li><a href="/ponuda.php">Ponuda</a>
            <ul class="dl-submenu">
                <li><a href="/rudarstvo.php#ponuda">Rudarstvo</a></li>
                <li><a href="/saobracaj.php#ponuda">Saobraćaj</a></li>	
                <li><a href="/gradjevinarstvo.php#ponuda">Gradnja i elektro-mašinstvo</a></li>
                <li><a href="/ugostiteljstvo.php#ponuda">Ugostiteljstvo i turizam</a></li>	
                <li><a href="/komercijalniposlovi.php#ponuda">Komercijalno-proiz. poslovi</a></li>
                <li><a href="/proizvodnjahrane.php#ponuda">Proizvodnja hrane</a></li>
                <li><a href="/drvoprerada.php#ponuda">Drvoprerada</a></li>
                <li><a href="/oprema.php#oprema">Oprema i rezervni dijelovi</a></li>
                <li><a href="/oprema.php#zemljiste">Objekti i zemljište</a></li>
            </ul>
        </li>
        <li><a href="/potraznja.php">Potražnja</a></li>
        <li><a href="/kontakt.php">Kontakt</a>
            <ul class="dl-submenu">
                <li><a href="/rudarstvo.php#kontakt">Rudarstvo</a></li>
                <li><a href="/saobracaj.php#kontakt">Saobraćaj</a></li>	
                <li><a href="/gradjevinarstvo.php#kontakt">Gradnja i elektro-mašinstvo</a></li>
                <li><a href="/ugostiteljstvo.php#kontakt">Ugostiteljstvo i turizam</a></li>	
                <li><a href="/komercijalniposlovi.php#kontakt">Komercijalno-proiz. poslovi</a></li>
                <li><a href="/proizvodnjahrane.php#kontakt">Proizvodnja hrane</a></li>
                <li><a href="/drvoprerada.php#kontakt">Drvoprerada</a></li>
            </ul>
        </li>
    </ul>
</div>
     
<br><br>
    <div id="sidr">
        <!-- Your content -->
        <ul>
          <li><a href="" class="submenu-button">Proizvodi</a>
              <ul class="submenu">
                <li><a id="sm" href="/rudarstvo/ruda-boksit" >Ruda boksita</a></li> 
                <li><a href="/ugostiteljstvo/svjeza-riba">Svježa riba <span class="novo">NOVO!</span></a></li>
                <li><a href="/proizvodnjahrane.php">Konzumna jaja</a></li>
                <li><a href="/komercijalniposlovi/papirna-ambalaza">Podloške za jaja &nbsp;&nbsp;<span class="novo">NOVO!</span></a></li>
                <!-- gradnja-->
                <li><a href="/gradjevinarstvo/betonska-galanterija" >Betonska galanterija</a></li>
                <li><a href="/gradjevinarstvo/metalna-galanterija" >Metalna galanterija</a></li>
                <li><a href="/gradjevinarstvo/hidraulicna-presa" >Hidraulična presa</a></li>
                <li><a href="/gradjevinarstvo/alu-stolarija" >Alu stolarija</a></li>
                <li><a href="/komercijalniposlovi/protektirane-gume">Protektirane gume</a></li>
                <!-- roba široke potršnje
                <li><a href="/roba.php?bg#betonska-galanterija" class="betonska-galanterija">Betonska galanterija</a></li>
                <li><a href="/roba.php?mg#metalna-galanterija" class="metalna-galanterija" onclick="www.google.com">Metalna galanterija</a></li>
                <li><a href="/roba.php?as#alu-stolarija" class="alu-stolarija">Alu stolarija</a></li>
                <li><a href="/roba.php?ck#konsturkcije" class="konstrukcije">Čelične konstrukcije*</a></li>-->
                <!-- drvoprerda-->
                <li><a  href="/drvoprerada/rezana-gradja">Rezana građa</a></li>
                <li><a href="/drvoprerada/parket">Parket</a></li>
                <li><a href="/drvoprerada/masivni-podovi">Masivni podovi</a></li>
                <li><a href="/drvoprerada/masivni-namjestaj">Masivni namještaj &nbsp;&nbsp;<span class="novo">NOVO!</span></a></li>
                <li><a href="/drvoprerada/masivne-ploce">Lijepljene masivne ploče</a></li>  
                <li><a href="/drvoprerada/briketi">Briketi</a></li>         
              </ul>  
          </li>
          <li><a href="" class="submenu-button">Roba</a>
              <ul class="submenu">
                <!-- kineski program-->
                <li><a href="/komercijalniposlovi/rg-mehanizacija" class="rg-mehanizacija">Mehanizacija</a></li>
                <li><a href="/komercijalniposlovi/busaci-pribor" class="busaci-pribor">Bušaći pribor i odlivci</a></li>
                <li><a href="/komercijalniposlovi/gc-power">Viljuškari G-C Power</a></li>
                <li><a href="/komercijalniposlovi/shantui">Viljuškari Shantui</a></li>
                <li><a href="/komercijalniposlovi/pumpe-ventilatori">Pumpe i ventilatori</a></li>
                <li><a href="/komercijalniposlovi/sinotruk" class="sinotruk">Kamioni kiperi Sinotruk</a></li>
                <li><a href="/komercijalniposlovi/shacman" class="shacman">Kamioni Shacman</a></li>
                <li><a href="/komercijalniposlovi/king-long">Autobusi King Long</a></li>
                <li><a href="/komercijalniposlovi/elektricni-aparati">Električni aparati</a></li>
                <li><a href="/komercijalniposlovi/solarni-paneli-kolektori">Solarni paneli<span class="novo" style="padding-right:10px !important;">NOVO!</span></a></li>
                <li><a href="/komercijalniposlovi/gume" class="gume">Gume</a></li>
                <li><a href="/komercijalniposlovi/roba" class="roba">Roba široke potrošnje</a></li>
                <li><a href="/komercijalniposlovi/agregati-i-kompresori" class="agregati-i-kompresori">Agregati i kompresori</a></li>    
                <li><a href="/komercijalniposlovi/zalivni-sistemi" class="zalivni-sistemi">Zalivni sistemi</a></li>
                <li><a href="/komercijalniposlovi/silosi">Silosi</a></li> 
                <li><a href="/komercijalniposlovi/gasne-turbine">Potisne gasne turbine</a></li> 
                <li><a href="/komercijalniposlovi/al-uzad">Aluminijumska užad</a></li> 
                <li><a href="/komercijalniposlovi/el-kablovi">Električni kablovi</a></li> 
                <li><a href="/komercijalniposlovi/ravni-lim">Ravni lim</a></li> 
                <li><a href="/komercijalniposlovi/mreze-gradjevinarstvo">Mreže za građevinarstvo</a></li> 
                <li><a href="/komercijalniposlovi/betonska-galanterija" class="betonska-galanterija">Betonska galanterija</a></li>
                <li><a href="/komercijalniposlovi/metalna-galanterija" class="metalna-galanterija">Metalna galanterija</a></li>
                <li><a href="/komercijalniposlovi/alu-stolarija">Aluminijumska stolarija</a></li>
                <li><a href="/komercijalniposlovi/goriva" >Goriva</a></li>
                <!--	<li><a href="/komercijalniposlovi.php?qs=konsturkcije" class="konstrukcije">Čelične konstrukcije*</a></li>-->     
                <li><a class="oprema" href="/oprema.php">Oprema i rezervni dijelovi</a></li>
            </ul>
          </li>
        <li><a href="" class="submenu-button">Usluge</a>
            <ul class="submenu">
                <!--sektor rudarstvo-->
               <li><a href="/ugostiteljstvo/boksit-turs">Turistička agencija <span class="novo">NOVO!</span></a></li>
               <!--sektor rudarstvo-->
               <li><a href="/rudarstvo/usluge-rg-mehanizacije">Mehanizacija</a></li>
               <li><a href="/rudarstvo/usluge-rg-odrzavanje">Održavanje mehanizacije</a></li>
               <li><a href="/rudarstvo/usluge-odvage">Odvaga do 59 tona</a></li>
               <!-- saobraćaj -->
               <li><a href="/saobracaj/prevoz-robe" class="prevoz-robe">Prevoz robe</a></li>
               <li><a href="/saobracaj/prevoz-putnika" class="prevoz-putnika">Prevoz putnika</a></li>
               <li><a href="/saobracaj/protektirane-gume" class="protektirane-gume">Protektiranje guma</a></li>
               <li><a href="/saobracaj/servis-vozila" class="servis-vozila">Servis vozila</a></li>
               <li><a href="/saobracaj/auto-skola" class="auto-skola">Auto-škola</a></li>
               <li><a href="/komercijalniposlovi/tehnicki-pregled" class="tehnicki-pregled">Tehnički pregledi</a></li>	
               <li><a href="/komercijalniposlovi/sertifikacija-vozila">Sertifikacija vozila</a></li>	
               <!-- gradjevinarstvo-->
               <li><a href="/gradjevinarstvo/gradjevinarstvo" class="gradjevinarstvo">Gradjevinarstvo</a></li>
               <li><a href="/gradjevinarstvo/masinstvo" class="masinstvo">Mašinstvo</a></li>
               <li><a href="/gradjevinarstvo/elektrotehnika" class="elektrotehnika">Elektrotehnika</a></li>
               <li><a href="/gradjevinarstvo/montaza-solarnih-kolektora" class="montaza-solarnih-kolektora">Solarni kolektori<span class="novo">NOVO!</span></a></li>
               <!-- ugostiteljstvo-->
               <li><a href="/ugostiteljstvo.php">Ugostiteljstvo i turizam</a></li>
               <!-- informisanje i kultura-->
               <li><a href="/drvoprerada/usluge-drvoprerada">Drvoprerada</a></li>
           </ul>
        </li>
        <li><a href="" class="submenu-button">Oprema i rezervni dijelovi</a>
            <ul class="submenu">
                <li><a href="/oprema/susenje-voca">Sušenje i pakovanje voća</a></li>	
                <li><a href="/oprema/masina-sipke">Ispravljanje i sječenje šipki</a></li>	
                <li><a href="/oprema/kalibracija-sipki">	Kalibracija mreže</a></li>	
                <li><a href="/oprema/varenje-mreze">	Varenje armaturnih mreža</a></li>	
                <li><a href="/oprema/masina-fert-gredice"> Proizvodnja fert gredica</a></li>	
                <li><a href="/oprema/elektro-bager">Elektro-bager O&amp;K RH 120-E </a></li>	
                <li><a href="/oprema/jamska-lokomotiva">Jamska lokomotiva</a></li>	
            </ul>
        </li>
        <li><a href="" class="submenu-button">Objekti i zemljište</a>
            <ul class="submenu">
                <li><a href="/oprema/zemljiste-zvornik">Zemljište u Zvorniku</a></li>	
                <li><a href="/oprema/ponuda-stanova">Ponuda stanova</a></li>
            </ul>
        </li>

        </ul>
      </div>
    <script>
    $j( ".inactive-search" ).click(function() {
      $j( "div#translate-bar-header" ).slideUp( "medium" );
      $j( "div#search-bar-header" ).slideToggle( "medium" );
      $j( "#search-bar-form" ).delay( 100 ).fadeIn( 100 );
    });
    
    // $j( ".inactive-translate" ).click(function() {
      //  $j( "div#translate-bar-header" ).slideUp( "medium" );
        //$j( "div#translate-bar-header" ).slideToggle( "medium" );
      //$j( "#search-bar-form" ).delay( 100 ).fadeIn( 100 );
   // });
    $j( ".inactive-translate" ).click(function() {
      $j( "div#search-bar-header" ).slideUp( "medium" );
       $j( "div#translate-bar-header" ).slideToggle( "medium" );
     $j( "#search-bar-form" ).delay( 100 ).fadeIn( 100 );
    });
   
    </script>
    <script>
    $j(document).ready(function() {
        $j('#simple-menu').sidr({
            renaming: false
        });

        $j('.submenu-button').click(function(e) {
            e.preventDefault();
            $j(this).next().slideToggle();
        });
    });
    </script>