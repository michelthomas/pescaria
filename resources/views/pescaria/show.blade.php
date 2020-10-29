@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pescaria</h1>
        <p>Criada por: {{ $pescaria->user->name }}</p>
        <p>Status: {{ $pescaria->open ? 'Aberta' : 'Fechada' }}</p>
        <p>Data: {{ $pescaria->date }}</p>
        <p>Hora: {{ $pescaria->hour }}</p>
        <div>
            <p class="card-subtitle">Participantes</p>
            <ul>
                @foreach($pescaria->participantes as $participante)
                    <li>{{ $participante->name }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection
