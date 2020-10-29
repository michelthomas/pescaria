@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pescarias</h1>

        <h3>Criadas por mim</h3>
        <ul>
            @foreach($pescarias as $pescaria)
                <li><a href="{{ route('pescaria.show', ['pescaria' => $pescaria]) }}">{{ $pescaria->user->name }}. {{ $pescaria->date }}</a></li>
            @endforeach
        </ul>

        <h3>Criadas por amigos</h3>
        <ul>
            @foreach($pescarias_amigos as $pescaria)
                <li><a href="{{ route('pescaria.show', ['pescaria' => $pescaria]) }}">{{ $pescaria->user->name }}. {{ $pescaria->date }}</a></li>
            @endforeach
        </ul>



        <a href="{{ route('pescaria.create') }}">
            <button class="btn btn-primary">Criar pescaria</button>
        </a>
    </div>
@endsection
