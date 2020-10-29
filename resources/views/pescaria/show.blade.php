@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mb-5">
            <h1>Pescaria</h1>
            <p>Criada por: {{ $pescaria->user->name }}</p>
            <p>Status: {{ $pescaria->open ? 'Aberta' : 'Fechada' }}</p>
            <p>Data: {{ $pescaria->date }}</p>
            <p>Hora: {{ $pescaria->hour }}</p>

            @if(Auth::user()->id === $pescaria->user->id && $pescaria->open)
                <form action="{{ route('pescaria.finish', ['pescaria' => $pescaria]) }}" method="POST">
                    @csrf

                    <button name="submit" class="btn btn-primary">Finalizar</button>
                </form>
            @endif
        </div>
        <div class="container">
            <h3 class="card-subtitle">Participantes</h3>
            <ul>
                @foreach($pescaria->participantes as $participante)
                    <li>{{ $participante->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="container">
            <h3 class="card-subtitle">Pescados</h3>
            <ul id="pescados">
                @foreach($pescaria->pescados as $pescado)
                    <li>
                        <a href="{{ route('pescado.show', ['pescaria' => $pescaria, 'pescado' => $pescado]) }}">
                        {{ $pescado->name . ' de ' . $pescado->weight . 'kg e ' . $pescado->size . 'cm pescado por ' . $pescado->user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @if($pescaria->open)
                <a href="{{ route('pescado.create', ['pescaria' => $pescaria]) }}">
                    <button class="btn btn-primary">Adicionar pescado</button>
                </a>
            @else
                <a href="{{ route('pescaria.podium', ['pescaria' => $pescaria]) }}">
                    <button class="btn btn-primary">Ver classificação</button>
                </a>
            @endif
        </div>
    </div>
    <script>

    </script>
@endsection
