@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pescado</h1>
        <p>Adicionado por: {{ $pescado->user->name }}</p>
        <p>Pescaria: {{ 'Pescaria de ' . $pescaria->date . ' ' . $pescaria->hour . 'h criada por ' . $pescado->pescaria->user->name }}</p>
        <p>Espécie: {{ $pescado->name }}</p>
        <p>Massa(kg): {{ $pescado->weight }}</p>
        <p>Tamanho(cm): {{ $pescado->size }}</p>
        <img src="{{ $pescado->image }}" alt="Imagem do pescado" class="img-fluid">

        <div class="flex-row">
            <a href="{{ route('pescaria.show', ['pescaria' => $pescado->pescaria]) }}">
                <button class="btn btn-outline-primary"></i>Voltar</button>
            </a>
        </div>
    </div>

@endsection
