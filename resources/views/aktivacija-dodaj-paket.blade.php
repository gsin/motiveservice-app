@extends('layouts.app')
 

@section('content')



<div class="container">
	<h1 class="header-vnos">Aktivacija paketa</h1>
	 
	@foreach ($errors->all() as $error)
  		<div>
  			<p class="p-3 mb-2 bg-danger text-white validation-error">{{ $error }}</p>		
  		</div>      
  	@endforeach

	{!! Form::open(array('action' => 'AktivacijaJamstvaPaketController@store', 'class'=>'form-aktivacija-vnos')) !!}

	{{ Form::hidden('userId', Auth::user()->id) }}
	 

	<div class="form-group">
  		<div class="input-delimiter">VOZILO</div>
	</div>

	<div class="form-group">	  
	    <input value="{{old('st_sasije')}}" class="input-control" name="st_sasije" id="st_sasije" placeholder="Št. Šasije" style="flex: 8"></input>	    
	    <input value="{{old('ccm')}}" class="input-control" name="ccm" id="ccm" placeholder="CCM" style="flex: 2"></input>
  	</div>
	
  	<div class="form-group">	
		<label class="select-label right-inline">Znamka vozila</label>	   
		<select class="form-control" id="id_znamke" name="id_znamke" style="flex: 2">
		    @foreach($zv as $z)
      			<option value="{{ $z->id }}" {{ (old("id_znamke") == $z->id ? "selected":"") }}>{{ $z->opis }}</option>
    		@endforeach
	  	</select>   
	  	<label class="select-label right-inline">Model</label>	     
	    <input value="{{ old('model') }}" class="input-control" name="model" id="model" placeholder="Model"   style="flex: 2;margin-top: 0px;"/>
	</div>

  	<div class="form-group">	    
    	<input value="{{old('registrska_st')}}" class="input-control" name="registrska_st" id="registrska_st" placeholder="Št. reg. tablice" maxlength="10" />   
	    <input value="{{old('km')}}" class="input-control" name="km" id="km" placeholder="Km" />
	    <label class="select-label right-inline">Gorivo</label>	   
	     <select class="form-control" id="gorivo" name="gorivo" style="flex: 2">
		    <option value=""></option>
		    <option value="B" {{ (old("gorivo") == "B" ? "selected":"") }}>BENCIN</option>
		    <option value="D" {{ (old("gorivo") == "D" ? "selected":"") }}>DIESEL</option>
		    <option value="X" {{ (old("gorivo") == "X" ? "selected":"") }}>DRUGO</option>
		  </select>
  	</div>

	<div class="form-group">
	    <input value="{{old('moc_motorja')}}" class="input-control" name="moc_motorja" id="moc_motorja" placeholder="Moč motorja" type="number" style="flex: 2"></input>
	    <input value="{{old('tip_motorja')}}" class="input-control" name="tip_motorja" id="tip_motorja" placeholder="Tip motorja" style="flex: 2"></input>
	     

      	<label class="select-label right-inline">Menjalnik</label>	    
	    <select class="form-control" id="menjalnik" name="menjalnik" style="flex: 2">
		    <option value=""></option>
		    <option value="R" selected="true">ROČNI</option>
		    <option value="A">AVTOMATSKI</option>
	  	</select>

  	</div>

 	<div class="form-group">
	 	<label class="right-inline">Datum prve registracije</label>
	    <input value="{{old('datum_prve_reg')}}" class="input-control" name="datum_prve_reg" id="datum_prve_reg" placeholder="Datum prve reg." style="flex: 2"></input>
	 		<span style="flex: 4"></span>
			 
  	</div>

  	<div class="form-group">
 	  	<div class="input-delimiter">UPORABNIK</div>
  	</div>  
  	<div class="form-group">	    
	    <input value="{{old('ime_priimek')}}" class="input-control" name="ime_priimek" id="ime_priimek" placeholder="Ime in priimek" /> 
  	</div>
  	<div class="form-group">	    
	    <input value="" class="input-control" name="kontaktna_st" id="kontaktna_st" placeholder="Kontaktna številka" /> 
  	</div>
	<div class="form-group">	    
	    <input value="{{old('naslov')}}" class="input-control" name="naslov" id="naslov" placeholder="Naslov stalnega bivališča" /> 
  	</div>
	<div class="form-group">	    
	    <input value="{{old('postna_st')}}" class="input-control" name="postna_st" id="postna_st" placeholder="Poštna št." style="flex: 2" /> 
        <input value="" class="input-control" name="kraj" id="kraj" placeholder="Kraj" style="flex: 8"/> 
  	</div>
	 
	<div class="form-group">	    
	    <input value="{{old('email')}}" class="input-control" name="email" id="email" placeholder="E-Naslov" /> 
  	</div>

	<div class="form-group">
 		<div class="input-delimiter">PODATKI JAMSTVA</div>
	</div>

	<div class="form-group">
		<label class="select-label right-inline">Oznaka jamstva</label>	 	 		 					
		<input value="{{$oznaka_jamstva}} {{old('oznaka_jamstva')}}" class="input-control" name="oznaka_jamstva" id="oznaka_jamstva" placeholder="Oznaka jamstva" readonly />	   
		 	
		<label class="select-label right-inline">Tip jamstva</label>	 		
		<input value="{{$tip_jamstva}} {{old('tip_jamstva')}}" class="input-control" name="tip_jamstva" id="tip_jamstva" placeholder="Tip jamstva" readonly />	   		
		
		<label class="select-label right-inline">Veljavnost mesecev</label>	 	 
  		<select class="form-control" id="veljavnost_mesecev" name="veljavnost_mesecev" style="flex: 2">
  			<!-- <option value="0" {{ (old("veljavnost_mesecev") == "0" ? "selected":"") }}></option> -->
		    <option value="6" {{ (old("veljavnost_mesecev") == "6" ? "selected":"") }}>6</option>
		    <option value="12" {{ (old("veljavnost_mesecev") == "12" || !old("veljavnost_mesecev")) ? "selected":"" }}>12</option>
		    <option value="24" {{ (old("veljavnost_mesecev") == "24" ? "selected":"") }}>24</option>
		    <option value="36" {{ (old("veljavnost_mesecev") == "36" ? "selected":"") }}>36</option>
	  	</select>
	</div>
	<div class="form-group">	
		<label class="select-label right-inline">Šifra avtohiše</label>	  	   
		 <select class="form-control" id="sifra_avtohise" name="sifra_avtohise" style="flex: 5 1" {{ $jeAdmin ? '' : 'disabled="true"'}}> 
		  	@foreach($prodajalci as $p)
      			<option value="{{$p->koda}}"
					 @if ($p->koda == old('sifra_avtohise', $prodajalec->koda))
					        selected="selected"
			        @endif>{{$p->naziv}}</option>      			
    		@endforeach		
		</select>

		{{ $jeAdmin ? '' : Form::hidden('sifra_avtohise', $prodajalec->koda)}}
		 	
		<span style="flex: 1 1 0%;"></span>
		<label class="right-inline" style="display: inline-block;">Avtomatski menjalnik &nbsp; DA</label>
		{!! Form::radio('dodatek_avt_menj', 1, false); !!}
		<label class="right-inline" style="display: inline-block;">NE</label>
		{!! Form::radio('dodatek_avt_menj', 0, true); !!}
		<span style="flex: 1 1 0%;"></span>
		<label class="right-inline" style="display: inline-block;">Neomejeni kilometri &nbsp; DA</label>
		{!! Form::radio('dodatek_km', 1, false); !!}
		<label class="right-inline" style="display: inline-block;">NE</label>
		{!! Form::radio('dodatek_km', 0, true); !!}
 	</div>

	<div class="form-group">
		<label class="right-inline">Datum podpisa</label>	 
 	  	<input value="{{old('datum_podpisa')}}" class="input-control datepicker" name="datum_podpisa" id="datum_podpisa" placeholder="Datum podpisa" style="flex: 3"/>	  
		<label class="right-inline">Datum predaje vozila</label>
	    <input   value="{{old('datum_predaje')}}" class="input-control datepicker" name="datum_predaje" id="datum_predaje" placeholder="Datum predaje vozila" style="flex: 3"></input>
	    <label class="right-inline">Pričetek veljavnosti jamstva</label>
	    <input value="{{old('datum_jamstvo_od')}}" class="input-control datepicker" name="datum_jamstvo_od" id="datum_jamstvo_od" placeholder="Pričetek veljavnosti jamstva" style="flex: 3"></input>
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
	    <a href="/aktivacija-jamstva" class="btn btn-info">Prekliči</a>
  	</div>

 

	{!! Form::close() !!}
 	<script src="{{ asset('js/vnos-aktivacija.js') }}" defer=""></script>
 
@stop

@push('scripts')



<script>

</script>
@endpush
