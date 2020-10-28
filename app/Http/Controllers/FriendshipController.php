<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function __invoke(User $user)
    {
        Auth::user()->toggleFriendship($user->id);

        return back();
    }
}
