<form id="frm-order" class="appnitro"  method="post" action="kompletiranje_php.php">			
    <ul >
         <li id="li_4" >
            <label class="description" for="email">Email* </label>
            <div>
                <input id="email" name="email" class="element text medium" type="text" maxlength="255" value=""/> 
            </div> 
        </li>
        <li id="li_1" >
            <label class="description" for="imeprezime">Ime i Prezime </label>
            <span>
                <input id="ime" name= "ime" class="element text" maxlength="255" size="8" value=""/>
                <label>Ime</label>
            </span>
            <span>
                <input id="prezime" name= "prezime" class="element text" maxlength="255" size="14" value=""/>
                <label>Prezime</label>
            </span> 
        </li>
        <li id="li_7" >
            <label class="description" for="element_7">Adresa </label>
            <div>
                <input id="ulica" name="ulica" class="element text large" value="" type="text">
                <label for="ulica">Ulica</label>
            </div>
            <div class="left">
                <input id="grad" name="grad" class="element text medium" value="" type="text">
                <label for="grad">Grad</label>
            </div>
            <div class="left">
                <input id="postanskibroj" name="postanskibroj" class="element text medium" maxlength="15" value="" type="text">
                <label for="postanskibroj">Poštanski broj</label>
            </div>
            <div class="right">
                <select class="element select medium" id="drzava" name="drzava"> 
                    <option value="" selected="selected"></option>
                    <option value="Bosnia and Herzegovina" >Bosnia and Herzegovina</option>
                    <option value="Croatia" >Croatia</option>
                    <option value="Serbia " >Serbia</option>
                    <option value=" Montenegro" >Crna Gora</option>
                </select>
                <label for="drzava">Država</label>
            </div> 
        </li>
        <li id="li_3" >
            <label class="description" for="tel">Telefon </label>
            <span>
                <input id="tel1" name="tel1" class="element text" size="4" maxlength="6" value="" type="text"> 
                <label for="tel1">(#####)</label>
            </span>
            <span>
                <input id="tel2" name="tel2" class="element text" size="3" maxlength="3" value="" type="text"> 
                <label for="tel2">###</label>
            </span>
            <span>
                <input id="tel3" name="tel3" class="element text" size="4" maxlength="4" value="" type="text">
                <label for="tel3">####</label>
            </span>
        </li>
        <li id="li_5" >
            <label class="description" for="website">Web Site </label>
            <div>
                <input id="website" name="website" class="element text medium" type="text" maxlength="255" value="http://"/> 
            </div> 
        </li>
        <li id="li_6" >
            <label class="description" for="komentar">Komentar </label>
            <div>
                <textarea id="komentar" name="komentar" class="element textarea medium"></textarea> 
            </div> 
        </li>
        <li class="buttons">
            <input type="hidden" name="form_id" value="" />
            <input id="submit-proizvod"  type="submit" name="completed" value="Pošaljite zahtjev" />
        </li>
    </ul><br><br>
    <div>* Obavezno polje!</div>
</form>	
<div id="pozicija">
    <hr>
    <form class="detaljnije_form">
        <input id="back-button" type="button" value="<" onClick="history.go(-1);return true;">
        <input id="nazad-katalog" type="button" value="povratak na prethodnu stranu" onClick="history.go(-1);return true;">
    </form> 
    <hr>
</div>