@extends('layouts.app')
 

@section('content')




<div class="container">
	<h1>
		<a href="/move-pogodbe">Seznam pogodb MOVE</a>
	</h1>

	<form action="/move-pogodbe/iskanje" method="POST" role="search">
	    {{ csrf_field() }}
	    
	        
	        @if($admin == true)
			<select id="id_stranke" name="id_stranke" class="form-control" style="margin-top: 5px" onchange="this.form.submit();" >	    	 
		 	 	@foreach($stranke as $s)
		 	 		<option value="{{ $s->id }}" {{ $id_stranke  == $s->id ? "selected":"" }}> {{ $s->naziv }}</option>
		 	 	<!--
      				<option value="{{ $s->id }}" {{ (old("id_stranke", $id_stranke) == $s->id ? "selected":"") }}>{{ $s->naziv }}</option>
      			-->	
    			@endforeach
	    	</select>	 
	    	@else
		    	<div class="input-group">
			    	<input type="text" class="form-control" name="naziv_avtohise" style="margin-top: 5px" 
			            placeholder="Naziv avtohiše" value="{{$naziv_avtohise }}" {{ ($admin != true ? "readonly":"") }}> <span class="input-group-btn">
			            <button type="submit" class="btn btn-default">
			                <span>Pripravi podatke</span>
			            </button>
			        </span>
		        </div>
			@endif	    

	    
	</form>
	
@if(isset($pogodbe))
	<span>Najdenih {{ count($pogodbe) }} pogodb, prostih {{$st_prostih}}</span>
@endif

    <table class="table table-bordered" id="aktivacije-seznam" style="margin-top: 50px; font-size: x-small; ">
        <thead>
            <tr>
                <th>Šifra</th>
             	<th width="150px">Naziv avtohiše</th>
                <th width="100px">Oznaka jamstva</th>                
                <th width="100px">Vrsta jamstva</th>                
                <th>Naziv</th>
                <th>Znamka</th>
                <th>Model</th>
                <th>VIN</th>                               
                <th>Dodatek menjalnik</th>
                <th>Dodatek km</th>
                <th>Prva reg.</th>
                <th>Datum predaje</th>                
                <th>Datum veljave</th>                
         	   	<th>Znesek jamstva</th>                
                <th>Znesek km</th>     
                <th>Znesek am</th>     
            </tr>
        </thead>
     	@if(isset($pogodbe))
        <tbody>        	
	        	@foreach ($pogodbe as $a)
	        	<tr>
		        	<td> {{  $a->id }} </td> 				    
	        		<td> {{  $a->naziv_avtohise  }} </td>
		        	<td> {{  $a->oznaka_kartice_jamstva }} </td> 				    
		        	<td> {{  $a->vr_jamstva }} </td> 
		        	<td> {{  $a->naziv }} </td> 	        	  
					<td> {{  $a->znamka_vozila }} </td> 
					<td> {{  $a->model_vozila }} </td> 
		        	<td> {{  $a->vin }} </td> 	        	  		        	  
		        	<td> {{  $a->dodatek_menjalnik }} </td> 
		        	<td> {{  $a->dodatek_km }} </td> 
	        		<td> {{  $a->datum_prve_reg }} </td> 	        		
	        		<td> {{  $a->datum_predaje_jamstva }} </td> 	        		
		        	<td> {{  $a->pricetek_veljave_jamstva }}  </td> 	
		        	<td> {{  $a->znesek_jamstvo }} </td> 	        		
		        	<td> {{  $a->znesek_km }}  </td> 			        			        	 
		        	<td> {{  $a->popust_am }}  </td> 			        			        	 
				</tr>		        	
				@endforeach			
        </tbody>        
        @endif
    </table>
</div>

@if(isset($pogodbe))
	<script src="{{ asset('js/move-pogodbe.js') }}" defer=""></script>
@endif

@stop


@push('scripts')


	
@endpush

