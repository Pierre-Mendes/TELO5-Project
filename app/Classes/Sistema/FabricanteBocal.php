<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FabricanteBocal extends Model
{
    protected $table = 'fabricante_bocal';

    use SoftDeletes;
    protected $dates =  ['deleted_at'];
    protected $fillable = [
        'fabricante' , 'modelo'
    ];

}
