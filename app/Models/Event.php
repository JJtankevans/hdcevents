<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //castes do laravel para entender um JSON e salva-lo no banco
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];
}
