<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::. </span>
        <h1> Korpa</h1>
    </div>
    <div id="tab-container" class="nadtabcontents">
        <ul class="tabs">
        <?php
        $naruci = filter_input(INPUT_POST, 'naruci');
        $prikazi_tab_zahtjev = ($naruci != '') ? true : false;
        ?>
            <li><a href="#cart">Korpa</a></li>
            <?php
            if ($prikazi_tab_zahtjev){
            echo '<li><a href="#kontakt-info">Kontak informacije</a></li>';
            }
            ?>
        </ul>
        <div class="tabcontents">
            <!-------------------------- DIV 1-------------------------------------------->
            <div id="cart" class="tabcontent"> 
            <?php include_once 'korpa_div_php.php'; ?>
            </div>
            <?php if ($prikazi_tab_zahtjev) { ?>             
                <div id="kontakt-info" class="tabcontent"> 
                <?php include_once 'narudzbenica_div_php.php'; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

