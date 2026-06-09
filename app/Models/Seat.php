<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id',
        'seat_code', // A1, A2, dll
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
