<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::.</span>
        <h1>Potražnja</h1>
    </div>
    <div id="tab-container" class="nadtabcontents">
        <ul class="tabs">
            <li><a href="#one_tab" style="padding-left:40px"></a></li>
        </ul>
        <div class="tabcontents">
            <?php
            $one_tab = "SELECT * FROM clanci WHERE tab = 'no_tab' AND sektor = 'potraznja' ORDER BY pozicija ASC ";
            $query_one_tab = mysqli_query($db_connection, $one_tab);
            ?>
            <!-------------------------- DIV 1-------------------------------------------->
            <div id="one_tab" class="tabcontent"> 
                <?php
                while ($row_tab = mysqli_fetch_array($query_one_tab, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_tab['clanak_naslov'] . '"></a>';
                    echo $row_tab['clanak_text'];
                }
                ?>
            </div>
        </div>
    </div>
</div>

