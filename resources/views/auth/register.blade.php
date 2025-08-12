@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nov uporabnik</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Ime in priimek</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Pošta</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sifra_avtohise') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Prodajalec</label>

                            <div class="col-md-6">
                                <input id="sifra_avtohise" type="text" class="form-control" name="sifra_avtohise" value="{{ old('sifra_avtohise') }}" required autofocus>

                                @if ($errors->has('sifra_avtohise'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sifra_avtohise') }}</strong>
                                    </span>
                                @endif
                            </div>                        
                        </div>

                        <div class="form-group{{ $errors->has('komercialist') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Komercialist</label>

                            <div class="col-md-6">                                
                                <select name="komercialist" id="komercialist"class="form-control">
                                    <option value="0" selected>NE</option>
                                    <option value="1">DA</option>
                                </select>    
                                @if ($errors->has('komercialist'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('komercialist') }}</strong>
                                    </span>
                                @endif
                            </div>

                            
                        </div>
                        <div class="form-group{{ $errors->has('api_token') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">API Token</label>
                            <div class="col-md-6">
                                <input id="api_token" type="text" class="form-control" name="api_token" value="{{ old('api_token', uniqid()) }}" required autofocus>

                                @if ($errors->has('api_token'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('api_token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Geslo</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Ponovi geslo</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registriraj
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
