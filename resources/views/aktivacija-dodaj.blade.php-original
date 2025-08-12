@extends('layouts.app')
 

@section('content')



<div class="container">
	<h1 class="header-vnos">Nova aktivacija</h1>
	 
	@foreach ($errors->all() as $error)
  		<div>
  			<p class="p-3 mb-2 bg-danger text-white validation-error">{{ $error }}</p>		
  		</div>      
  	@endforeach

	{!! Form::open(array('action' => 'AktivacijaJamstvaController@store', 'class'=>'form-aktivacija-vnos')) !!}

	{{ Form::hidden('userId', Auth::user()->id) }}
	 

	<div class="form-group">
 		<div class="input-delimiter">OBRAZEC ZA AKTIVACIJO JAMSTVA</div>
	</div>

	<div class="form-group">
		<label class="select-label right-inline">Tip jamstva</label>	 		
		 <select class="form-control" id="tip_jamstva" name="tip_jamstva" style="flex: 4">
		 	@foreach($tipiJamstev as $t)
      			<option value="{{$t->koda}}">{{$t->naziv}}</option>      			
    		@endforeach		  
		  </select>  
		<label class="right-inline">Šifra obrazca</label>	 
		<input value="{{old('sifra')}}" class="input-control" name="sifra" id="sifra" placeholder="SLP" />	   
		<label class="select-label right-inline">Veljavnost mesecev</label>	 	 
  		<select class="form-control" id="veljavnost_mesecev" name="veljavnost_mesecev" style="flex: 2">
  			<option value="0"></option>
		    <option value="6">6</option>
		    <option value="12">12</option>
		    <option value="24">24</option>
		    <option value="36">36</option>
	  	</select>



	</div>
	<div class="form-group">	
		<label class="select-label right-inline">Šifra avtohiše</label>	  	   
		 <select class="form-control" id="sifra_avtohise" name="sifra_avtohise" style="flex: 4" {{ $jeAdmin ? '' : 'disabled="true"'}}> 
		  	@foreach($prodajalci as $p)
      			<option value="{{$p->koda}}"
					 @if ($p->koda == old('sifra_avtohise', $prodajalec->koda))
					        selected="selected"
			        @endif>{{$p->naziv}}</option>      			
    		@endforeach		
		</select>

		 {{ $jeAdmin ? '' : Form::hidden('sifra_avtohise', $prodajalec->koda)}}
		 
		<span style="flex: 4"></span>
 	  	<label class="right-inline">Datum podpisa</label>	 
 	  	<input type="date" value="" class="input-control datepicker" name="datum_podpisa" id="datum_podpisa"/>	  
	</div>
	<div class="form-group">
		 
			<label class="right-inline">Vključen dodatek avtomatski menjalnik DA</label>	 
		    {!! Form::radio('dodatek_avt_menj', 1, false); !!}
	 	 	<label class="right-inline">NE</label>	 
	 		{!! Form::radio('dodatek_avt_menj', 0, true); !!}
	
		 
			<label class="right-inline">Vključen dodatek neomejeni kilometri DA</label>	 
		    {!! Form::radio('dodatek_km', 1, false); !!}
		    <label class="right-inline">NE</label>	 
		    {!! Form::radio('dodatek_km', 0, true); !!}	  		 	
 	</div>


	
	
	<div class="form-group">
  		<div class="input-delimiter">VOZILO</div>
	</div>
  	<div class="form-group">	
		<label class="select-label right-inline">Znamka vozila</label>	   
		<select class="form-control" id="id_znamke" name="id_znamke" style="flex: 2">
		    @foreach($zv as $z)
      			<option value="{{$z->id}}">{{$z->opis}}</option>      			
    		@endforeach
	  	</select>   
	  	<label class="select-label right-inline">Model</label>	     
	    <input value="{{ old('model') }}" class="input-control" name="model" id="model" placeholder="Model"   style="flex: 2;margin-top: 0px;"/>
	</div>

  	<div class="form-group">	    
    	<input value="{{old('registrska_st')}}" class="input-control" name="registrska_st" id="registrska_st" placeholder="Št. reg. tablice" />   
	    <input value="" class="input-control" name="km" id="km" placeholder="Km" />
	    <label class="select-label right-inline">Gorivo</label>	   
	     <select class="form-control" id="gorivo" name="gorivo" style="flex: 2">
		    <option value=""></option>
		    <option value="B">BENCIN</option>
		    <option value="D">DIESEL</option>
		    <option value="X">DRUGO</option>
		  </select>
  	</div>

  	<div class="form-group">	  
	    <input value="{{old('st_sasije')}}" class="input-control" name="st_sasije" id="st_sasije" placeholder="Št. Šasije" style="flex: 8"></input>	    
	    <input value="" class="input-control" name="ccm" id="ccm" placeholder="CCM" style="flex: 2"></input>
  	</div>

	<div class="form-group">
	    <input value="" class="input-control" name="moc_motorja" id="moc_motorja" placeholder="Moč motorja" style="flex: 2"></input>
	    <input value="" class="input-control" name="tip_motorja" id="tip_motorja" placeholder="Tip motorja" style="flex: 2"></input>
	    <label class="select-label right-inline">Pogon</label>	    
  		<select class="form-control" id="pogon" name="pogon" style="flex: 2">
		    <option value=""></option>
		    <option value="2WD" selected="true">DVOKOLESNI</option>
		    <option value="4WD">ŠTIRIKOLESNI</option>
	  	</select>

      	<label class="select-label right-inline">Menjalnik</label>	    
	    <select class="form-control" id="menjalnik" name="menjalnik" style="flex: 2">
		    <option value=""></option>
		    <option value="R" selected="true">ROČNI</option>
		    <option value="A">AVTOMATSKI</option>
	  	</select>

  	</div>

 	<div class="form-group">
	 	<label class="right-inline">Datum prve registracije</label>
	    <input type="date" value="" class="input-control" name="datum_prve_reg" id="datum_prve_reg" placeholder="Datum prve reg." style="flex: 2"></input>
	 		<span style="flex: 4"></span>
			<label class="right-inline">Komercialno vozilo DA</label>	 
		    {!! Form::radio('komercialno_vozilo', 1, false); !!}
	 	 	<label class="right-inline">NE</label>	 
	 		{!! Form::radio('komercialno_vozilo', 0, true); !!}
  	</div>

	<div class="form-group"> 
		<label class="right-inline">Datum predaje vozila</label>
	    <input type="date" value="" class="input-control" name="datum_predaje" id="datum_predaje" placeholder="Datum predaje" style="flex: 3"></input>
	    <span style="flex: 4"></span>
	    <label class="right-inline">Pričetek veljavnosti</label>
	    <input type="date" value="" class="input-control" name="datum_jamstvo_od" id="datum_jamstvo_od" placeholder="Pričetek veljavnosti" style="flex: 3"></input>
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
	    <input value="" class="input-control" name="kraj_rojstva" id="kraj_rojstva" placeholder="Kraj rojstva" style="flex: 8" /> 
	    <label class="right-inline">Datum rojstva</label>
        <input type="date" value="" class="input-control" name="datum_rojstva" id="datum_rojstva" placeholder="Datum rojstva" style="flex: 2"/> 
  	</div>
	<div class="form-group">	    
	    <input value="" class="input-control" name="email" id="email" placeholder="E-Naslov" /> 
  	</div>
	<div class="form-group">
  		<div class="input-delimiter">SOGLASJE</div>
	</div>
	<div class="form-group">
			<label class="right-inline">Soglasje 1 DA</label>	 
		    {!! Form::checkbox('soglasje_1', 1, true); !!}
	 	 	<label class="right-inline">NE</label>	 
	 		{!! Form::checkbox('soglasje_1', 0, false); !!}
	</div>
	<div class="form-group">	 
			<label class="right-inline">Soglasje 2 DA</label>	 
  			{!! Form::checkbox('soglasje_2', 1, false); !!}
	 	 	<label class="right-inline">NE</label>	 
	 		{!! Form::checkbox('soglasje_2', 0, false); !!}  	
	 </div>
	 <div class="form-group">	 
	 		<label class="right-inline">Soglasje 3 DA</label>	 
  			{!! Form::checkbox('soglasje_3', 1, false); !!}
	 	 	<label class="right-inline">NE</label>	 
	 		{!! Form::checkbox('soglasje_3', 0, false); !!}  		
 	</div>	 
  	<div class="form-group">	  
	    <button class="btn btn-success">Shrani</button>
	     <span style="flex: 3"></span>
	    <a href="/aktivacija-jamstva" class="btn btn-info">Prekliči</a>
  	</div>

 

	{!! Form::close() !!}

 
@stop

@push('scripts')



<script>

</script>
@endpush
