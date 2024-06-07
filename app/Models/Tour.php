<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_id',
        'name',
        'starting_date',
        'ending_date',
        'price'
    ];

    public function price():Attribute
    {
        return Attribute::make(
            get: fn($vale) => $vale/100,
            set: fn($vale) => $vale*100
        );
    }
}
