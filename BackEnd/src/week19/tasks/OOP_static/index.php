<?php

// Sukukite ArrayHelper klasę su 2 statiniais metodais, kurie galetų apskaičiuoti duoto masyvo sumą arba vidurkį. 
// Panaudokite vieną statinį metodą kitame.

include_once 'classes/ArrayHelper.php';

$numArr = [5, 5, '5', 'abc'];

echo sprintf("Sum: %d<br>\n", ArrayHelper::sum($numArr));
echo sprintf("Avg: %d<br>\n", ArrayHelper::avg($numArr));
var_dump($numArr);