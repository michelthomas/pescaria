<h2>Pescarias</h2>

<ul>
    @foreach($user->friends as $friend)
        <li><a href="{{ route('profile', ['user' => $friend->id]) }}">{{ $friend->id }}. {{ $friend->name }}</a></li>
    @endforeach
</ul>
