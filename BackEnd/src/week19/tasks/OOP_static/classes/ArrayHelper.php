<?php 

// Sukukite ArrayHelper klasę su 2 statiniais metodais, kurie galetų apskaičiuoti duoto masyvo sumą arba vidurkį. 
// Panaudokite vieną statinį metodą kitame.

class ArrayHelper {
    public static function sum(array $arr): float|int
    {
        return array_sum($arr);
    }

    public static function avg(array $arr): float|int
    {
        return self::sum($arr) / count(array_filter(array_values($arr), 'is_numeric'));
    }
}