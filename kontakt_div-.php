<div class="divCenter">  
    <div id="h1-single-line">
        <span class="tacke">::.</span>
        <h1>Kontakt</h1>
    </div>
    <div  id="tab-container" class="nadtabcontents">
        <ul class="tabs">
            <li><a href="#kontakt">Kontakt</a></li>
            <li><a href="#predsjednik">Predsjednik Kompanije</a></li>
            <li><a href="#email">E-mail</a></li> 
        </ul>
        <div class="tabcontents">
            <?php
            $kontatk = "SELECT * FROM clanci WHERE tab = 'kontakt' AND sektor = 'kontakt' ORDER BY pozicija ASC ";
            $predsjednik_kontakt = "SELECT * FROM clanci WHERE tab = 'kontakt_predsjednik' AND sektor = 'kontakt' ORDER BY pozicija ASC ";

            $query_kontakt = mysqli_query($db_connection, $kontatk);
            $query_pred = mysqli_query($db_connection, $predsjednik_kontakt);
            ?>
            <div id="kontakt" class="tabcontent">
                <?php
                while ($row_kontakt = mysqli_fetch_array($query_kontakt, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_kontakt['clanak_naslov'] . '"></a>';
                    echo $row_kontakt['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 2-------------------------------------------->
            <div id="predsjednik" class="tabcontent">
                <?php
                while ($row_predsjednik = mysqli_fetch_array($query_pred, MYSQLI_BOTH)) {
                    echo '<a id="' . $row_predsjednik['clanak_naslov'] . '"></a>';
                    echo $row_predsjednik['clanak_text'];
                }
                ?>
            </div>
            <!-------------------------- DIV 3-------------------------------------------->
            <div id="email" class="tabcontent mail" >
                <script language="javascript">
                    function validateFormImePrezime()
                    {
                        var x = document.forms["formPodaci"]["ime", "poruka", "email"].value;
                        var y = document.forms["formPodaci"]["email"].value;
                        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        if (x == null || x == "" || x == 0)
                        {
                            alert("Morate popuniti sva polja!");
                            return false;
                        }
                        else if (!y.match(mailformat))
                        {
                            alert("E-mail adresa nije dobra");
                            return false;
                        }
                    }
                </script>

                <form method="post" name="formPodaci" action="" onsubmit="return validateFormImePrezime()">
                    <ul>
                        <li><div class="btnOrder" id="btn-order-text" >Ime i prezime</div><input class="btnOrderInput" name="ime" type="text" size="30"></li>
                        <li><div class="btnOrder" id="btn-order-text">E-mail adresa</div><input  class="btnOrderInput" class="email" name="email" type="text" size="30"></li>
                        <li><div class="btnOrder" id="btn-order-text">Komentar</div>
                        <textarea id="textarea-komentar"  name="poruka" cols="28" rows="10"
                                       onfocus="if (this.value == this.defaultValue)
                                                   this.value = '';" 
                                       onblur="if (this.value == '')
                                                   this.value = this.defaultValue;"> Vaša poruka
                            </textarea></li>
                        <li><input class="btnOrder" name="posalji" type="submit" value="Pošalji">
                            <input class="btnOrder" name="reset" type="reset" value="Odustani"></li>
                    </ul>


                    <?php
                    if (isset($_POST['ime']) && isset($_POST['email']) && isset($_POST['poruka'])) {
                        // from the form
                        $ime = trim(strip_tags($_POST['ime']));
                        $email = trim(strip_tags($_POST['email']));
                        $poruka = htmlentities($_POST['poruka']);

                        // set here
                        $subject = "Poruka preko kontakt forme od " .$ime;
                        $to = 'ozren.srdic@ad-boksit.com';

                        $body = <<<HTML
                    $poruka
HTML;

                        $headers = "From: $email\r\n";
                        $headers .= "Content-type: text/html\r\n";

                        // send the email
                        $sentmail = mail($to, $subject, $body, $headers);
                        //echo $sentmail ? "email sent" : "email sending failed";
                        // redirect afterwords, if needed
                        header('Location: kontakt.php');
                    }
                    ?>

                </form>

            </div>
            <hr>
            <div id="tabs-bottom">
                <a href="#kontakt">Kontakt</a>|
                <a href="#predsjednik">Predsjednik Kompanije</a>|
                <a href="#e-mail">E-mail</a>
            </div>
        </div>
    </div> 
</div>
