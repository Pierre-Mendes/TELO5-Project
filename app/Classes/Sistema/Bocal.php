<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bocal extends Model
{
    protected $table = 'bocal';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'marca', 'modelo', 'plug', 'tipo', 'pressao_psi'
    ];

}
