<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bottles extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, float, boolean>
     */
    protected $fillable =[
        'brand', 
        'liters',
        'extrusion_time',
        'thickness',
        'temperature',
        'engine_speed',
        'bandwidth',
        'tape_length',
        'ventilation',
    ];
}
