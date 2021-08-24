<?php

namespace App\Classes\EntregaTecnica;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntregaTecnica extends Model
{
    protected $table = 'entrega_tecnica';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'id', 'id_tecnico', 'id_fazenda',  'id_revenda', 'numero_pedido', 'numero_serie', 'cidade', 'estado'
    ];
}
