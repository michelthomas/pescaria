@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Classificação</h1>
        <div class="container">
            <h2>Por peso</h2>
            <ul>
                @foreach($pescados_pesados as $pescado)
                    <li>{{ $pescado->name . ' com ' . $pescado->weight . ' pescado por ' . $pescado->user->name}}</li>
                @endforeach
            </ul>
        </div>

        <div class="container">
            <h2>Por quantidade</h2>
            <ul>
                @foreach($pescadores as $pescador)
                    <li>{{ $pescador->name . ' com ' . $qtd_Pescados[$pescador->id] . ' pescados.'}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
