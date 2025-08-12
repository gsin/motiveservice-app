@extends('layouts.app')
 

@section('content')



<script src="https://code.highcharts.com/highcharts.src.js"></script>

<div class="container">
	<h1>
		<a href="/move-stranke-rentabilnost">Rentabilnost po strankah MOVE</a>
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

	<form action="/move-stranke-rentabilnost/iskanje" method="POST" role="search">
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
                <th>Št. jamstev</th>
                <th>Št. okvar</th>
                <th>Razmerje okvare / jamstvo</th>                               
                <th>Denar not</th>
                <th>Denar ven</th>                
                <th>Razmerje denar not / ven</th> 
            </tr>
        </thead>
     	@if(isset($stat))
        <tbody>        	
	        	@foreach ($stat as $s)
	        	<tr>
		        	<td> {{  $s->Naziv }} </td> 				    
	        		<td> {{  $s->sum_stevilo_jamstev > 0 ? $s->sum_stevilo_jamstev : '' }} </td>
		        	<td> {{  $s->sum_stevilo_okvar > 0 ? $s->sum_stevilo_okvar : '' }} </td> 				    
		        	<td> {{  $s->razmerje_okvare_jamstvo > 0 ? $s->razmerje_okvare_jamstvo : '' }} </td> 
		        	<td> {{  $s->sum_denar_not > 0 ? $s->sum_denar_not : ''}} </td> 	        	  
					<td> {{  $s->sum_denar_ven > 0 ? $s->sum_denar_ven : '' }} </td> 					
					<td> {{  $s->razmerje_denar_not_ven > 0 ? $s->razmerje_denar_not_ven : '' }} </td> 					
	        	</tr>		        	
				@endforeach			
        </tbody>       
        <tfoot>
        	<tr>
        		<td><strong>Skupaj</strong></td>
        		<td><strong>{{  $stat_sum['sum_stevilo_jamstev']  }}</strong></td>
	        	<td><strong>{{  $stat_sum['sum_stevilo_okvar'] }}</strong></td> 				    
	        	<td><strong>{{  $stat_sum['sum_stevilo_jamstev'] - $stat_sum['sum_stevilo_okvar'] }}</strong></td> 
	        	<td><strong>{{  $stat_sum['sum_denar_not'] }}</strong></td> 	        	  
				<td><strong>{{  $stat_sum['sum_denar_ven'] }}</strong></td> 				
				<td><strong>{{  $stat_sum['sum_denar_not'] - $stat_sum['sum_denar_ven'] }}</strong></td> 				
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

