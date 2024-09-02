@extends('layouts.app')

@section('content')
@if($doctor)
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="row g-0">
            <!-- Sezione Foto del dottore -->
            <div class="col-md-4 bg-light rounded-start">
                <img src="{{ asset($doctor->pic) }}" alt="Foto di {{ $doctor->user->name }} {{ $doctor->surname }}" class="img-fluid rounded-circle p-4">
            </div>
            <!-- Sezione Informazioni del dottore -->
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $doctor->user->name }} {{ $doctor->surname }}</h2>
                    <p class="card-text text-muted mb-4">Indirizzo: {{ $doctor->address }}</p>
                    <p class="card-text text-muted">Telefono: {{ $doctor->phone }}</p>
                    <p class="card-text mt-4">{{ $doctor->bio }}</p>

                    <!-- Specializzazioni -->
                    @if($doctor->specializations->isNotEmpty())
                        <h5 class="mt-4">Specializzazioni</h5>
                        <ul class="list-group list-group-flush">
                            @foreach($doctor->specializations as $specialization)
                                <li class="list-group-item">{{ $specialization->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted mt-4">Non ci sono specializzazioni specificate.</p>
                    @endif

                    <!-- Sponsorizzazione attiva -->
                    @if($doctor->activeSponsorship())
                        <div class="alert alert-info mt-4" role="alert">
                            <h5>Sponsorizzazione attiva</h5>
                            <p class="mb-1"><strong>Nome:</strong> {{ $doctor->activeSponsorship()->pivot->name }}</p>
                            <p class="mb-1"><strong>Prezzo:</strong> €{{ $doctor->activeSponsorship()->pivot->price }}</p>
                            <p class="mb-0"><strong>Data Inizio:</strong> {{ $doctor->activeSponsorship()->pivot->date_start }}</p>
                            <p class="mb-0"><strong>Data Fine:</strong> {{ $doctor->activeSponsorship()->pivot->date_end }}</p>
                        </div>
                    @else
                        <p class="text-muted mt-4">Nessuna sponsorizzazione attiva.</p>
                    @endif

                    <!-- Curriculum Vitae -->
                    @if($doctor->cv)
                        <a href="{{ asset($doctor->cv) }}" class="btn btn-primary mt-3">Visualizza il CV</a>
                    @endif

                    <!-- Pulsante per modificare il profilo -->
                    <a href="{{ route('profile.edit') }}" class="btn btn-warning mt-3 ms-2">Modifica Profilo</a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
        <!-- Mostra un messaggio se il profilo non esiste -->
        <div class="alert alert-info">
            <p>Non hai ancora creato un profilo. <a href="{{ route('profile.create') }}">Crea uno ora</a>.</p>
        </div>
    @endif
@endsection
