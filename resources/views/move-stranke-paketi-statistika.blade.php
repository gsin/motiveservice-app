@extends('layouts.app')
 

@section('content')



<script src="https://code.highcharts.com/highcharts.src.js"></script>

<div class="container">
	<h1>
		<a href="/move-stranke-paketi-statistika">Statistika paketov po strankah MOVE</a>
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

	<form action="/move-stranke-paketi-statistika/iskanje" method="POST" role="search">
	    {{ csrf_field() }}
	    <div class="input-group pogoj">
	    	<label for="datum_od" class="label-pogoj">Datum od</label>
	    	 <input type="text" name="datum_od" id="datum_od" type="date" value={{old("datum_od", $datum_od)}}>
	    	 <label for="datum_do" class="label-pogoj">Datum do</label>
	    	 <input type="text" name="datum_do" id="datum_do" type="date" value={{old("datum_do", $datum_do)}}>
	    	
	    	<span class="input-group-btn" style="padding-left: 20px;">
	            <button type="submit" class="btn btn-default">
	                <span>Pripravi podatke</span>
	            </button>
	        </span>
	    </div>
	</form>


    <table class="table table-bordered" id="aktivacije-seznam" style="margin-top: 50px; font-size: x-small; ">
        <thead>
            <tr>                       
                <th>Stranka</th>
                <th>Base</th>
                <th>Intensa</th>
                <th>Prima</th>                               
                <th>Suprema</th>
                <th>Optima</th>                
                <th>Skupaj</th> 
            </tr>
        </thead>
     	@if(isset($stat))
        <tbody>        	
	        	@foreach ($stat as $s)
	        	<tr>
		        	<td> {{  $s->Naziv }} </td> 				    
	        		<td> {{  $s->stevilo_base > 0 ? $s->stevilo_base : '' }} </td>
		        	<td> {{  $s->stevilo_intensa > 0 ? $s->stevilo_intensa : '' }} </td> 				    
		        	<td> {{  $s->stevilo_prima > 0 ? $s->stevilo_prima : '' }} </td> 
		        	<td> {{  $s->stevilo_suprema > 0 ? $s->stevilo_suprema : ''}} </td> 	        	  
					<td> {{  $s->stevilo_optima > 0 ? $s->stevilo_optima : '' }} </td> 					
					<td> {{  $s->stevilo_skupaj > 0 ? $s->stevilo_skupaj : '' }} </td> 					
	        	</tr>		        	
				@endforeach			
        </tbody>       
        <tfoot>
        	<tr>
        		<td><strong>Skupaj</strong></td>
        		<td><strong>{{  $stat_sum['stevilo_base']  }}</strong></td>
	        	<td><strong>{{  $stat_sum['stevilo_intensa'] }}</strong></td> 				    
	        	<td><strong>{{  $stat_sum['stevilo_prima'] }}</strong></td> 
	        	<td><strong>{{  $stat_sum['stevilo_suprema'] }}</strong></td> 	        	  
				<td><strong>{{  $stat_sum['stevilo_optima'] }}</strong></td> 				
				<td><strong>{{  $stat_sum['stevilo_skupaj'] }}</strong></td> 				
        	</tr>
        </tfoot> 
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
		
		var stat_sum = {!! json_encode($stat_sum, JSON_NUMERIC_CHECK) !!};	

		//console.log(stat_sum);

	</script>
	<script src="{{ asset('js/move-stranke-paketi-statistika.js') }}" defer=""></script>
	 
@endif

@stop


@push('scripts')


	
@endpush

