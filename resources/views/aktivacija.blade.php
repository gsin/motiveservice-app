@extends('layouts.app')
 

@section('content')


  

<div class="container">
	<h1>Seznam aktivacij</h1>

	@if(Session::has('flash_ok'))
	    <div id="flash_ok" class="alert alert-success">
	        {{ Session::get('flash_ok') }}
	    </div>
	@endif

	@if(Session::has('flash_error'))
	    <div id="flash_error" class="alert alert-danger alert-block">
	        {{ Session::get('flash_error') }}
	    </div>
	@endif

	<table class="table table-bordered" id="nabor-ukazov">
		<tr>
			<td>
				<a href="/aktivacija-nova" class="btn btn-success">Nova aktivacija</a>
			</td>
		</tr>		
	</table>
	
	
    <table class="table table-bordered" id="aktivacije-seznam">
        <thead>
            <tr>
            	<th>ID</th>       
            	<th>     </th>
        	  	     	           
             	<th>Prodajalec</th>
                <th>Oznaka pogodbe</th>   
             	 <th>Status</th>        
                <th>Opomba</th>                        
                <th>Naziv</th>                
                <th>Znamka</th>
                <th>Model</th>
                <th>Šasija</th>
                <th>Registrska št.</th>
                <th>Tip jamstva</th>
                <th>Vnesel uporabnik</th>
                <th>Datum</th>                                                   	
             	
             	<th></th>	   
             	<th></th>
            </tr>
        </thead>
        <tbody>        	
	        	@foreach ($aktivacije as $a)
	        	<tr>
	        		
	        		<td> {{  $a->id }} </td> 		
    			 	<td> 			        			 
						@if($a->status == 0)        		 
		        			<a  href="/aktivacija-uredi/{{$a->id }}"  class="btn btn-info">Urejanje</a>
	        			@endif	        			        		
		        	</td>	        	
		        	<td> {{  $a->prodajalec->naziv }} </td>
		        	<td> {{  $a->oznaka_jamstva }} </td> 			    	        		
		        	<td> {{  $a->status_akt->naziv}}  </td>
					<td> {{  $a->status_msg }}  </td>
		        	<td> {{  $a->ime_priimek }} </td> 
		        	<td> {{  $a->znamka_vozila->opis }} </td> 
	        	  	<td> {{  $a->model }} </td> 
	        	  	<td> {{  $a->st_sasije }} </td> 	        	  
		        	<td> {{  $a->registrska_st }} </td> 
		        	<td> {{  $a->jamstvo->naziv }} </td> 
	        		  

	        		<td> {{  isset($a->user->name) ? $a->user->name : ''   }} </td> 	      		
	        		<td> {{  $a->created_at_fmt }} </td> 	 
	        		      		
	           		<td> 		
		           		@if($a->status == 0)
							  <a href="/aktivacija/oddaj/{{  $a->id }}"  class="btn btn-primary">Oddaj</a>						 
						@else
							<a  href="/aktivacija/izpis/{{$a->id }}"  class="btn btn-default">Izpis PDF</a>		   
						@endif	       		        		 
		        	</td>	        
		        	 
		        	</td>	        		        	
		        	<td> 		        		 
	        			<a  href="/mailing/{{  $a->id }}"  class="btn btn-info">Mail</a>		        		 
		        	</td>
		        	
				</tr>		        	
				@endforeach			
        </tbody>
    </table>

    <table class="table table-bordered" id="nabor-ukazov">
		<tr>
			<td>
				<a href="/aktivacija-jamstva-all" class="btn btn-info">Prikaži vse</a>
			</td>
		</tr>		
</table>
</div>



<script src="{{ asset('js/move-pogodbe.js') }}" defer=""></script>
@stop

@push('scripts')

<script>
	
</script>
@endpush

 