<div class="manuBar"> 
    <div id="navMenu">
        <ul>
            <!--<li class="first"><a href="/en/">English</a></li>-->
            <li><a href="/o_nama.php">O nama</a>
                <ul>
                    <li><a href="/o_nama.php#politika-kvaliteta">Politika kvaliteta</a></li>
                    <li><a href="/o_nama.php#sertifikati">Sertifikati</a></li>
                    <li><a href="/o_nama.php#priznanja">Priznanja</a></li>
                    <li><a href="/o_nama.php#informisanje">Informisanje</a></li>
                    <li><a href="/o_nama.php#kultura">Kultura</a></li>
                </ul>
            </li>
            <li><a href="/profitnicentri.php">Profitni centri</a>
                <ul> 
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
                <ul>
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
                <ul> 
                    <li><a href="/rudarstvo.php#kontakt">Rudarstvo</a></li>
                    <li><a href="/saobracaj.php#kontakt">Saobraćaj</a></li>	
                    <li><a href="/gradjevinarstvo.php#kontakt">Gradnja i elektro-mašinstvo</a></li>
                    <li><a href="/ugostiteljstvo.php#kontakt">Ugostiteljstvo i turizam</a></li>	
                    <li><a href="/komercijalniposlovi.php#kontakt">Komercijalno-proiz. poslovi</a></li>
                    <li><a href="/proizvodnjahrane.php#kontakt">Proizvodnja hrane</a></li>
                    <li><a href="/drvoprerada.php#kontakt">Drvoprerada</a></li>
                </ul>
            </li> 
            <li id="google-translate">
                <?php include_once("google_website_translator.inc"); ?>
            </li>
            <li>
                <?php if (filter_input(INPUT_GET, 'keyword') != NULL)
                        $placeholder = filter_input(INPUT_GET, 'keyword');
                        else
                            $placeholder = "Pretraga";
                ?>
                <form id="header-form" name="pretraga" action="/pretraga/index.php" method="get">
                    <input type="text" placeholder="<?= $placeholder ?>" name="keyword" id="search-block">
                    <input type="submit" value=" " id="img-srch" src="/img/icons/find_search.png">
                </form>                                
            </li> 
        </ul>
        
    </div>   
</div>