<b>
	Spoštovani,
</b>

<p>
	zahvaljujemo se vam za zaupanje, ki ste nam ga izkazali z izbiro storitev Motive service.
	Obveščamo vas, da je v postopku aktivacije S. U. J. št.:     {{  $k->oznaka_jamstva }}                  
</p>


<b>
	ZAVRNJENA
</b>

<p>
	Številka pogodbe:  {{  $k->oznaka_jamstva }}<br> 
	VIN: {{  $k->st_sasije }}<br> 
	Stranka: {{  $k->ime_priimek }}<br> 
	Vozilo: {{  $k->znamka_vozila->opis ." ". $k->model }}<br> 
	Vključen dodatek Avtomatski menjalnik: {{  $k->dodatek_avt_menj ? 'DA' : 'NE'  }}<br> 
	Vključen dodatek Neomejeni km: {{  $k->dodatek_km ? 'DA' : 'NE'  }}<br> 
</p>

<p>
	Kratko pojasnilo:<br>


	@if (strpos($k->tip_jamstva, 'BASE') !== false)
	     Posredovana aktivacija presega vstopne pogoje storitev BASE.
		Storitve BASE se nanašajo na vozila do skupne mase 3,5 tone s polnim rezervarjem, ki niso bila prvič registrirana pred več kot 14 leti in nimajo več kot 250.000 prevoženih kilometrov (z besedo: dvesto petdeset tisoč).
	@elseif (strpos($k->tip_jamstva, 'INTENSA') !== false)
	    Posredovana aktivacija presega vstopne pogoje storitev <b>INTENSA</b>.
		Storitve  <b>INTENSA</b> se nanašajo na vozila do skupne mase 3,5 tone s polnim rezervarjem, ki niso bila prvič registrirana pred več kot 10 leti in nimajo več kot 180.000 prevoženih kilometrov (z besedo: sto osemdeset tisoč).
	@elseif (strpos($k->tip_jamstva, 'PRIMA') !== false)
		 Posredovana aktivacija presega vstopne pogoje storitev <b>PRIMA</b>.
Storitve <b>PRIMA</b> se nanašajo na vozila do skupne mase 3,5 tone s polnim rezervarjem, ki niso bila prvič registrirana pred več kot 12 leti in nimajo več kot 200.000 prevoženih kilometrov (z besedo: dvesto tisoč).
	@elseif (strpos($k->tip_jamstva, 'SUPREMA') !== false)
	 	 Storitve <b>SUPREMA</b> se nanašajo na vozila do skupne mase 3,5 tone s polnim rezervarjem, ki niso bila prvič registrirana pred več kot 7 leti in nimajo več kot 150.000 prevoženih kilometrov (z besedo: sto petdeset tisoč).
	@endif

	<br>
	Aktivacijo je v pregled dobil vaš skrbnik: Uroš Gec
</p>

<p>
	S spoštovanjem<br>   
<br> 
	Oddelek za aktivacije 
	Motive Service d.o.o.
	Sermin 74a – 6000 KOPER
	Tel.:+386 5 901 6581  
</p>