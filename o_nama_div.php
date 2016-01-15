<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::.</span>
        <h1>O nama</h1>
    </div>
    <div  id="tab-container" class="nadtabcontents">
        <ul class="tabs">
            <li><a href="#o_nama">O Nama</a></li>
            <li><a href="#politika-kvaliteta">Politika kvaliteta</a></li>
            <li><a href="#sertifikati">Sertifikati</a></li>
            <li><a href="#priznanja">Priznanja</a></li>
            <li><a href="#informisanje">Informisanje</a></li> 
            <li><a href="#kultura">Kultura</a></li> 
        </ul>
        <div class="tabcontents">
            <?php
            //UPITI
            $o_nama = "SELECT * FROM clanci WHERE tab = 'o_nama' AND sektor = 'o_nama' ORDER BY pozicija ASC ";
            $pol_kva = "SELECT * FROM clanci WHERE tab = 'politika_kvaliteta' AND sektor = 'o_nama' ORDER BY pozicija ASC ";
            $sertifikati = "SELECT * FROM clanci WHERE tab = 'sertifikati' AND sektor = 'o_nama' ORDER BY pozicija ASC";
            $priznanja = "SELECT * FROM clanci WHERE tab = 'priznanja' AND sektor = 'o_nama' ORDER BY pozicija ASC";
            $informisanje = "SELECT * FROM clanci WHERE tab = 'informisanje' AND sektor = 'o_nama' ORDER BY pozicija ASC";
            $kultura = "SELECT * FROM clanci WHERE tab = 'kultura' AND sektor = 'o_nama' ORDER BY pozicija ASC";

            $query_onama = mysqli_query($db_connection, $o_nama);
            $query_politika = mysqli_query($db_connection, $pol_kva);
            $query_sertifikati = mysqli_query($db_connection, $sertifikati);
            $query_priznanja = mysqli_query($db_connection, $priznanja);
            $query_informisanje = mysqli_query($db_connection, $informisanje);
            $query_kultura = mysqli_query($db_connection, $kultura);
            ?>
            <!-------------------------- DIV 1-------------------------------------------->
            <div id="o_nama" class="tabcontent" name="o_nama">
                <?php
                while ($row_onama = mysqli_fetch_array($query_onama, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_onama['clanak_naslov'] . '"></a>';
                    echo $row_onama['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 2-------------------------------------------->
            <div id="politika-kvaliteta" class="tabcontent">
                <?php
                while ($row_pol = mysqli_fetch_array($query_politika, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_pol['clanak_naslov'] . '"></a>';
                    echo $row_pol['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 3-------------------------------------------->
            <div id="sertifikati" class="tabcontent">
                <?php
                while ($row_sertifikati = mysqli_fetch_array($query_sertifikati, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_sertifikati['clanak_naslov'] . '"></a>';
                    echo $row_sertifikati['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 4-------------------------------------------->
            <div id="priznanja" class="tabcontent">
                 <?php
                while ($row_priznanja = mysqli_fetch_array($query_priznanja, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_priznanja['clanak_naslov'] . '"></a>';
                    echo $row_priznanja['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 5-------------------------------------------->
            <div id="informisanje" class="tabcontent">
                <?php
                while ($row_informisanje = mysqli_fetch_array($query_informisanje, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_informisanje['clanak_naslov'] . '"></a>';
                    echo $row_informisanje['clanak_text'];
                }
                ?>
            </div>
              <!-------------------------- DIV 6-------------------------------------------->
            <div id="kultura" class="tabcontent">
                <?php
                while ($row_kultura = mysqli_fetch_array($query_kultura, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_kultura['clanak_naslov'] . '"></a>';
                    echo $row_kultura['clanak_text'];
                }
                ?>
            </div>
            <hr>
            <div id="tabs-bottom">
                <a href="#o_nama">O nama</a>|
                <a href="#politika-kvaliteta">Politika kvaliteta</a>|
                <a href="#sertifikati">Sertifikati</a>|
                <a href="#priznanja">Priznanja</a>|
                <a href="#informisanje">Informisanje</a>|
                <a href="#kultura">Kultura</a>
            </div>
        </div>
    </div>
</div>