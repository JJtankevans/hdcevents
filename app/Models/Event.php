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

    /*Cria a relação de que um usuário é cria um evento */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /*Cria uma relação de muitos para muitos no qual um evento pode ter muitos participantes
    e um participanete pode estar em muitos eventos*/
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
