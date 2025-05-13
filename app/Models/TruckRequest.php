<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'pickup_location',
        'dropoff_location',
        'pickup_time',
        'delivery_time',
        'truck_type',
        'weight',
        'note',
        'cargo_type',
        'user_id',
        'created_at'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}