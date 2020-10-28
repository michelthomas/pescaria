@extends('layouts.app')

@section('content')
    <ul>
        @forelse($users as $user)
            <li id="{{ $user->id }}"><a href="{{ $user->path() }}">{{ $user->name }}</a></li>
        @empty
            <p>No users!</p>
        @endforelse
    </ul>

@endsection
