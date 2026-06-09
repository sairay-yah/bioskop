<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id','method','amount','status','qris_reference','paid_at'
    ];

    protected $dates = ['paid_at'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
