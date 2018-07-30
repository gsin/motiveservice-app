@extends('layouts.app')
 

@section('content')


  

<div class="container">
	<h1>Seznam aktivacij</h1>


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
             	<th>Prodajalec</th>
                <th>Šifra SLP</th>                
                <th>Naziv</th>                
                <th>Znamka</th>
                <th>Model</th>
                <th>Šasija</th>
                <th>Registrska št.</th>
                <th>Tip jamstva</th>
                <th>Vnesel uporabnik</th>
                <th>Datum</th>                
                <th>Status Backoffice</th>                
             	<th></th>
            </tr>
        </thead>
        <tbody>        	
	        	@foreach ($aktivacije as $a)
	        	<tr>
		        	<td> {{  $a->id }} </td> 				    
	        		<td> {{  $a->prodajalec->naziv }} </td>
		        	<td> {{  $a->sifra }} </td> 				    
		        	<td> {{  $a->ime_priimek }} </td> 
		        	<td> {{  $a->znamka_vozila->opis }} </td> 
	        	  	<td> {{  $a->model }} </td> 
	        	  	<td> {{  $a->st_sasije }} </td> 	        	  
		        	<td> {{  $a->registrska_st }} </td> 
		        	<td> {{  $a->jamstvo->naziv }} </td> 
	        		<td> {{  $a->user->name }} </td> 	        		
	        		<td> {{  $a->created_at }} </td> 	        		
		        	<td> ODPRT </td> 		        	
		        	<td> <a  href="/admin/aktivacija-jamstva/{{  $a->id }}/edit" class="btn btn-info">Uredi</button> </a>
				</tr>		        	
				@endforeach			
        </tbody>
    </table>
</div>

@stop

@push('scripts')

<script>
	
</script>
@endpush

 