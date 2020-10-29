<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pescado extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'weight',
        'size',
        'image'
    ];

    public function pescaria()
    {
        return $this->belongsTo(Pescaria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
