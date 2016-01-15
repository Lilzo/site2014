<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::. </span>
        <h1> Novosti</h1>     
    </div>
    <div id="tab-container" class="nadtabcontents">	<ul class="tabs" >	 
            <?php
            $naziv = $_SERVER['QUERY_STRING'];
            $prikazatiTabVijesti = false;

            if (($naziv != null) && (!isset($_GET['sveVijesti']))) {
                echo "<li><a href=\"#vijest\">Vijest</a></li>";
                $prikazatiTabVijesti = true;
            }
            //include 'php_otv_baze.inc'; 
            ?>
            <li><a href="#novosti">Novosti</a></li>
        </ul>
        <div class="tabcontents">
            <!-------------------------- DIV 1-------------------------------------------->
            <div id="vijest" class="tabcontent" style="<?php if (!$prikazatiTabVijesti) echo"display:none"; ?>">
                <?php include 'novost_kompletna.php'; ?>
            </div>
            <!----------------------------DIV 2------------------------------------------->
            <div id="novosti" class="tabcontent" >
                <?php include 'novosti_pregled.php' ?>
            </div>	
            <?php
            //mysqli_close($db_connection);
            ?>
        </div>
    </div>
</div>
