@extends('layouts.app')
 

@section('content')



<script src="https://code.highcharts.com/highcharts.src.js"></script>

<div class="container">
	<h1>
		<a href="/move-izdane-fakture">{{$title}}</a>
	</h1>

	 
	
<div style="margin-bottom: 30px;">
	<form action="/move-izdane-fakture/iskanje" method="POST" role="search">
	    {{ csrf_field() }}
	    <div class="input-group">
	    	 
    	  <input type="text" class="form-control" name="id_stranke" name="id_stranke" style="margin-top: 5px" 
	            placeholder="Naziv avtohiše" value="{{$naziv_avtohise }}" {{ ($admin != true ? "readonly":"") }}> <span class="input-group-btn">			    	
	    	<span class="input-group-btn">
	            <button type="submit" class="btn btn-default">
	                <span>Pripravi podatke</span>
	            </button>
	        </span>
	    </div>
	</form>
</div>

    <table class="table table-bordered" id="fakture-seznam" style="font-size: x-small; ">
        <thead>
            <tr>
                <th>Račun št.</th>
                <th>Plačnik</th>
                <th>Datum</th>
                <th>Zapade</th>
                <th>Znesek EUR</th>
                <th>Znesek plačano EUR</th>                                               
                <th>Odprto</th>                
            </tr>
        </thead>
     	@if(isset($fakture))
        <tbody>        	
	        	@foreach ($fakture as $f)
	        	<tr>
		        	<td> {{  $f->oznaka }} </td> 				    
	        		<td> {{  $f->placnikNaziv  }} </td>
		        	<td> {{  $f->datum }} </td> 				    
		        	<td> {{  $f->datum_zapade }} </td> 
		        	<td align="right"> {{  $f->znesek }} </td> 	        	  
					<td align="right"> {{  $f->znesek_placan }} </td> 
					<td> {{  $f->odprt }} </td> 		        	
				</tr>		        	
				@endforeach			
        </tbody>       
        <tfoot>
        	<tr>
        		<td></td>
        		<td></td>
	        	<td></td> 				    
	        	<td><strong>Skupaj EUR</strong></td> 
	        	<td align="right"><strong>{{  $stat_sum['sum_znesek'] }}</strong></td> 	        	  
				<td align="right"><strong>{{  $stat_sum['sum_znesek_placan'] }}</strong></td> 
				<td align="right"><strong>{{  $stat_sum['sum_znesek_odprto'] }}</strong></td> 	        	 
        	</tr>
        </tfoot> 
        @endif
    </table>
	
	  
</div>


@if(isset($fakture))
	<script src="{{ asset('js/move-izdane-fakture.js') }}" defer=""></script>
@endif

@stop


@push('scripts')


	
@endpush

