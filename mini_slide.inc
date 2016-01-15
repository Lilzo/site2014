<script type="text/javascript" language="javascript">
function swapImage(id, path)
	{
		var el = document.getElementById(id);
		el.count = el.count || 0;
		el.src = path[el.count];
		el.count = (el.count + 1) % path.length;
	}

function slideshow() {
    setInterval(function () {
    
		if (window.location.pathname == "/saobracaj.php")
			{
				swapImage("slidePrevozRobe",[	
				"/images/saobracaj/a_teretni_transport/cisterna-gas-id.gif",
				"/images/saobracaj/a_teretni_transport/hladnjaca-id.gif",	
				"/images/saobracaj/a_teretni_transport/kamion2-id.gif",		
				"/images/saobracaj/a_teretni_transport/scania-id.gif",					
				"/images/saobracaj/a_teretni_transport/spedicija-id.gif"
				]);
				swapImage("slidePrevozPutnika",[	
				
				"/images/saobracaj/b_putnicki_transport/autobus2-id.gif",
				"/images/saobracaj/b_putnicki_transport/autobus3-id.gif",
				"/images/saobracaj/b_putnicki_transport/detalj-id.gif",
				"/images/saobracaj/b_putnicki_transport/autobus-id.gif"
				]);		
			}
		else if (window.location.pathname == "/rudarstvo.php")
			{
				swapImage("slideKvarcniPijesak",[
				"/images/rudarstvo/h_katalog/frakcija1_id.gif",
				"/images/rudarstvo/h_katalog/frakcija3_id.gif",
				"/images/rudarstvo/h_katalog/frakcija4_id.gif",
				"/images/rudarstvo/h_katalog/frakcija2_id.gif"
				]);
			}
		else if (window.location.pathname == "/drvoprerada.php")
			{
				swapImage("slideNamjestaj",[
				"/images/drvoprerada/namjestaj/krevet2-id.gif",
				"/images/drvoprerada/namjestaj/krevet3-id.gif",
				"/images/drvoprerada/namjestaj/krevet4-id.gif",
				"/images/drvoprerada/namjestaj/krevet-na-sprat-id.gif",
				"/images/drvoprerada/namjestaj/sto-mali-id.gif",
				"/images/drvoprerada/namjestaj/radni-sto-id.gif",
				"/images/drvoprerada/namjestaj/krevet1-id.gif",
				]);
			}
		else if (window.location.pathname == "/komercijalniposlovi.php")
			{
				swapImage("slideSolarniPaneli",[
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-kolektori-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-kolektori-prikaz-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-panel-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-paneli-2-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/shema-panela-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarne-ploce-kuca-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-paneli-id.gif",
				]);
			}
		else if (window.location.pathname == "/gradjevinarstvo.php")
			{
				swapImage("slideSolarniKolektori",[
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-kolektori-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-kolektori-prikaz-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/shema-panela-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarne-ploce-id.gif",
				"/images/komercijalno_proizvodni_poslovi/solarni_paneli/solarni-paneli-id.gif",
				]);
			}

		}, 3000);
	}
	slideshow();
</script>