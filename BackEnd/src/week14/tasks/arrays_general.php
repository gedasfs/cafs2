<?php

    // Sukurkite "a", "b", "c" masyvą. Išveskite masyvo reikšmę naudodami funkciją var_dump().
    $abcArr = ['a', 'b', 'c'];
    var_dump($abcArr);

    // Naudodamiesi $arr masyvu iš ankstesnės užduoties, išveskite pirmo, antro ir trečio elementų turinį.
    foreach ($abcArr as $k => $v) 
    {
        echo "abcArr[{$k}] = {$v}\n";
    }

    // Sukurkite masyvą $arr = ['a', 'b', 'c', 'd'] ir panaudoja jį išveskite eilutė 'a + b, c + d'.
    $arr = ['a', 'b', 'c', 'd'];
    echo "{$arr[0]} + {$arr[1]}, {$arr[2]} + {$arr[3]}\n";

    // Sukurkite $arr masyvą su elementais 2, 5, 3, 9. 
    // Padauginkite pirmąjį masyvo elementą iš antrojo, o trečiąjį elementą iš ketvirtojo. 
    // Sudėkite rezultatus ir priskirkite kintamajam $result. Išveskite šio kintamojo reikšmę.
    $numArr = [2, 5, 3, 9];
    $result = ($numArr[0] * $numArr[1]) + ($numArr[2] * $numArr[3]);
    echo "result: {$result}\n";

    // Užpildykite $arr masyvą skaičiais nuo 1 iki 5. 
    // Nedeklaruokite masyvo elementų, o tiesiog užpildykite jį $arr[] = nauja reikšme.

    $arrFilled = [];
    for ($i = 1; $i <= 5; $i++) {
        $arrFilled[] = $i;
    }
    var_dump($arrFilled);
