@extends('layouts.app')
 

@section('content')


<div class="container">

	@if($urejanje == true)
		<h1 class="header-vnos">Urejanje {{ $k->oznaka_jamstva}}</h1>
	@else
		<h1 class="header-vnos">Nova aktivacija</h1>
	@endif		
	 
	@foreach ($errors->all() as $error)
  		<div>
			<p class="p-3 mb-2 bg-danger text-white validation-error">{{ $error }}</p>		
  		</div>      
  	@endforeach  

	@if($urejanje == true)
		{{ Form::model($k, array('route' => array('aktivacija.uredi', $k->id))) }}
		{{ Form::hidden('id', $k->id) }}
	@else
		{!! Form::open(array('action' => 'AktivacijaJamstvaController@store', 'class'=>'form-aktivacija-vnos')) !!}
	@endif
	{{ Form::hidden('userId', Auth::user()->id) }}

	 
	<div class="form-group">
  		<div class="input-delimiter">VOZILO</div>
	</div>

	<div class="form-group">	  
	    <input value="{{old('st_sasije', $k->st_sasije)}}" class="input-control" name="st_sasije" id="st_sasije" placeholder="Št. Šasije" style="flex: 8"></input>	    
	    <input value="{{old('ccm', $k->ccm)}}" class="input-control" name="ccm" id="ccm" placeholder="CCM" style="flex: 2"></input>
  	</div>
	
  	<div class="form-group">	
		<label class="select-label right-inline">Znamka vozila</label>	   
		<select class="form-control" id="id_znamke" name="id_znamke" style="flex: 2">
		    @foreach($zv as $z)
      			<option value="{{ $z->id }}" {{ (old("id_znamke", $k->id_znamke) == $z->id ? "selected":"") }}>{{ $z->opis }}</option>
    		@endforeach
	  	</select>   
	  	<label class="select-label right-inline">Model</label>	     
	    <input value="{{ old('model', $k->model) }}" class="input-control" name="model" id="model" placeholder="Model"   style="flex: 2;margin-top: 0px;"/>
	</div>

  	<div class="form-group">	    
    	<input value="{{old('registrska_st', $k->registrska_st)}}" class="input-control" name="registrska_st" id="registrska_st" placeholder="Št. reg. tablice" maxlength="10" />   
	    <input value="{{old('km', $k->km)}}" class="input-control" name="km" id="km" placeholder="Km" />
	    <label class="select-label right-inline">Gorivo</label>	   
	     <select class="form-control" id="gorivo" name="gorivo" style="flex: 2">
		    <option value=""></option>
		    <option value="B" {{ (old("gorivo", $k->gorivo) == "B" ? "selected":"") }}>BENCIN</option>
		    <option value="D" {{ (old("gorivo", $k->gorivo) == "D" ? "selected":"") }}>DIESEL</option>
		    <option value="X" {{ (old("gorivo", $k->gorivo) == "X" ? "selected":"") }}>DRUGO</option>
		  </select>
  	</div>

	<div class="form-group">
	    <input value="{{old('moc_motorja', $k->moc_motorja)}}" class="input-control" name="moc_motorja" id="moc_motorja" placeholder="Moč motorja" type="number" style="flex: 2"></input>
	    <input value="{{old('tip_motorja', $k->tip_motorja)}}" class="input-control" name="tip_motorja" id="tip_motorja" placeholder="Tip motorja" style="flex: 2"></input>
	     

      	<label class="select-label right-inline">Menjalnik</label>	    
	    <select class="form-control" id="menjalnik" name="menjalnik" style="flex: 2">
		    <option value="" value="R" {{ (old("menjalnik", $k->menjalnik) == "" ? "selected":"") }}></option>
		    <option value="R" {{ (old("menjalnik", $k->menjalnik) == "R" ? "selected":"") }}>ROČNI</option>
		    <option value="A" {{ (old("menjalnik", $k->menjalnik) == "A" ? "selected":"") }}>AVTOMATSKI</option>
	  	</select>

  	</div>

 	<div class="form-group">
	 	<label class="right-inline">Datum prve registracije</label>
	    <input value="{{old('datum_prve_reg', $k->datum_prve_reg)}}" class="input-control" name="datum_prve_reg" id="datum_prve_reg" placeholder="Datum prve reg." style="flex: 2"></input>
 		<span style="flex: 4"></span>			 
  	</div>

  	<div class="form-group">
 	  	<div class="input-delimiter">UPORABNIK</div>
  	</div>  
  	<div class="form-group">	    
	    <input value="{{old('ime_priimek', $k->ime_priimek)}}" class="input-control" name="ime_priimek" id="ime_priimek" placeholder="Ime in priimek" /> 
  	</div>
  	<div class="form-group">	    
	    <input value="{{old('kontaktna_st', $k->kontaktna_st)}}" class="input-control" name="kontaktna_st" id="kontaktna_st" placeholder="Kontaktna številka" /> 
  	</div>
	<div class="form-group">	    
	    <input value="{{old('naslov', $k->naslov)}}" class="input-control" name="naslov" id="naslov" placeholder="Naslov stalnega bivališča" /> 
  	</div>
	<div class="form-group">	    
	    <input value="{{old('postna_st', $k->postna_st)}}" class="input-control" name="postna_st" id="postna_st" placeholder="Poštna št." style="flex: 2" /> 
        <input value="{{old('kraj', $k->kraj)}}" class="input-control" name="kraj" id="kraj" placeholder="Kraj" style="flex: 8"/> 
  	</div>	 
	<div class="form-group">	    
	    <input value="{{old('email', $k->email)}}" class="input-control" name="email" id="email" placeholder="E-Naslov" /> 
  	</div>

	<div class="form-group">
 		<div class="input-delimiter">PODATKI JAMSTVA</div>
	</div>

	<div class="form-group">
		<label class="select-label right-inline">Tip jamstva</label>	 		
		 <select class="form-control" id="tip_jamstva" name="tip_jamstva" style="flex: 4">
		 	
			@if ($urejanje == true && $k->tip_jamstva == "PK")				
				<option value="PK" selected)>PAKET</option>
			@else
				@foreach($tipiJamstev as $t)
	      			<!--<option value="{{$t->koda}}">{{$t->naziv}}</option>-->      			
	  				<option value="{{$t->koda }}" {{ (old("tip_jamstva", $k->tip_jamstva) == $t->koda ? "selected":"") }}>{{ $t->naziv }}</option>
	    		@endforeach		 

			@endif
		  </select>  
						
		<label class="select-label  right-inline">Šifra obrazca</label>		  

		@if ($urejanje == true)
	    	<input value="{{old('oznaka_jamstva', $k->oznaka_jamstva)}}" class="input-control" name="oznaka_jamstva" id="oznaka_jamstva" placeholder="Oznaka jamstva" />	  
	    @else
	    	<input value="{{old('oznaka_jamstva', $oznakaPredlog)}}" class="input-control" name="oznaka_jamstva" id="oznaka_jamstva" placeholder="Oznaka jamstva" />	  
	    @endif

		 
		<!--
		<select class="form-control" id="oznaka_jamstva" name="oznaka_jamstva" style="flex: 4">
		 	@foreach($oznake as $o)
      			<option value="{{$o}}" {{ (old("oznaka_jamstva") == $o ? "selected":"") }}>{{$o}}</option>      			
    		@endforeach		  
	  	</select>  	
		-->
		<label class="select-label right-inline">Veljavnost mesecev</label>	 	 
  		<select class="form-control" id="veljavnost_mesecev" name="veljavnost_mesecev" style="flex: 2">
  			<!-- <option value="0" {{ (old("veljavnost_mesecev", $k->veljavnost_mesecev) == "0" ? "selected":"") }}></option> -->
		    <option value="6" {{ (old("veljavnost_mesecev", $k->veljavnost_mesecev) == "6" ? "selected":"") }}>6</option>
		    <option value="12" {{ (old("veljavnost_mesecev", $k->veljavnost_mesecev) == "12" || !old("veljavnost_mesecev", $k->veljavnost_mesecev)) ? "selected":"" }}>12</option>
		    <option value="24" {{ (old("veljavnost_mesecev", $k->veljavnost_mesecev) == "24" ? "selected":"") }}>24</option>
		    <option value="36" {{ (old("veljavnost_mesecev", $k->veljavnost_mesecev) == "36" ? "selected":"") }}>36</option>
	  	</select>
	</div>
	<div class="form-group">	
		<label class="select-label right-inline">Šifra avtohiše</label>	  	   
		 <select class="form-control" id="sifra_avtohise" name="sifra_avtohise" style="flex: 5 1" {{ $jeAdmin ? '' : 'disabled="true"'}}> 
		 	
		  	@foreach($prodajalci as $p)
      			<option value="{{$p->koda}}"
      				@if ($urejanje == true)
 						@if ($p->koda == old('sifra_avtohise', $k->sifra_avtohise))
					        selected="selected"
				        @endif
      				@else
					 	@if ($p->koda == old('sifra_avtohise', $prodajalec->koda))
					        selected="selected"      				
			        	@endif
			        @endif
			        >{{$p->naziv}}</option>      			
    		@endforeach		
		</select>

		{{ $jeAdmin ? '' : Form::hidden('sifra_avtohise', $prodajalec->koda)}}
		 
		<!--<span style="flex: 4"></span>
 	  	<label class="right-inline">Datum podpisa</label>	 
 	  	<input type="date" value="" class="input-control datepicker" name="datum_podpisa" id="datum_podpisa"/>-->
	<!--</div>
	<div class="form-group">-->
		<span style="flex: 1 1 0%;"></span>
		
		@if ($dodatek_menj == true)
		<label class="right-inline" style="display: inline-block;">Avtomatski menjalnik &nbsp; DA</label>
			{!! Form::radio('dodatek_avt_menj', 1, old("dodatek_avt_menj", $k->dodatek_avt_menj) == "1" ? "true":"false"); !!}
			<label class="right-inline" style="display: inline-block;">NE</label>
			{!! Form::radio('dodatek_avt_menj', 0, old("dodatek_avt_menj", $k->dodatek_avt_menj) == "0" ? "true":"false"); !!}
		@endif
		<span style="flex: 1 1 0%;"></span>
		
		<label class="right-inline" style="display: inline-block;">Neomejeni kilometri &nbsp; DA</label>
		{!! Form::radio('dodatek_km', 1, old("dodatek_km", $k->dodatek_km) == "1" ? "true":"false"); !!}
			
		<label class="right-inline" style="display: inline-block;">NE</label>
		{!! Form::radio('dodatek_km', 0, old("dodatek_km", $k->dodatek_km) == "0" ? "true":"false"); !!}
 	</div>

	<div class="form-group">
		<label class="right-inline">Datum podpisa</label>	 
 	  	<input value="{{old('datum_podpisa', $k->datum_podpisa)}}" class="input-control datepicker" name="datum_podpisa" id="datum_podpisa" placeholder="Datum podpisa" style="flex: 3"/>	  
		<label class="right-inline">Datum predaje vozila</label>
	    <input   value="{{old('datum_predaje', $k->datum_predaje)}}" class="input-control datepicker" name="datum_predaje" id="datum_predaje" placeholder="Datum predaje vozila" style="flex: 3"></input>
	    <label class="right-inline">Pričetek veljavnosti jamstva</label>
	    <input value="{{old('datum_jamstvo_od', $k->datum_jamstvo_od)}}" class="input-control datepicker" name="datum_jamstvo_od" id="datum_jamstvo_od" placeholder="Pričetek veljavnosti jamstva" style="flex: 3"></input>
  	</div>
	<div class="form-group">
  		<div class="input-delimiter">DODATNE OPOMBE</div>
	</div>
	<div class="form-group">	  	    
	    <textarea id="opomba" name="opomba" style="flex: 3" >{{old('opomba', $k->opomba)}}</textarea>	    	
  	</div>

	<div class="form-group">
  		<div class="input-delimiter">SOGLASJE</div>
	</div>

	<div class="form-group">
		<p style="text-align: justify">Skladno z navedbami v priloženih Splošnih pogojih koordinacije &raquo;Storitve upravljanega jamstva&laquo; in Zakonom o varstvu osebnih podatkov (ZVOP), Ur.l. 94/2007, 16.10.2007, dovoljujem obdelovanje osebnih podatkov s strani nosilca za obdelovanje podatkov ali tretjih družb in podjetij, pooblaščenih s strani nosilca, ob upoštevanju načina in namenov, navedenih v naslednjih točkah Splošnih pogojev:</p>
	</div>
	 
  	<div class="form-group">	  
	    <button class="btn btn-success">Shrani</button>

	    <span style="flex: 3"></span>

	    @if ($urejanje == true)
	    	@if ($k->status == 0)
		    	<a href="/aktivacija-brisi/{{$k->id}}" class="btn btn-info">Briši osnutek</a>
		    	<span style="flex: 1"></span>	     
	    	@endif
	    @endif
	    <a href="/aktivacija-jamstva" class="btn btn-info">Prekliči</a>

  	</div>

 

	{!! Form::close() !!}
 	<script src="{{ asset('js/vnos-aktivacija.js') }}" defer=""></script>
 
@stop

@push('scripts')



<script>

</script>
@endpush
