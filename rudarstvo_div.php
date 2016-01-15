<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::.</span>
        <h1>Sektor Rudarstvo</h1>
    </div>
    <div id="tab-container" class="nadtabcontents">
        <ul class="tabs">
            <li><a href="#ponuda">Ponuda</a></li> 
            <li><a href="#o_sektoru" >O sektoru</a></li> 
            <li><a href="#reference">Reference</a></li>
            <li><a href="#download">Download</a></li> 
            <li><a href="#kontakt">Kontakt</a></li> 
        </ul>
        <div class="tabcontents"> 
            <?php
            //UPITI
            $ponuda = "SELECT * FROM clanci WHERE tab = 'ponuda' AND sektor = 'rudarstvo' ORDER BY pozicija ASC";
            $o_sektoru = "SELECT * FROM clanci WHERE tab = 'o_sektoru' AND sektor = 'rudarstvo' ORDER BY pozicija ASC";
            $download = "SELECT * FROM clanci WHERE tab = 'download' AND sektor = 'rudarstvo' ";
            $reference = "SELECT * FROM clanci WHERE tab = 'reference' AND sektor = 'rudarstvo' ";
            $kontakt = "SELECT * FROM clanci WHERE tab = 'kontakt' AND sektor = 'rudarstvo' ORDER BY pozicija ASC";

            $query_ponuda = mysqli_query($db_connection, $ponuda);
            $query_o_sektoru = mysqli_query($db_connection, $o_sektoru);
            $query_download = mysqli_query($db_connection, $download);
            $query_reference = mysqli_query($db_connection, $reference);
            $query_kontakt = mysqli_query($db_connection, $kontakt);
            ?>
            <!-------------------------- DIV 1-------------------------------------------->
            <div id="ponuda" class="tabcontent">
                <div id="rudarstvoTab">
                    <?php
                    while ($row_ponuda = mysqli_fetch_array($query_ponuda, MYSQLI_BOTH)) {
                        echo '<a id="' . $row_ponuda['clanak_naslov'] . '"></a>';
                        echo $row_ponuda['clanak_text'];
                    }
                    ?>
                </div>
            </div>
            <!-------------------------- DIV 2-------------------------------------------->
            <div id="o_sektoru" class="tabcontent">
                <div class="simpleLink">
                    <a href="#povrsinski-kopovi">površinski kopovi</a> | <a href="#separacija-kvarcnog-pijeska"> | <a href="#podzemna-eksploatacija">podzemna eksploatacija</a>  |
                    <a href="#masinsko-odrzavanje">mašinsko održavanje</a> | <a href="#geologija">geologija</a> | <a href="#kontrola-kvaliteta">kontrola kvaliteta</a>
                </div>
                <br>
                <?php
                while ($row_o_sektoru = mysqli_fetch_array($query_o_sektoru, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_o_sektoru['clanak_naslov'] . '"></a>';
                    echo $row_o_sektoru['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 3-------------------------------------------->
            <div id="reference" class="tabcontent">
                <?php
                while ($row_reference = mysqli_fetch_array($query_reference, MYSQLI_BOTH)) {
                    echo $row_reference['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 4-------------------------------------------->
            <div id="download" class="tabcontent">
               
                <?php
                $row_download = mysqli_fetch_array($query_download, MYSQLI_BOTH);
                $download_content = trim($row_download['clanak_text']);
                if(isset($download_content) && ($download_content != '')){
                    echo ' Ovdje možete preuzeti elektronske dokumente:<br><br>';
                    $download_document = explode(";", $download_content);
                    for ($i = 0; $i < count($download_document); $i++) {
                        $document_path_n_title = explode(",", $download_document[$i]);
                         $pdf_full_path = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . $document_path_n_title[0];
                        $pdf_size = size($pdf_full_path);
                        echo '<ul>
                                <li><img alt="" class="pdfImg" src="/img/icons/pdf.jpg">
                                    <a href="' . $document_path_n_title[0] . '" target="_blank" title="' . $document_path_n_title[1] . '">'
                                        . $document_path_n_title[1]. ' ' . $pdf_size. '	
                                    </a>
                                </li>
                            </ul>';
                    }
                } else {
                    echo 'Trenutno nema dostupnih elektronskih dokumenata.';
                }
				
                ?>
            </div>
            <!-------------------------- DIV 5-------------------------------------------->
            <div id="kontakt" class="tabcontent">
                <?php
                while ($row_kontakt = mysqli_fetch_array($query_kontakt, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_kontakt['clanak_naslov'] . '"></a>';
                    echo $row_kontakt['clanak_text'];
                }
                ?>
            </div>
            <hr>
            <div id="tabs-bottom">
                <a href="#ponuda">Ponuda</a>|
                <a href="#o_sektoru" >O sektoru</a>|
                <a href="#reference">Reference</a>|
                <a href="#download">Download</a>|
                <a href="#kontakt">Kontakt</a>
            </div>
        </div>
    </div>
</div>
