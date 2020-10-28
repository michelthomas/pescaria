@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>

    <p>CPF: {{ $user->cpf }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Telefone: {{ $user->phone }}</p>
    <p>Endereço: {{ $user->address }}</p>

    @auth
        @if(Auth::user()->id !== $user->id)
            <form action="{{ route('friends', $user) }}" method="POST">
                @csrf

                <input type="hidden" name="friend_id" value="{{ $user->id }}">
                <button name="submit">{{ Auth::user()->isFriend($user->id) ? 'Desfazer amizade' : 'Adicionar' }}</button>
            </form>
        @endif
    @else
        <h4>Deslogado</h4>
    @endauth

    <h3>Amigos</h3>
    <ul>
        @foreach($user->friends as $friend)
            <li><a href="{{ route('profile', ['user' => $friend->id]) }}">{{ $friend->id }}. {{ $friend->name }}</a></li>
        @endforeach
    </ul>
@endsection
