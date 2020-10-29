@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{count($users) . ' usuários encontrados'}}</h1>
        <ul>
            @forelse($users as $user)
                <li id="{{ $user->id }}"><a href="{{ $user->path() }}">{{ $user->name }}</a></li>
            @empty
                <h5>No users!</h5>
            @endforelse
        </ul>
    </div>
@endsection
