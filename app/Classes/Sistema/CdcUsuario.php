<?php

namespace App\Classes\Sistema;

use Illuminate\Database\Eloquent\Model;

class CdcUsuario extends Model
{
    protected $fillable = [
        'id_usuario', 'id_centro_custo'
    ];

    public static function inserirRelacionamentosCdcUsuario ($id_usuario, $lista_cdcs){
        
        foreach($lista_cdcs as $cdc){
            $count = CdcUsuario::where('id_usuario', $id_usuario)->where('id_centro_custo', $cdc)->count();
            if($count == 0){
                $cdcUser = array();
                $cdcUser['id_usuario'] = $id_usuario;
                $cdcUser['id_centro_custo'] = $cdc;
                CdcUsuario::create($cdcUser);
            }
        }
    }

    public static function alterarCdcUsuario ($lista_cdcs, $id_usuario) {
        $cdcs_db = CdcUsuario::where('id_usuario', $id_usuario)->get();
        $cdcs_existentes = array();
        $flag= 0;
        foreach($cdcs_db as $cdc_db){
            $flag= 0;
            foreach($lista_cdcs as $cdc){
                if($cdc_db['id'] == $cdc){
                    $flag = 1;
                    array_push($cdcs_existentes, $cdc);
                }
            }
            if($flag != 1){
                CdcUsuario::find($cdc_db['id'])->delete();
            }
        }

        foreach($lista_cdcs as $cdc_aux){
            $flag = 0;
            foreach($cdcs_existentes as $cdc_existente){
                if($cdc_aux == $cdc_existente){
                    $flag = 1;
                }
            }
            if($flag == 0){
                $novo_cdc = array();
                $novo_cdc['id_usuario'] = $id_usuario;
                $novo_cdc['id_centro_custo'] = $cdc_aux;
                CdcUsuario::create($novo_cdc);
            }
        }
    }
}
