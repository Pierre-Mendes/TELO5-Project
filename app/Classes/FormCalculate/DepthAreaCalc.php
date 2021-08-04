<?php

namespace App\Classes\FormCalculate;

class DepthAreaCalc
{
    /**
     * Lâmina Total Conjugada
     * Para o Cálculo da Lâmina Total COnjugada
     * É necessário conhecer a área total conjucgada que é:
     * areaTotalConjugada = (area1 + area2) + (area3 + area4)
     * Somatória do Produto que é:
     * Somatória Total entre
     * somaProduto = (area1 * vazao1) + (area2 * vazao2) + (area3 * vazao3) + (area4 * vazao4)
     * E dividir pela área total conjugada
     */
    public static function depthAreacalc(
        $area_pivo_1, $area_pivo_2, $area_pivo_3, $area_pivo_4,
        $vazao_pivo_1, $vazao_pivo_2, $vazao_pivo_3, $vazao_pivo_4)
    {
        $depthdArea =
        ($area_pivo_1 * $vazao_pivo_1) + ($area_pivo_2 * $vazao_pivo_2) +
        ($area_pivo_3 * $vazao_pivo_3) + ($area_pivo_4 * $vazao_pivo_4) /
        ($area_pivo_1 + $area_pivo_2) + ($area_pivo_3 + $area_pivo_4);

        return $depthdArea;
    }
}
