<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cad_bocais extends Model
{
    protected $table = 'cad_bocais';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'fabricante' , 'modelo'
    ];

}
