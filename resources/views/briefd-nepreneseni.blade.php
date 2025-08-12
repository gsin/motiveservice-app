@extends('layouts.app')
 

@section('content')




<div class="container">
	<h1>
		<a href="/briefd-integracija">Briefd integracija - Nepreneseni</a>
	</h1>

	<form action="/briefd-integracija/prenesi" method="POST" role="search">
	    {{ csrf_field() }}
	    <div class="input-group">	        
	            <button type="submit" class="btn btn-default">
	                <span>Prenesi v MOVE</span>
	            </button>
	        </span>
	    </div>
	</form>
	
@if(isset($pogodbe))
	<span>Neprenesenih {{ count($pogodbe) }} pogodb</span>
@endif

    <table class="table table-bordered" id="aktivacije-seznam" style="margin-top: 50px; font-size: x-small; ">
        <thead>
            <tr>
            	<th>Naziv avtohiše</th>                
                <th>Jamstvo</th>
                <th>Oznaka</th>
             	<th>Stranka</th>
				<th>Znamka vozila</th>
             	<th>Model</th>
                <th>Veljavnost od</th>                                                              
            </tr>
        </thead>
     	
        <tbody>        	
	        	@foreach ($pogodbe as $a)
	        	<tr>
		        	<td> {{  $a->naziv_avtohise }} </td> 				    
					<td> {{  $a->vr_jamstva }} </td> 				    
	        		<td> {{  $a->oznaka_kartice_jamstva  }} </td>
	        		<td> {{  $a->naziv }} </td> 				    
					<td> {{  $a->znamka_vozila }} </td> 				    
					<td> {{  $a->model_vozila }} </td> 				    											        
		        	<td> {{  $a->pricetek_veljave_jamstva }} </td> 				    		        	
				</tr>		        	
				@endforeach			
        </tbody>        
        
    </table>
</div>

@if(isset($pogodbe))
	<script src="{{ asset('js/move-popusti.js') }}" defer=""></script>
@endif

@stop


@push('scripts')


	
@endpush

