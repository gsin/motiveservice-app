@extends('layouts.app')

@section('content')
<div class="container">
    
 

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upravljanje jamstev</div>
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                     <div class="form-group insurance-icons">

                        <div class="input-control color-default">
                            <a href="{{ url('/aktivacija-jamstva') }}">
                                <i class="fas fa-book fa-7x"></i>
                                <div>Pregled jamstev</div>
                            </a>
                        </div>
                        <div class="input-control color-default">
                            <a href="">
                                <i class="fas fa-wrench fa-7x"></i>
                                <div>Prijava škode</div>
                            </a>
                        </div>

                    </div>    
                </div>
            </div>
        </div>
    </div> 
     @if (count($oznake) > 0)
        <div class="row">
            {!! Form::open(array('action' => 'AktivacijaJamstvaPaketController@createPaketOznaka', 'class'=>'form-aktivacija-vnos')) !!}
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Zakupljena jamstva</div>

                        <div class="form-group insurance-icons">
                            <div class="input-control color-prima" style="margin-top: 20px;">
                                <a href="">
                                    <i class="fas fa-layer-group fa-7x"></i>
                                    <div>Skupaj zakupljenih <strong>{{count($oznake)}}</strong> paketov</div>
                                </a>
                            </div>
                         </div>
                        <div class="panel-body">
                            <select class="form-control" id="oznaka_jamstva" name="oznaka_jamstva" style="flex: 4">
                                @foreach($oznake as $o)
                                    <option value="{{$o}}" {{ (old("oznaka_jamstva") == $o ? "selected":"") }}>{{$o}}</option>                  
                                @endforeach       
                            </select>   
                           <div class="form-group" style="margin-top: 20px;">   
                                <button class="btn btn-success">Vnos paketa</button>                         
                            </div>
                    </div>
                </div>
            </div>
        
        {!! Form::close() !!}
        </div> 
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Novo jamstvo</div>
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                     <div class="form-group insurance-icons">

                        <div class="input-control color-base">
                            <a href="{{ url('/aktivacija-nova/base') }}">
                                <i class="fas fa-file-invoice fa-7x"></i>
                                <div>Base</div>
                            </a>
                        </div>
                        <div class="input-control color-prima">
                            <a href="{{ url('/aktivacija-nova/prima') }}">
                                <i class="fas fa-file-invoice fa-7x"></i>
                                <div>Prima</div>
                            </a>
                        </div>
                        <div class="input-control color-intensa">
                            <a href="{{ url('/aktivacija-nova/intensa') }}">
                                <i class="fas fa-file-invoice fa-7x"></i>
                                <div>Intensa</div>
                            </a>
                        </div>
                        <div class="input-control color-suprema">
                            <a href="{{ url('/aktivacija-nova/suprema') }}">
                                <i class="fas fa-file-invoice fa-7x"></i>
                                <div>Suprema</div>
                            </a>
                        </div>
                        <div class="input-control color-optima">
                            <a href="{{ url('/aktivacija-nova/optima') }}">
                                <i class="fas fa-file-invoice fa-7x"></i>
                                <div>Optima</div>
                            </a>
                        </div>
                        @if ($optima_care_visible == true)
                            <div class="input-control color-optima">
                                <a href="{{ url('/aktivacija-nova/optima-care') }}">
                                    <i class="fas fa-file-invoice fa-7x"></i>
                                    <div>Optima Care</div>
                                </a>
                            </div>
                        @endif    
                    </div>    
                </div>
            </div>
        </div>
    </div> 
   
<!--
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jamstveni paketi</div>
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                     <div class="form-group insurance-icons">

                        <div class="input-control color-base">
                            <a href="">
                                <i class="fas fa-layer-group fa-7x"></i>
                                <div>Paket Base (<strong>5</strong>)</div>
                            </a>
                        </div>
                        <div class="input-control color-prima">
                            <a href="{{ url('/aktivacija-nova/prima') }}">
                                <i class="fas fa-layer-group fa-7x"></i>
                                <div>Paket Prima (<strong>8</strong>)</div>
                            </a>
                        </div>
                        <div class="input-control color-intensa">
                            <a href="{{ url('/aktivacija-nova/intensa') }}">
                                <i class="fas fa-layer-group fa-7x"></i>
                                <div>Paket Intensa (<strong>2</strong>)</div>
                            </a>
                        </div>
                        <div class="input-control color-suprema">
                            <a href="{{ url('/aktivacija-nova/suprema') }}">
                                <i class="fas fa-layer-group fa-7x"></i>
                                <div>Paket Suprema (<strong>9</strong>)</div>
                            </a>
                        </div>

                    </div>    
                </div>
            </div>
        </div>
    </div> 
-->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Move pogodbe</div>
                <div class="panel-body">
                    <div class="form-group insurance-icons">
                        <div class="input-control color-default">
                            <a href="{{ url('/move-pogodbe') }}">
                                <i class="fas fa-book fa-7x"></i>
                                <div>Pregled pogodb</div>
                            </a>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
