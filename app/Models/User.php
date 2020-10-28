<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'phone',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // amizade que o user começou
    public function friendsOfMine()
    {
        return $this->belongsToMany(
            User::class,
            'friendship',
            'user_id',
            'friend_id'
        )->withTimestamps();
    }

    // amizade que o user foi convidado
    public function friendOf()
    {
        return $this->belongsToMany(User::class,
            'friendship',
            'friend_id',
            'user_id'
        )->withTimestamps();
    }

    protected function loadFriends()
    {
        $friends = $this->mergeFriends();

        $this->setRelation('friends', $friends);
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }

    // método chamado quando chama-se $user->friends
    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('friends', $this->relations)) {
            $this->loadFriends();
        }

        return $this->getRelation('friends');
    }

    public function add_friend($friend_id)
    {
        return $this->friendsOfMine()->attach($friend_id);
    }

    public function remove_friend($friend_id)
    {
        return $this->friendsOfMine()->detach($friend_id);
    }

    public function isFriend($user_id) {
        return ($this->friendsOfMine()->where('friend_id', $user_id)->exists()
            || $this->friendOf()->where('user_id', $user_id)->exists());
    }

    // troca o status de amigo para não-amigo e vice-versa
    public function toggleFriendship($friend_id)
    {
        if ($this->isFriend($friend_id)) {
            return $this->remove_friend($friend_id);
        }

        return $this->add_friend($friend_id);
    }
}
