<?php 

// Sukukite ArrayHelper klasę su 2 statiniais metodais, kurie galetų apskaičiuoti duoto masyvo sumą arba vidurkį. 
// Panaudokite vieną statinį metodą kitame.

class ArrayHelper {
    public static function _arraySum(array $arr): float
    {
        return array_sum($arr);
    }

    public static function _arrayAvg(array $arr): float
    {
        return self::_arraySum($arr) / count(array_filter(array_values($arr), 'is_numeric'));
    }
}