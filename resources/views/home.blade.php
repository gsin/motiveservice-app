@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hitri dostop</div>

                <div class="panel-body">

                    <ul>
                        <li><a href="/aktivacija-nova">Aktivacija jamstva</a></li>
                        <li><a href="/aktivacija-jamstva">Pregled jamstev</a></li>
                        <li><a href="">Prijava škode</a></li>                             
                    </ul>
                   


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                 <div class="form-group">
                    <div class="input-control">
                        <a href="{{ url('/aktivacija-nova/prima') }}">
                            <img src="images/prima_small.jpg"/>   
                        </a>
                    </div>
                    <div class="input-control">
                          <a href="{{ url('/aktivacija-nova/intensa') }}">
                            <img src="images/intensa_small.jpg"/>   
                        </a>
                    </div>
                    <div class="input-control">
                          <a href="{{ url('/aktivacija-nova/suprema') }}">
                            <img src="images/suprema_small.jpg"/>   
                        </a>
                    </div>
                </div>    
                </div>
            </div>
        </div>
    </div>        
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Zadnji vnosi</div>
                    <div class="panel-body">
                        <ul>

                            @foreach ($aktivacije as $a)
                                <li><a href="http://motiveservice.test/admin/aktivacija-jamstva/{{  $a->id }}/edit"> {{$a->sifra." ".$a->ime_priimek." ".$a->znamka_vozila->opis." ".$a->model." ".$a->registrska_st. " - ". "ODPRT"}} </a></li>
                            @endforeach         
                           
                        </ul>
                    </div>     
                 </div>    
            </div>                                     
        </div>
    </div>

    

</div>
@endsection
