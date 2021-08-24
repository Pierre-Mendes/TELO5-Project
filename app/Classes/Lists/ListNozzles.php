<?php

namespace App\Classes\Lists;
//use App\Classes\Sistema\Bocal;

class ListNozzles
{
    public static function getListNozzles()
    {
        $arrNelson = [
            'marca' => 'Nelson',
                'modelo' => 'Spinner',
                'modelo' => 'Rotator',
                'modelo' => 'TrashBuster',
                'modelo' => 'Orbitor',
        ];

        $arrSenninger = [
            'marca' => 'Senninger',
                'modelo' => 'Super Spray',
                'modelo' => 'LND',
                'modelo' => 'Lepa',
                'modelo' => 'I-Wob',
        ];

        $arrKomet = [
            'marca' => 'Komet',
                'modelo' => 'Twister',
        ];

        return array_merge($arrNelson, $arrSenninger, $arrKomet);
    }

}

