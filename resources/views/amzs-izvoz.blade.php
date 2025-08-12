@extends('layouts.app')
 

@section('content')


<div class="container">
	<h1>
		<a href="/amzs-izvoz">Izvoz AMZS</a>
	</h1>

	@if(Session::has('flash_ok'))
	    <div id="flash_ok" class="alert alert-success">
	        {{ Session::get('flash_ok') }}
	    </div>
	@endif

	@if(isset($error))
	    <div id="msg-error" class="alert alert-danger alert-block">
	        {{ $error }}
	    </div>
	@endif

	<form action="/amzs-izvoz/iskanje" method="POST" role="search">
	    {{ csrf_field() }}
	    <div class="input-group pogoj">
	    	<label for="datum_od" class="label-pogoj">Datum od</label>
	    	 <input type="text" name="datum_od" id="datum_od" type="date" value={{old("datum_od", $datum_od)}}>
	    	 <label for="datum_do" class="label-pogoj">Datum do</label>
	    	 <input type="text" name="datum_do" id="datum_do" type="date" value={{old("datum_do", $datum_do)}}>
	    	
	    	<span class="input-group-btn" style="padding-left: 20px;">
	            <button type="submit" class="btn btn-default" name="action" value="search">
	                <span>Pripravi podatke</span>
	            </button>
	        </span>
	        <span class="input-group-btn" style="padding-left: 20px;">
	            <button type="submit" class="btn btn-default" name="action" value="export">
	                <span>Izvoz CSV</span>
	            </button>
	        </span>
	    </div>
	</form>

	 
    <table class="table table-bordered" id="aktivacije-seznam" style="margin-top: 50px; font-size: x-small; ">
        <thead>
            <tr>                       
                <th>Šifra</th>
                <th>Znamka</th>
                <th>Model</th>
                <th>Št. šasije</th>                               
                <th>Pričetek veljave jamstva</th>
                <th>Veljavno do</th>                
                <th>Prevoženi km</th> 
                <th>Naziv</th> 
                <th>Veljavnost (mesecev)</th> 
            </tr>
        </thead>
     	@if(isset($stat))
        <tbody>        	
	        	@foreach ($stat as $s)
	        	<tr>
		        	<td> {{  $s->oznaka_kartice_jamstva }} </td> 				    
		        	<td> {{  $s->znamka_vozila }} </td> 				    
		        	<td> {{  $s->model_vozila }} </td> 				    
		        	<td> {{  $s->vin }} </td> 				    
		        	<td> {{  $s->pricetek_veljave_jamstva }} </td> 				    
		        	<td> {{  $s->veljavno_do }} </td> 				    
					<td> {{  $s->prevozeni_km }} </td> 				    
					<td> {{  $s->naziv }} </td> 				    
					<td> {{  $s->veljavnost_mesecev }} </td> 				    

	        		 			
	        	</tr>		        	
				@endforeach			
        </tbody>       
        
        @endif
    </table>
	<!--
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto; margin-top: 20px;"></div>
	<div id="container-sum" style="min-width: 310px; height: 400px; margin: 0 auto; margin-top: 20px;"></div>
	-->
</div>




@if(isset($stat))
	<script type="text/javascript">
		var stat = {!! json_encode($stat, JSON_NUMERIC_CHECK) !!};			
		 
		//console.log(stat_sum);

	</script>
	<script src="{{ asset('js/move-stranke-paketi-statistika.js') }}" defer=""></script>
	 
@endif

@stop


@push('scripts')


	
@endpush


