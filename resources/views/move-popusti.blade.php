@extends('layouts.app')
 

@section('content')




<div class="container">
	<h1>
		<a href="/move-popusti">Jamstveni popusti MOVE</a>
	</h1>

	<form action="/move-popusti/iskanje" method="POST" role="search">
	    {{ csrf_field() }}
	    <div class="input-group">
	        <input type="text" class="form-control" name="naziv_avtohise" style="margin-top: 5px" 
	            placeholder="Naziv avtohiše" value="{{$naziv_avtohise }}" required="yes"> <span class="input-group-btn">
	            <button type="submit" class="btn btn-default">
	                <span>Pripravi podatke</span>
	            </button>
	        </span>
	    </div>
	</form>
	
@if(isset($pogodbe))
	<span>Najdenih {{ count($pogodbe) }} pogodb, prostih {{$st_prostih}}</span>
@endif

    <table class="table table-bordered" id="aktivacije-seznam" style="margin-top: 50px; font-size: x-small; ">
        <thead>
            <tr>
            	<th>Naziv avtohiše</th>                
                <th>Jamstvo</th>
             	<th>Veljavnost mesecev</th>
                <th>Popust jamstvo [%]</th>                                
                <th>Popust dod. km [%]</th>
                <th>Popust avt. menj. [%]</th>
                <th>Veljavnost od</th>
                <th>Veljavnost do</th>                                               
            </tr>
        </thead>
     	@if(isset($popusti))
        <tbody>        	
	        	@foreach ($popusti as $a)
	        	<tr>
		        	<td> {{  $a->naziv_stranke }} </td> 				    
	        		<td> {{  $a->vr_jamstva  }} </td>
		        	<td> {{  $a->veljavnost_jamstva }} </td> 				    
		        	<td> {{  $a->popust_jamstvo }} </td> 
		        	<td> {{  $a->popust_km }} </td> 	        	  
					<td> {{  $a->popust_menjalnik }} </td> 
					<td> {{  $a->velja_od }} </td> 
		        	<td> {{  $a->velja_do }} </td> 	        	  		        	  		        	      			        	
				</tr>		        	
				@endforeach			
        </tbody>        
        @endif
    </table>
</div>

@if(isset($popusti))
	<script src="{{ asset('js/move-popusti.js') }}" defer=""></script>
@endif

@stop


@push('scripts')


	
@endpush

