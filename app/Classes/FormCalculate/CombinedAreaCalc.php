<?php

namespace App\Classes\FormCalculate;

class CombinedAreaCalc
{
    public static function combinedArea($area_pivo_1, $area_pivo_2, $area_pivo_3, $area_pivo_4)
    {
        $combinedArea = ($area_pivo_1 + $area_pivo_2) + ($area_pivo_3 + $area_pivo_4);
        return $combinedArea;
    }
}
