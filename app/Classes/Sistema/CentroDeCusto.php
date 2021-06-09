<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentroDeCusto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','nome', 'codigo'
    ];

    protected $dates =  ['deleted_at'];
}
