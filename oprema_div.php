<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::.</span>
        <h1>Oprema, objekti i zemljište</h1>
    </div>
    <div id="tab-container" class="nadtabcontents">
        <ul class="tabs">
            <li ><a href="#oprema">Oprema i rezervni dijelovi</a></li> 
            <li id="default"><a href="#zemljiste">Objekti i zemljište</a></li> 
        </ul>
        <div class="tabcontents">
            <?php
            $oprema = "SELECT * FROM clanci WHERE tab = 'oprema' AND sektor = 'oprema' ORDER BY pozicija ASC ";
            $zemljiste = "SELECT * FROM clanci WHERE tab = 'objekti_zemljiste' AND sektor = 'oprema' ORDER BY pozicija ASC ";

            $query_oprema = mysqli_query($db_connection, $oprema);
            $query_zemljiste = mysqli_query($db_connection, $zemljiste);
            ?>
            <div id="oprema" class="tabcontent">
                <?php
                while ($row_oprema = mysqli_fetch_array($query_oprema, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_oprema['clanak_naslov'] . '"></a>';
                    echo $row_oprema['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 2-------------------------------------------->
            <div id="zemljiste" class="tabcontent">
                <?php
                while ($row_zemlj = mysqli_fetch_array($query_zemljiste, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_zemlj['clanak_naslov'] . '"></a>';
                    echo $row_zemlj['clanak_text'];
                }
                ?>
            </div>
        </div>
    </div>
</div>
