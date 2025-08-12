@extends('layouts.app')
 

@section('content')



<script src="https://code.highcharts.com/highcharts.src.js"></script>

<div class="container">
	<h1>
		<a href="/move-pogodbe-statistika">Statistika pogodb MOVE</a>
	</h1>

	<form action="/move-pogodbe-statistika/iskanje" method="POST" role="search">
	    {{ csrf_field() }}
	    <div class="input-group">
	    	 
	    	<select id="leto" name="leto" class="form-control" style="margin-top: 5px" onchange="this.form.submit();" >	    	 
    		 	<option value="2018" {{ ($leto  == "2018" ? "selected":"") }}>2018</option>    		 	
    		 	<option value="2019" {{ ($leto == "2019" ? "selected":"") }}>2019</option>
    		 	<option value="2020" {{ ($leto == "2020" ? "selected":"") }}>2020</option>
    		 	<option value="2021" {{ ($leto == "2021" ? "selected":"") }}>2021</option>
    		 	<option value="2022" {{ ($leto == "2022" ? "selected":"") }}>2022</option>
    		 	<option value="2023" {{ ($leto == "2023" ? "selected":"") }}>2023</option>
    		 	<option value="2024" {{ ($leto == "2024" ? "selected":"") }}>2024</option>
    		 	<option value="2025" {{ ($leto == "2025" ? "selected":"") }}>2025</option>
	    	</select>	   
			<input type="text" class="form-control" name="id_stranke" name="id_stranke" style="margin-top: 5px" 
	            placeholder="Naziv avtohiše" value="{{$id_stranke }}"> <span class="input-group-btn">	

		


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
                <th></th>             	
                <th>Januar</th>
                <th>Februar</th>
                <th>Marec</th>
                <th>April</th>                               
                <th>Maj</th>
                <th>Junij</th>
                <th>Julij</th>
                <th>Avgust</th>                
                <th>September</th>                
         	   	<th>Oktober</th>                
                <th>November</th>     
                <th>December</th>     
            </tr>
        </thead>
     	@if(isset($stat))
        <tbody>        	
	        	@foreach ($stat as $s)
	        	<tr>
		        	<td> {{  $s->paket }} </td> 				    
	        		<td> {{  $s->januar  }} </td>
		        	<td> {{  $s->februar }} </td> 				    
		        	<td> {{  $s->marec }} </td> 
		        	<td> {{  $s->april }} </td> 	        	  
					<td> {{  $s->maj }} </td> 
					<td> {{  $s->junij }} </td> 
		        	<td> {{  $s->julij }} </td> 	        	  		        	  
		        	<td> {{  $s->avgust }} </td> 
		        	<td> {{  $s->september }} </td> 
	        		<td> {{  $s->oktober }} </td> 	        		
	        		<td> {{  $s->november }} </td> 	        		
		        	<td> {{  $s->december }}  </td> 	
				</tr>		        	
				@endforeach			
        </tbody>       
        <tfoot>
        	<tr>
        		<td><strong>Skupaj</strong></td>
        		<td><strong>{{  $stat_sum['januar']  }}</strong></td>
	        	<td><strong>{{  $stat_sum['februar'] }}</strong></td> 				    
	        	<td><strong>{{  $stat_sum['marec'] }}</strong></td> 
	        	<td><strong>{{  $stat_sum['april'] }}</strong></td> 	        	  
				<td><strong>{{  $stat_sum['maj'] }}</strong></td> 
				<td><strong>{{  $stat_sum['junij'] }}</strong></td> 
	        	<td><strong>{{  $stat_sum['julij'] }}</strong></td> 	        	  		        	  
	        	<td><strong>{{  $stat_sum['avgust'] }}</strong></td> 
	        	<td><strong>{{  $stat_sum['september'] }}</strong></td> 
        		<td><strong>{{  $stat_sum['oktober'] }}</strong></td> 	        		
        		<td><strong>{{  $stat_sum['november'] }}</strong></td> 	        		
	        	<td><strong>{{  $stat_sum['december'] }}</strong></td> 	
        	</tr>
        </tfoot> 
        @endif
    </table>
	
	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto; margin-top: 20px;"></div>
	<div id="container-sum" style="min-width: 310px; height: 400px; margin: 0 auto; margin-top: 20px;"></div>
</div>




@if(isset($stat))
	<script type="text/javascript">
		var stat = {!! json_encode($stat, JSON_NUMERIC_CHECK) !!};			
		var leto = 	{!! json_encode($leto, JSON_NUMERIC_CHECK) !!};
		var stat_sum = {!! json_encode($stat_sum, JSON_NUMERIC_CHECK) !!};	

		//console.log(stat_sum);

	</script>
	<script src="{{ asset('js/move-pogodbe-statistika.js') }}" defer=""></script>
	 
@endif

@stop


@push('scripts')


	
@endpush

