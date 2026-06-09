<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','duration','genre','age_rating','poster','base_price'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
