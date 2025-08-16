@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Potrditev aktivacije jamstva</h4>
                </div>
                <div class="card-body">
                    
                    @if(empty($errors) || empty($requestData))
                        <div class="alert alert-danger">
                            <strong>Napaka!</strong> Ni podatkov za potrditev. 
                            <br><br>
                            <a href="{{ route('aktivacija.create') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Nazaj na obrazec
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <strong>Pozor!</strong> Vozilo presega aktivacijske pogoje, vendar lahko nadaljujete z aktivacijo.
                        </div>

                        <h5>Prekršeni pogoji:</h5>
                        <ul class="list-group mb-4">
                            @foreach($errors as $field => $message)
                                <li class="list-group-item list-group-item-danger">
                                    <strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong> {{ $message }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="alert alert-info">
                            <strong>Informacija:</strong> V kolikor se odločite za nadaljevanje, se lahko obrnete na vašega skrbnika za dodatne informacije.
                        </div>

                        <form method="POST" action="{{ route('aktivacija.override-save') }}">
                            @csrf
                            
                            <!-- Hidden fields to preserve all the original data -->
                            @foreach($requestData as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $subKey => $subValue)
                                        <input type="hidden" name="{{ $key }}[{{ $subKey }}]" value="{{ $subValue }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach

                            <div class="form-group">
                                <label for="override_reason">Razlog za nadaljevanje:</label>
                                <textarea class="form-control" id="override_reason" name="override_reason" rows="3" placeholder="Opišite razlog za nadaljevanje kljub prekršenim pogojem..." required></textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirm_override" name="confirm_override" required>
                                    <label class="form-check-label" for="confirm_override">
                                        Potrjujem, da razumem posledice in želim nadaljevati z aktivacijo kljub prekršenim pogojem
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('aktivacija.create') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Nazaj na obrazec
                                </a>
                                
                                <button type="submit" class="btn btn-warning" id="submitBtn" disabled>
                                    <i class="fas fa-exclamation-triangle"></i> Nadaljuj z aktivacijo
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty($errors) && !empty($requestData))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const confirmCheckbox = document.getElementById('confirm_override');
    const submitBtn = document.getElementById('submitBtn');
    
    if (confirmCheckbox && submitBtn) {
        confirmCheckbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });
    }
});
</script>
@endif
@endsection
