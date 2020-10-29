@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div>
            <h2>Pescarias</h2>

            <ul>
                @forelse($pescarias as $pescaria)
                    <li><a href="{{ route('pescaria.show', ['pescaria' => $pescaria]) }}">{{ $pescaria->user->name }}. {{ $pescaria->date }}</a></li>
                @empty
                    <h5>O usuário não está participando de nenhuma pescaria!</h5>
                @endforelse
            </ul>

            <a href="{{ route('pescaria.create') }}">
                <button class="btn btn-primary">Criar pescaria</button>
            </a>
        </div>
        <div>
            @include('friend_list', ['user' => Auth::user()])
        </div>
    </div>
</div>
@endsection
