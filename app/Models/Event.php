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

    /*permite que todas as infos enviadas por post podem ser atualizadas sem nenhuma restrição
    serve principalmente para o metodo de editar evento*/
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
