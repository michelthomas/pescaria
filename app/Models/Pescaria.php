<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pescaria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'open',
        'date',
        'hour',
        'place'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pescados()
    {
        return $this->hasMany(Pescado::class);
    }

    public function participantes()
    {
        return $this->belongsToMany(User::class,
            'participantes',
            'pescaria_id',
            'user_id'
        );
    }
}
